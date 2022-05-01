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
		$this->load->model('MasProductUnit');
        $this->load->model('MasProductCategory');
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
        $data['javascripts'] = "Products";
		$data['content'] = "Products/Create";

        $data['masproductunit'] = $this->MasProductUnit->GetProductUnitByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproductcategory'] = $this->MasProductCategory->GetProductCategoryByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function CreatePost()
    {
        if ($this->MasProduct->GetProductByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product  Already Exist!');
			redirect('Products/Index');
		}

        $picture = "default-product.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

        $sku = $this->input->post('sku');
        if($this->input->post('sku') == "AutoGenerated"){
            //$sku = $this->SkuBuilder($this->MasTenant->GetTenantByEmail($this->session->userdata['logged_in']['email_tenant'])->row()->)
        }

        if($this->MasProduct->GetProductBySkuByTenant($sku, $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
            $this->session->set_flashdata('error', 'SKU Already Exist!');
			redirect('Products/Index');
        }

        $code = $this->input->post('code');
        if($this->input->post('code') == "AutoGenerated"){
            //$picture = functtion add picture
        }

        if($this->MasProduct->GetProductByCodeByTenant($code, $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
            $this->session->set_flashdata('error', 'QRCode Already Exist!');
			redirect('Products/Index');
        }

        $masproduct = array(
			'name' => $this->input->post('name'),
			'sku' => $sku,
			'code' => $code,
			'quantity' => $this->input->post('quantity'),
			'purchase_price' => $this->input->post('purchase_price'),
			'selling_price' => $this->input->post('selling_price'),
			'panjang' => $this->input->post('panjang'),
			'lebar' => $this->input->post('lebar'),
			'tinggi' => $this->input->post('tinggi'),
			'actual_weight' => $this->input->post('actual_weight'),
			'vol_weight' => $this->input->post('vol_weight'),
			'description' => $this->input->post('description'),
			'id_productunit' => $this->input->post('id_productunit'),
			'id_productcategory' => $this->input->post('id_productcategory'),
			'expired_date' => $this->input->post('expired_date'),
			'minimum_stock' => $this->input->post('minimum_stock'),
			'storage' => $this->input->post('storage'),
			'status' => $this->input->post('status'),
            'picture' => $picture,
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

    private function SkuBuilder($tenant)
    {
        $before = date("ymd");
        $asfter = sprintf('%04d',1);
        return sprintf($tenant.$digit,$tenant);
    }
}
