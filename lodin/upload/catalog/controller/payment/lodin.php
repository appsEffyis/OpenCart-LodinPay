<?php
namespace Opencart\Catalog\Controller\Extension\Lodin\Payment;

class Lodin extends \Opencart\System\Engine\Controller {
    
    const RTP_API_URL = 'https://api-preprod.lodinpay.com/merchant-service/extensions/pay/rtp';
    
    public function index(): string {
        $this->load->language('extension/lodin/payment/lodin');
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['text_title']     = $this->language->get('text_title');
        $data['confirm']        = $this->url->link('extension/lodin/payment/lodin.confirm', '', true);
        $data['text_loading'] = $this->language->get('text_loading');
        $data['language'] = $this->config->get('config_language');
        $data['is_euro']        = $this->isEuroCurrency();
        $data['error_currency'] = $this->language->get('error_currency');
        return $this->load->view('extension/lodin/payment/lodin', $data);
    }
    
    public function confirm(): void {
        $this->load->language('extension/lodin/payment/lodin');
        $json = [];
        
        if (!isset($this->session->data['order_id'])) {
            $json['error'] = $this->language->get('error_order');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }
        if (!$this->isEuroCurrency()) {
            $json['error'] = $this->language->get('error_currency');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }
        
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        
        if (!$order_info) {
            $json['error'] = $this->language->get('error_order');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }
        
        try {
            $payment_link = $this->generatePaymentLink($order_info);
            
            if ($payment_link) {
                $this->model_checkout_order->addHistory(
                    $this->session->data['order_id'],
                    $this->config->get('payment_lodin_pending_status_id'),
                    'Awaiting Lodin RTP payment',
                    false
                );
                $json['redirect'] = $payment_link;
            } else {
                throw new \Exception('Failed to generate payment link');
            }
            
        } catch (\Exception $e) {
            $this->log->write('LODIN ERROR: ' . $e->getMessage());
            $json['error'] = $this->language->get('error_payment');
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function callback(): void {
        $this->log->write('=== LODIN WEBHOOK RECEIVED ===');
        $this->log->write('Request method: ' . $_SERVER['REQUEST_METHOD']);
        
        // Only accept POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->log->write('ERROR: Invalid request method');
            http_response_code(405);
            die('Method Not Allowed');
        }
        
        $payload = file_get_contents('php://input');
        $this->log->write('Webhook payload: ' . $payload);
        
        if (empty($payload)) {
            $this->log->write('ERROR: Empty payload');
            http_response_code(400);
            die('Bad Request');
        }
        
        // Verify signature
        $signature = $_SERVER['HTTP_X_WEBHOOK_SIGNATURE'] ?? null;
        
        if (!$this->verifyWebhookSignature($payload, $signature)) {
            $this->log->write('ERROR: Invalid signature');
            http_response_code(401);
            die('Unauthorized');
        }
        
        $data = json_decode($payload, true);
        
        if (!$data) {
            $this->log->write('ERROR: Invalid JSON');
            http_response_code(400);
            die('Invalid JSON');
        }
        
        $this->log->write('Parsed webhook data: ' . print_r($data, true));
        
        try {
            $this->handleWebhook($data);
            http_response_code(200);
            $this->log->write('=== LODIN WEBHOOK SUCCESS ===');
            die('OK');
        } catch (\Exception $e) {
            $this->log->write('ERROR: ' . $e->getMessage());
            http_response_code(500);
            die('Internal Server Error');
        }
    }
    
    private function verifyWebhookSignature(string $payload, ?string $received_signature): bool {
        if (!$received_signature) {
            $this->log->write('WARNING: No signature provided');
            return false;
        }
        
        $client_secret = $this->config->get('payment_lodin_client_secret');
        
        if (!$client_secret) {
            $this->log->write('ERROR: Client secret not configured');
            return false;
        }
        
        $expected_signature = $this->generateSignature($payload, $client_secret);
        
        $is_valid = hash_equals($expected_signature, $received_signature);
        
        $this->log->write('Signature verification: ' . ($is_valid ? 'PASS' : 'FAIL'));
        $this->log->write('Expected: ' . $expected_signature);
        $this->log->write('Received: ' . $received_signature);
        
        return $is_valid;
    }
    
    private function handleWebhook(array $data): void {
        $event_type     = $data['eventType']    ?? null;
        $invoice_id     = $data['invoiceId']    ?? null;
        $transaction_id = $data['transactionId'] ?? null;
        $amount         = $data['amount']        ?? null;
        
        if (!$event_type || !$invoice_id) {
            throw new \Exception('Missing required fields: eventType or invoiceId');
        }
        
        $this->log->write('Event type: ' . $event_type);
        $this->log->write('Invoice ID: ' . $invoice_id);
        $this->log->write('Transaction ID: ' . $transaction_id);
        
        // Extract order ID from invoice (ORDER-123-timestamp)
        $parts = explode('-', $invoice_id);
        if (count($parts) < 2) {
            throw new \Exception('Invalid invoice ID format: ' . $invoice_id);
        }
        
        $order_id = (int) $parts[1];
        $this->log->write('Order ID: ' . $order_id);
        
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($order_id);
        
        if (!$order_info) {
            throw new \Exception('Order not found: ' . $order_id);
        }
        
        $this->log->write('Found order, current status: ' . $order_info['order_status_id']);
        
        switch ($event_type) {
            case 'payment.succeeded':
            case 'payment.completed':
                $this->handlePaymentSuccess($order_id, $order_info, $data);
                break;
                
            case 'payment.failed':
            case 'payment.declined':
                $this->handlePaymentFailure($order_id, $order_info, $data);
                break;
                
            case 'payment.pending':
                $this->handlePaymentPending($order_id, $order_info, $data);
                break;
                
            default:
                $this->log->write('WARNING: Unknown event type: ' . $event_type);
        }
    }
    
    private function handlePaymentSuccess(int $order_id, array $order_info, array $data): void {
        $this->log->write('Processing successful payment for order: ' . $order_id);
        
        $completed_status_id = $this->config->get('payment_lodin_completed_status_id');
        
        // Vérification montant si présent
        if (!empty($data['amount'])) {
            $amount_paid     = (float) $data['amount'];
            $amount_expected = (float) $order_info['total'];
            
            if (abs($amount_paid - $amount_expected) > 0.01) {
                $this->log->write('ERROR: Amount mismatch! Expected: ' . $amount_expected . ' Got: ' . $amount_paid);
                throw new \Exception('Amount mismatch');
            }
            $this->log->write('Amount verified: ' . $amount_paid);
        } else {
            $this->log->write('WARNING: No amount in webhook, skipping amount check');
        }
        
        // Evite double traitement
        if ($order_info['order_status_id'] == $completed_status_id) {
            $this->log->write('WARNING: Order already marked as completed');
            return;
        }
        
        $transaction_id = $data['transactionId'] ?? 'N/A';
        
        $this->model_checkout_order->addHistory(
            $order_id,
            $completed_status_id,
            'Payment received via Lodin RTP. Transaction ID: ' . $transaction_id,
            true  // notify customer
        );
        
        $this->log->write('Order ' . $order_id . ' marked as completed');
    }
    
    private function handlePaymentFailure(int $order_id, array $order_info, array $data): void {
        $this->log->write('Processing failed payment for order: ' . $order_id);
        
        $failed_status_id = $this->config->get('payment_lodin_failed_status_id');
        $error_message    = $data['errorMessage'] ?? 'Unknown error';
        
        $this->model_checkout_order->addHistory(
            $order_id,
            $failed_status_id,
            'Payment failed via Lodin RTP: ' . $error_message,
            false
        );
        
        $this->log->write('Order ' . $order_id . ' marked as failed');
    }
    
    private function handlePaymentPending(int $order_id, array $order_info, array $data): void {
        $this->log->write('Processing pending payment for order: ' . $order_id);
        
        $pending_status_id = $this->config->get('payment_lodin_pending_status_id');
        
        $this->model_checkout_order->addHistory(
            $order_id,
            $pending_status_id,
            'Payment pending via Lodin RTP',
            false
        );
        
        $this->log->write('Order ' . $order_id . ' marked as pending');
    }
    
    private function generatePaymentLink(array $order_info): ?string {
        $client_id     = $this->config->get('payment_lodin_client_id');
        $client_secret = $this->config->get('payment_lodin_client_secret');
        
        if (!$client_id || !$client_secret) {
            throw new \Exception('Lodin configuration missing');
        }
        
        $invoice_id = 'ORDER-' . $order_info['order_id'] . '-' . time();
        $amount = number_format((float)$order_info['total'], 2, '.', '');
        $amount_float = round((float)$order_info['total'], 2);
        $amount_string = number_format($amount_float, 2, '.', '');
        $timestamp  = gmdate('Y-m-d\TH:i:s\Z');
        $payload = $client_id . $timestamp . $amount_string . $invoice_id;
        $signature  = $this->generateSignature($payload, $client_secret);
        
        $this->log->write('LODIN DEBUG - Invoice ID: ' . $invoice_id);
        $this->log->write('LODIN DEBUG - Amount: ' . $amount);
        $this->log->write('LODIN DEBUG - Signature: ' . $signature);

        $token = hash_hmac('sha256', $order_info['order_id'] . $order_info['total'], $this->config->get('payment_lodin_client_secret'));

        $return_url = $this->url->link('extension/lodin/payment/lodin|callback_return', 'order_id=' . $order_info['order_id'] . '&token=' . $token, true);
        
        $headers = [
            'Content-Type: application/json',
            'X-Client-Id: ' . $client_id,
            'X-Timestamp: ' . $timestamp,
            'X-Signature: ' . $signature,
            'X-Extension-Code: OPENCART',
        ];
        
        $body = [
            'amount'      => $amount_float,
            'invoiceId'   => $invoice_id,
            'paymentType' => 'INST',
            'description' => 'OpenCart Order #' . $order_info['order_id'],
            'cardId' => $invoice_id,
            'returnUrl'   => $return_url, // On envoie le même lien
            'cancelUrl'   => $return_url, 
        ];

        // Dans generatePaymentLink
        $this->log->write('TEST RETURN URL: ' . $return_url);
        
        $this->log->write('LODIN DEBUG - Request Body: ' . json_encode($body));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::RTP_API_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        
        $response  = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $this->log->write('LODIN API Response (' . $http_code . '): ' . $response);
        
        if ($http_code === 200) {
            $data = json_decode($response, true);
            return $data['url'] ?? null;
        }
        
        throw new \Exception('API error: ' . $response);
    }
    
    private function generateSignature(string $payload, string $secret): string {
        $raw_hmac = hash_hmac('sha256', $payload, $secret, true);
        $base64   = base64_encode($raw_hmac);
        return rtrim(strtr($base64, ['+' => '-', '/' => '_']), '=');
    }


    public function callback_return(): void {
    $this->load->model('checkout/order');

    $order_id = (int)$this->request->get['order_id'];
    $order_info = $this->model_checkout_order->getOrder($order_id);

    // 1. Sécurité : On vérifie le token
    $expected_token = hash_hmac('sha256', $order_id . $order_info['total'], $this->config->get('payment_lodin_client_secret'));
    
    if (!isset($this->request->get['token']) || !hash_equals($expected_token, $this->request->get['token'])) {
        $this->response->redirect($this->url->link('checkout/failure', '', true));
        return;
    }

    // 2. LA LOGIQUE : On vérifie le statut en base de données
    $completed_status_id = (int)$this->config->get('payment_lodin_completed_status_id');

    if ((int)$order_info['order_status_id'] === $completed_status_id) {
        // Le paiement est OK (confirmé par le webhook)
        $this->cart->clear();
        unset($this->session->data['order_id']);
        $this->response->redirect($this->url->link('checkout/success', '', true));
    } else {
        // Le paiement n'est pas OK (annulé, échoué ou en attente)
        $this->response->redirect($this->url->link('checkout/failure', '', true));
    }
}
private function isEuroCurrency(): bool {
    $currency_code = $this->session->data['currency'] 
        ?? $this->config->get('config_currency');
    return strtoupper((string)$currency_code) === 'EUR';
}
}