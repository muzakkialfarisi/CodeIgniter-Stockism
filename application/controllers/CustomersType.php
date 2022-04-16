<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomersType extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasCustomerType');
    }
	
	public function Index()
	{
		$data['menukey'] = "CustomersType";
		$data['content'] = "CustomersType/Index";
		$data['mascustomertype'] = $this->MasCustomerType->GetAll()->result_array();
		// if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	
		// }else{
		// 	$data['mascustomertype'] = $this->MasCustomerType->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		// }
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddCustomerTypeProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('CustomersType/Index');
		}	

		if ($this->MasCustomerType->GetCustomerTypeByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Customer Type Already Exist!');
			redirect('CustomersType/Index');
		}

        $options['cost'] = 12;
        $data['count_customertype'] = $this->MasCustomerType->GetCustomerTypeCountId()->row()->count_customertype;
		$mascustomertype = array(
			'Id_CustomerType' => $data['count_customertype'] + 1,
			'name' => $this->input->post('name')
		);

		$this->MasCustomerType->Insert($mascustomertype);

		$this->session->set_flashdata('success', 'Add Customer Type Successfully!');
		redirect('CustomersType/Index');
	}

}
