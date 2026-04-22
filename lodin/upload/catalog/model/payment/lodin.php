<?php
namespace Opencart\Catalog\Model\Extension\Lodin\Payment;

class Lodin extends \Opencart\System\Engine\Model {
    
    /**
     * Get payment method details for checkout
     */
    public function getMethods(array $address): array {
        $this->load->language('extension/lodin/payment/lodin');
        
        $status = true;
        
        // Check if module is enabled
        if (!$this->config->get('payment_lodin_status')) {
            $status = false;
        }
        
        // Check if client credentials are configured
        if (!$this->config->get('payment_lodin_client_id') || !$this->config->get('payment_lodin_client_secret')) {
            $status = false;
        }
        
        $method_data = [];
        
        if ($status) {
            $option_data['lodin'] = [
                'code' => 'lodin.lodin',
                'name' => $this->language->get('text_title')
            ];
            
            $method_data = [
                'code'       => 'lodin',
                'name'       => $this->language->get('heading_title'),
                'option'     => $option_data,
                'sort_order' => $this->config->get('payment_lodin_sort_order')
            ];
        }
        
        return $method_data;
    }
}
