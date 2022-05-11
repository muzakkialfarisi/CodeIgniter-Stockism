<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerTypes extends CI_Controller {

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
		$data['menukey'] = "CustomerTypes";
		$data['javascripts'] = "CustomerTypes/Index";
		$data['content'] = "CustomerTypes/Index";
		$data['mascustomertype'] = $this->MasCustomerType->GetAll()->result_array();

        $this->load->view('Shared/_Layout', $data);
	}

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('CustomersTypes/Index');
		}	

		if ($this->MasCustomerType->GetCustomerTypeByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Customer Type Already Exist!');
			redirect('CustomersTypes/Index');
		}

        $options['cost'] = 12;
        $data['count_customertype'] = $this->MasCustomerType->GetCustomerTypeCountId()->row()->count_customertype;
		$mascustomertype = array(
			'Id_CustomerType' => $data['count_customertype'] + 1,
			'name' => $this->input->post('name')
		);

		$this->MasCustomerType->Insert($mascustomertype);

		$this->session->set_flashdata('success', 'Add Customer Type Successfully!');
		redirect('CustomerTypes/Index');
	}

	public function DeletePost(){
        $this->form_validation->set_rules('Id_CustomerType', 'Id_CustomerType', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Customers/Index');
		}

        $mascustomertype = array(
            'Id_CustomerType' => $this->input->post('Id_CustomerType'),
		);

        $this->MasCustomerType->Delete($mascustomertype);

        $this->session->set_flashdata('success', 'Customer Deleted Successfully!');
		redirect('CustomerTypes/Index');
    }

	public function GetAllCustomerType()
    {
        $mascustomertype = $this->MasCustomerType->GetAll();
        echo json_encode($mascustomertype->result_array());
    }

	public function GetCustomerTypeById()
    {
        $Id_CustomerType = $this->input->post('Id_CustomerType');
        $mascustomertype = $this->MasCustomerType->GetCustomerTypeById($Id_CustomerType);
        echo json_encode($mascustomertype->row());
    }

}
