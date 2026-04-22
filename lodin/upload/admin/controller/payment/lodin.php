<?php
namespace Opencart\Admin\Controller\Extension\Lodin\Payment;

class Lodin extends \Opencart\System\Engine\Controller {
    
    public function index(): void {
        $this->load->language('extension/lodin/payment/lodin');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        ];
        
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment')
        ];
        
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/lodin/payment/lodin', 'user_token=' . $this->session->data['user_token'])
        ];
        
        $data['save'] = $this->url->link('extension/lodin/payment/lodin.save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment');
        
        $data['payment_lodin_client_id'] = $this->config->get('payment_lodin_client_id');
        $data['payment_lodin_client_secret'] = $this->config->get('payment_lodin_client_secret');
        $data['payment_lodin_status'] = $this->config->get('payment_lodin_status');
        $data['payment_lodin_sort_order'] = $this->config->get('payment_lodin_sort_order');
        
        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        
        $data['payment_lodin_pending_status_id'] = $this->config->get('payment_lodin_pending_status_id');
        $data['payment_lodin_completed_status_id'] = $this->config->get('payment_lodin_completed_status_id');
        $data['payment_lodin_failed_status_id'] = $this->config->get('payment_lodin_failed_status_id');
        
        $data['webhook_url'] = HTTP_CATALOG . 'index.php?route=extension/lodin/payment/lodin.callback';
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('extension/lodin/payment/lodin', $data));
    }
    
    public function save(): void {
        $this->load->language('extension/lodin/payment/lodin');
        
        $json = [];
        
        if (!$this->user->hasPermission('modify', 'extension/lodin/payment/lodin')) {
            $json['error'] = $this->language->get('error_permission');
        }
        
        if (!$this->request->post['payment_lodin_client_id']) {
            $json['error'] = $this->language->get('error_client_id');
        }
        
        if (!$this->request->post['payment_lodin_client_secret']) {
            $json['error'] = $this->language->get('error_client_secret');
        }
        
        if (!$json) {
            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('payment_lodin', $this->request->post);
            
            $json['success'] = $this->language->get('text_success');
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function install(): void {
        $this->load->model('setting/setting');
        
        $defaults = [
            'payment_lodin_status' => 0,
            'payment_lodin_sort_order' => 1,
            'payment_lodin_pending_status_id' => 1,
            'payment_lodin_completed_status_id' => 2,
            'payment_lodin_failed_status_id' => 10,
        ];
        
        $this->model_setting_setting->editSetting('payment_lodin', $defaults);
    }
    
    public function uninstall(): void {
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('payment_lodin');
    }
}
