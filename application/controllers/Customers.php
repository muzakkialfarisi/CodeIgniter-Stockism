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
		$data['javascripts'] = "Customers/Index";
		$data['content'] = "Customers/Index";
        $data['mascustomertype'] = $this->MasCustomer->GetAllCustomerType()->result_array();
		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	$data['mascustomer'] = $this->MasCustomer->GetAll()->result_array();
		}else{
			$data['mascustomer'] = $this->MasCustomer->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		}
        $this->load->view('Shared/_Layout', $data);
	}

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
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
        
		$mascustomer = array(
			'name' => $this->input->post('name'),
            'id_customertype' => $this->input->post('Id_CustType'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'status' => 'active'
		);

		$this->MasCustomer->Insert($mascustomer);

		$this->session->set_flashdata('success', 'Registered Supplier Successfully!');
		redirect('Customers/Index');
	}

	public function EditPost(){
		$this->form_validation->set_rules('id_customer', 'id_customer', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address');
        $this->form_validation->set_rules('phone_number', 'phone_number');
        $this->form_validation->set_rules('email', 'email');  

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Customers/Index');
		}

        $mascustomer = array(
            'id_customer' => $this->input->post('id_customer'),
			'name' => $this->input->post('name'),
            'id_customertype' =>  $this->input->post('Id_CustType'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->input->post('email_tenant'),
			'status' => 'active'
		);

        $this->MasCustomer->Update($mascustomer);

        $this->session->set_flashdata('success', 'Customers Updated Successfully!');
		redirect('Customers/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_customer', 'id_customer', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Customers/Index');
		}

        $mascustomer = array(
            'id_customer' => $this->input->post('id_customer'),
		);

        $this->MasCustomer->Delete($mascustomer);

        $this->session->set_flashdata('success', 'Customer Deleted Successfully!');
		redirect('Customers/Index');
    }

    public function GetCustomerById()
    {
        $id_customer = $this->input->post('id_customer');
        $mascustomer = $this->MasCustomer->GetCustomerById($id_customer);
        echo json_encode($mascustomer->row());
    }
}
