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
        $this->load->model('IncPurchaseOrderProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Products";
        $data['javascripts'] = "Products/Index";
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
        $data['javascripts'] = "Products/Create";
		$data['content'] = "Products/Create";

        $data['masproductunit'] = $this->MasProductUnit->GetProductUnitByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproductcategory'] = $this->MasProductCategory->GetProductCategoryByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function CreatePost()
    {
        if ($this->MasProduct->GetProductByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Product  Already Exist!');
			redirect('Products/Create');
		}

        $sku = $this->input->post('sku');
        if($this->input->post('sku') == "Auto Generated"){
            $sku = date("ymd-His");
        }

        if($this->MasProduct->GetProductBySkuByTenant($sku, $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
            $this->session->set_flashdata('error', 'SKU Already Exist!');
			redirect('Products/Create');
        }

        $code = $this->input->post('code');
        if($this->input->post('code') == "Auto Generated"){
            $code = $this->CodeBuilder();
        }

        if($this->MasProduct->GetProductByCodeByTenant($code, $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
            $this->session->set_flashdata('error', 'QRCode Already Exist!');
			redirect('Products/Create');
        }

        $picture = "default-product.png";
        if(!empty($_FILES['picture']['name'])){
            $picture = $this->UploadProductPicture($code);
        }

        $masproduct = array(
			'name' => $this->input->post('name'),
			'sku' => $sku,
			'code' => $code,
			'code_image' => $this->QRCodeBuilder($code),
			'quantity' => $this->input->post('quantity'),
			'purchase_price' => $this->input->post('purchase_price'),
			'selling_price' => $this->input->post('selling_price'),
			'panjang' => $this->input->post('panjang'),
			'lebar' => $this->input->post('lebar'),
			'tinggi' => $this->input->post('tinggi'),
			'actual_weight' => $this->input->post('actual_weight'),
			'description' => $this->input->post('description'),
			'id_productunit' => $this->input->post('id_productunit'),
			'id_productcategory' => $this->input->post('id_productcategory'),
			'minimum_stock' => $this->input->post('minimum_stock'),
			'status' => "Active",
            'picture' => $picture,
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant']
		);

        $id_product = $this->MasProduct->Insert($masproduct);

        if($this->input->post('quantity') > 0)
        {
            $incpurchaseorderproduct = array(
                'id_product' => $id_product,
                'sku' => $sku,
                'quantity' => $this->input->post('quantity'),
                'purchase_price' => $this->input->post('purchase_price'),
                'subtotal' => $this->input->post('quantity') * $this->input->post('purchase_price'),
                'expired_date' => $this->input->post('expired_date'),
                'storage' => $this->input->post('storage')
            );
            $this->IncPurchaseOrderProduct->Insert($incpurchaseorderproduct);
        }

        $this->session->set_flashdata('success', 'Product Created Successfully!');
		redirect('Products/Index');
    }

    public function Detail($id_product)
    {
        $data['menukey'] = "Products";
        $data['javascripts'] = "Products/Detail";
		$data['content'] = "Products/Detail";

        $data['masproduct'] = $this->MasProduct->GetProductById($id_product)->row();
        $data['masproductunit'] = $this->MasProductUnit->GetProductUnitById($data['masproduct']->id_productunit)->row();
        $data['masproductcategory'] = $this->MasProductCategory->GetProductCategoryById($data['masproduct']->id_productcategory)->row();
        
        $data['incpurchaseorderproduct'] = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByProductId($id_product)->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function EditPurchaseOrderProductPost()
    {
        $this->form_validation->set_rules('id_poproduct', 'id_poproduct', 'required');
        $this->form_validation->set_rules('sku', 'sku', 'required');
        $this->form_validation->set_rules('purchase_price', 'purchase_price', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Products/Detail/'.$this->input->post('id_product'));
		}

        $incpurchaseorderproduct = array(
            'id_poproduct'      => $this->input->post('id_poproduct'),
            'purchase_price'    => $this->input->post('purchase_price'),
            'expired_date'      => $this->input->post('expired_date'),
            'storage'           => $this->input->post('storage')
        );

        $this->IncPurchaseOrderProduct->Update($incpurchaseorderproduct);
        $this->session->set_flashdata('success', 'Updated Successfully!');
        redirect('Products/Detail/'.$this->input->post('id_product'));
    }

    public function Edit($id_product)
    {
        $data['menukey'] = "Products";
        $data['javascripts'] = "Products/Edit";
		$data['content'] = "Products/Edit";

        $data['masproduct'] = $this->MasProduct->GetProductById($id_product)->row();
        $data['masproductunitid'] = $this->MasProductUnit->GetProductUnitById($data['masproduct']->id_productunit)->row();
        $data['masproductcategoryid'] = $this->MasProductCategory->GetProductCategoryById($data['masproduct']->id_productcategory)->row();
        
        $data['masproductunit'] = $this->MasProductUnit->GetProductUnitByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproductcategory'] = $this->MasProductCategory->GetProductCategoryByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function EditPost(){
        if ($this->MasProduct->GetProductByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 1){
			$this->session->set_flashdata('error', 'Product  Already Exist!');
			redirect('Products/Edit'.$this->input->post('id_product'));
		}

        $sku = $this->input->post('sku');
        if($this->input->post('sku') == "Auto Generated"){
            $sku = date("ymd-His");
        }

        if($this->MasProduct->GetProductBySkuByTenant($sku, $this->session->userdata['logged_in']['email_tenant'])->row() > 1){
            $this->session->set_flashdata('error', 'SKU Already Exist!');
			redirect('Products/Edit'.$this->input->post('id_product'));
        }

        $code = $this->input->post('code');
        if($this->input->post('code') == "Auto Generated"){
            $code = $this->CodeBuilder();
        }

        if($this->MasProduct->GetProductByCodeByTenant($code, $this->session->userdata['logged_in']['email_tenant'])->row() > 1){
            $this->session->set_flashdata('error', 'QRCode Already Exist!');
			redirect('Products/Edit'.$this->input->post('id_product'));
        }

        $picture = $this->MasProduct->GetProductById($this->input->post('id_product'))->row()->picture;
        if(!empty($_FILES['picture']['name'])){
            if($picture != "defaut-picture.png"){
                $this->load->helper("file");
                delete_files(FCPATH.'/assets/img/warehouses/'.$picture);
            }
            $picture = $this->UploadProductPicture($code);
        }

        $masproduct = array(
            'id_product' => $this->input->post('id_product'),
			'name' => $this->input->post('name'),
			'sku' => $sku,
			'code' => $code,
			'code_image' => $this->QRCodeBuilder($code),
			'quantity' => $this->input->post('quantity'),
			'purchase_price' => $this->input->post('purchase_price'),
			'selling_price' => $this->input->post('selling_price'),
			'panjang' => $this->input->post('panjang'),
			'lebar' => $this->input->post('lebar'),
			'tinggi' => $this->input->post('tinggi'),
			'actual_weight' => $this->input->post('actual_weight'),
			'description' => $this->input->post('description'),
			'id_productunit' => $this->input->post('id_productunit'),
			'id_productcategory' => $this->input->post('id_productcategory'),
			'minimum_stock' => $this->input->post('minimum_stock'),
			//'status' => "Active",
            'picture' => $picture,
			//'email_tenant' => $this->session->userdata['logged_in']['email_tenant']
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

        $this->session->set_flashdata('success', 'Product Deleted Successfully!');
		redirect('Products/Index');
    }

    public function GetProductById()
    {
        $id_product = $this->input->post('id_product');
        $masproduct = $this->MasProduct->GetProductById($id_product);
        echo json_encode($masproduct->row());
    }

    private function CodeBuilder()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    private function QRCodeBuilder($code){
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/products/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_code = $code.'.png'; //buat name dari qr code sesuai dengan 
 
        $params['data'] = $code; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_code; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        return $image_code;
    }

    private function UploadProductPicture($name)
    {
        $config['upload_path']          = FCPATH.'/assets/img/products/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $name;
        $config['overwrite']            = true;
        $config['max_size']             = 512; // 1MB

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('picture')) {
            return "error";
        }
        $uploaded_data = $this->upload->data();
        return $uploaded_data['file_name'];
    }
}
