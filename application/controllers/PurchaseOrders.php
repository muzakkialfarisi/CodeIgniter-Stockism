<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrders extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('IncPurchaseOrder');
		$this->load->model('MasSupplier');
		$this->load->model('MasProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Purchase Orders";
        $data['javascripts'] = "PurchaseOrders/Index";
		$data['content'] = "PurchaseOrders/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetAll()->result_array();
        }else{
            $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetPurchaseOrderByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function Create()
    {
        $data['menukey'] = "Purchase Orders";
        $data['javascripts'] = "PurchaseOrders/Create";
		$data['content'] = "PurchaseOrders/Create";

        $data['massupplier'] = $this->MasSupplier->GetSupplierByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

}
