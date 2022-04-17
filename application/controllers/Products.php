<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Products";
		$data['content'] = "Products/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['masproduct'] = $this->MasProduct->GetAll()->result_array();
        }else{
            $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function Create()
    {
        $data['menukey'] = "Products";
		$data['content'] = "Products/Create";
        
        $this->load->view('Shared/_Layout', $data);
    }

    public function CreatePost()
    {
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Products/Index');
		}

        if ($this->MasProduct->GetProductByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product  Already Exist!');
			redirect('Products/Index');
		}

        $masproduct = array(
			'name' => $this->input->post('name'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant']
		);

		$this->MasProduct->Insert($masproduct);

        $this->session->set_flashdata('success', 'Product  Created Successfully!');
		redirect('Products/Index');
    }

    public function EditPost(){
        $this->form_validation->set_rules('id_product', 'id_product', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Products/Index');
		}

        if ($this->MasProductCMasProductategory->GetProductByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product  Already Exist!');
			redirect('Products/Index');
		}

        $masproduct = array(
            'id_product' => $this->input->post('id_product'),
			'name' => $this->input->post('name'),
		);

        $this->MasProduct->Update($masproduct);

        $this->session->set_flashdata('success', 'Product  Updated Successfully!');
		redirect('Products/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_product', 'id_product', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Products/Index');
		}

        $masproduct = array(
            'id_product' => $this->input->post('id_product'),
		);

        $this->MasProduct->Delete($masproduct);

        $this->session->set_flashdata('success', 'Product  Deleted Successfully!');
		redirect('Products/Index');
    }

    public function GetProductById()
    {
        $id_product = $this->input->post('id_product');
        $masproduct = $this->MasProduct->GetProductById($id_product);
        echo json_encode($masproduct->row());
    }
}
