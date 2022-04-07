<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasTenant');
        $this->load->model('MasCustomer');
    }
	
	public function Index()
	{
		$data['menukey'] = "Customers";
		$data['content'] = "Customers/Index";
        $data['mascustomertype'] = $this->MasCustomer->GetAllCustomerType()->result_array();
		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	$data['mascustomer'] = $this->MasCustomer->GetAll()->result_array();
		}else{
			$data['mascustomer'] = $this->MasCustomer->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		}
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddCustomerProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
        $idcustomertype = $this->MasCustomer->GetIdCustomertypeByName($this->input->post('Id_CustomerType'))->row()->Id_CustomerType;
        $this->form_validation->set_rules('address', 'address');
        $this->form_validation->set_rules('phone_number', 'phone_number');
        $this->form_validation->set_rules('email', 'email');  

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Customers/Index');
		}	

		if ($this->MasCustomer->GetCustomerByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Customers/Index');
		}

        $options['cost'] = 12;
        
        $DataSession = $this->session->all_userdata();
        
		$mascustomer = array(
			'name' => $this->input->post('name'),
            'id_customertype' => $idcustomertype,
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $DataSession['logged_in']['email_user']
		);

		$this->MasCustomer->Insert($mascustomer);

		$this->session->set_flashdata('success', 'Registered Supplier Successfully!');
		redirect('Customers/Index');
	}


}
