<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderProducts extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('IncPurchaseOrder');
		$this->load->model('IncPurchaseOrderProduct');
        $this->load->model('MasUtang');
		$this->load->model('MasWarehouse');
		$this->load->model('MasSupplier');
		$this->load->model('MasProduct');
    }
	
	public function GetPurchaseOrderProductById()
    {
        $id_poproduct = $this->input->post('id_poproduct');
        $incpurchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductById($id_poproduct);
        echo json_encode($incpurchaseorderproduct->row());
    }
    
}