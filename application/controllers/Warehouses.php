<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouses extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasWarehouse');
    }
	
	public function Index()
	{
		$data['menukey'] = "Warehouses";
		$data['content'] = "Warehouses/Index";
        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['maswarehouse'] = $this->MasWarehouse->GetAll()->result_array();
        }else{
            $data['maswarehouse'] = $this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_user'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

}
