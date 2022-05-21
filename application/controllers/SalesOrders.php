<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrders extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('OutSalesOrder');
		$this->load->model('MasSupplier');
		$this->load->model('MasProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Index";
		$data['content'] = "SalesOrders/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['outsalesorder'] = $this->OutSalesOrder->GetAll()->result_array();
        }else{
            $data['outsalesorder'] = $this->OutSalesOrder->GetSalesOrderByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function Create()
    {
        $data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Create";
		$data['content'] = "SalesOrders/Create";

        $data['massupplier'] = $this->MasSupplier->GetSupplierByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

}
