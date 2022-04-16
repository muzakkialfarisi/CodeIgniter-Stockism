<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasSupplier');
    }
	
	public function Index()
	{
		$data['menukey'] = "Suppliers";
		$data['content'] = "Suppliers/Index";
        $data['massupplier'] = $this->MasSupplier->GetAll();
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddSupplierProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address');
        $this->form_validation->set_rules('phone_number', 'phone_number');
        $this->form_validation->set_rules('email', 'email');       

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Suppliers/Index');
		}	

		if ($this->MasSupplier->GetSupplierByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Supplier Already Exist!');
			redirect('Suppliers/Index');
		}
        
        $DataSession = $this->session->all_userdata();

		$massupplier = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $DataSession['logged_in']['email_tenant']
		);

		$this->MasSupplier->Insert($massupplier);

		$this->session->set_flashdata('success', 'Registered Supplier Successfully!');
		redirect('Suppliers/Index');
	}


}
