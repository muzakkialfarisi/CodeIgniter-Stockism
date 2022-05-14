<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductUnits extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasProductUnit');
    }
	
	public function Index()
	{
		$data['menukey'] = "Products";
        $data['javascripts'] = "ProductUnits";
		$data['content'] = "ProductUnits/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['masproductunit'] = $this->MasProductUnit->GetAll()->result_array();
        }else{
            $data['masproductunit'] = $this->MasProductUnit->GetProductUnitByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function CreatePost()
    {
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductUnits/Index');
		}

        if ($this->MasProductUnit->GetProductUnitByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product Unit Already Exist!');
			redirect('ProductUnits/Index');
		}

        $masproductunit = array(
			'name' => $this->input->post('name'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant']
		);

		$this->MasProductUnit->Insert($masproductunit);

        $this->session->set_flashdata('success', 'Product Unit Created Successfully!');
		redirect('ProductUnits/Index');
    }

    public function EditPost(){
        $this->form_validation->set_rules('id_productunit', 'id_productunit', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductUnits/Index');
		}

        if ($this->MasProductUnit->GetProductUnitByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product Unit Already Exist!');
			redirect('ProductUnits/Index');
		}

        $masproductunit = array(
            'id_productunit' => $this->input->post('id_productunit'),
			'name' => $this->input->post('name'),
		);

        $this->MasProductUnit->Update($masproductunit);

        $this->session->set_flashdata('success', 'Product Unit Updated Successfully!');
		redirect('ProductUnits/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_productunit', 'id_productunit', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductUnits/Index');
		}

        $masproductunit = array(
            'id_productunit' => $this->input->post('id_productunit'),
		);

        $this->MasProductUnit->Delete($masproductunit);

        $this->session->set_flashdata('success', 'Product Unit Deleted Successfully!');
		redirect('ProductUnits/Index');
    }

    public function GetProductUnitById()
    {
        $id_productunit = $this->input->post('id_productunit');
        $masproductunit = $this->MasProductUnit->GetProductUnitById($id_productunit);
        echo json_encode($masproductunit->row());
    }

}
