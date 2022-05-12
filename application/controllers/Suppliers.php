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
		$data['javascripts'] = "Suppliers/Index";
		$data['content'] = "Suppliers/Index";

		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['massupplier'] = $this->MasSupplier->GetAll()->result_array();
        }else{
            $data['massupplier'] = $this->MasSupplier->GetSupplierByTenant($this->session->userdata['logged_in']['user_id'])->result_array();
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
			redirect('Suppliers/Index');
		}	

		if ($this->MasSupplier->GetSupplierByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Supplier Already Exist!');
			redirect('Suppliers/Index');
		}

		$massupplier = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['user_id'],
			'status' => 'active'
		);

		$this->MasSupplier->Insert($massupplier);

		$this->session->set_flashdata('success', 'Registered Supplier Successfully!');
		redirect('Suppliers/Index');
	}

	public function EditPost(){
		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address');
        $this->form_validation->set_rules('phone_number', 'phone_number');
        $this->form_validation->set_rules('email', 'email');    

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Suppliers/Index');
		}

        $massupplier = array(
            'id_supplier' => $this->input->post('id_supplier'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['user_id'],
			'status' => 'active'
		);

        $this->MasSupplier->Update($massupplier);

        $this->session->set_flashdata('success', 'Supplier Updated Successfully!');
		redirect('Suppliers/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Suppliers/Index');
		}

        $massupplier = array(
            'id_supplier' => $this->input->post('id_supplier'),
		);

        $this->MasSupplier->Delete($massupplier);

        $this->session->set_flashdata('success', 'Supplier Deleted Successfully!');
		redirect('Suppliers/Index');
    }

    public function GetSupplierById()
    {
        $id_supplier = $this->input->post('id_supplier');
        $massupplier = $this->MasSupplier->GetSupplierById($id_supplier);
        echo json_encode($massupplier->row());
    }

}
