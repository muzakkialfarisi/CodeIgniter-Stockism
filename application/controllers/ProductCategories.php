<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategories extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasProductCategory');
    }
	
	public function Index()
	{
		$data['menukey'] = "Products";
		$data['content'] = "ProductCategories/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['masproductcategory'] = $this->MasProductCategory->GetAll()->result_array();
        }else{
            $data['masproductcategory'] = $this->MasProductCategory->GetProductCategoryByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function CreatePost()
    {
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductCategories/Index');
		}

        if ($this->MasProductCategory->GetProductCategoryByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product Category Already Exist!');
			redirect('ProductCategories/Index');
		}

        $masproductcategory = array(
			'name' => $this->input->post('name'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant']
		);

		$this->MasProductCategory->Insert($masproductcategory);

        $this->session->set_flashdata('success', 'Product Category Created Successfully!');
		redirect('ProductCategories/Index');
    }

    public function EditPost(){
        $this->form_validation->set_rules('id_productcategory', 'id_productcategory', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductCategories/Index');
		}

        if ($this->MasProductCategory->GetProductCategoryByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product Category Already Exist!');
			redirect('ProductCategories/Index');
		}

        $masproductcategory = array(
            'id_productcategory' => $this->input->post('id_productcategory'),
			'name' => $this->input->post('name'),
		);

        $this->MasProductCategory->Update($masproductcategory);

        $this->session->set_flashdata('success', 'Product Category Updated Successfully!');
		redirect('ProductCategories/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_productcategory', 'id_productcategory', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('ProductCategories/Index');
		}

        $masproductcategory = array(
            'id_productcategory' => $this->input->post('id_productcategory'),
		);

        $this->MasProductCategory->Delete($masproductcategory);

        $this->session->set_flashdata('success', 'Product Category Deleted Successfully!');
		redirect('ProductCategories/Index');
    }

    public function GetProductCategoryById()
    {
        $id_productcategory = $this->input->post('id_productcategory');
        $masproductcategory = $this->MasProductCategory->GetProductCategoryById($id_productcategory);
        echo json_encode($masproductcategory->row());
    }
}
