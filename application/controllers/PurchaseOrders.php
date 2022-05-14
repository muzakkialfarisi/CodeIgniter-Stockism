<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrders extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('IncPurchaseOrder');
		$this->load->model('IncPurchaseOrderProduct');
        $this->load->model('MasUtang');
		$this->load->model('MasSupplier');
		$this->load->model('MasProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Purchase Orders";
        $data['javascripts'] = "PurchaseOrders/Index";
		$data['content'] = "PurchaseOrders/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetAll()->result_array();
        }else{
            $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetPurchaseOrderByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function Create()
    {
        $data['menukey'] = "Purchase Orders";
        $data['javascripts'] = "PurchaseOrders/Create";
		$data['content'] = "PurchaseOrders/Create";

        $data['massupplier'] = $this->MasSupplier->GetSupplierByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function CreatePost()
    {
        if($this->input->post('id_product') == null){
            $this->session->set_flashdata('error', 'Product Notfound!');
		    redirect('PurchaseOrders/Create');
        }

        $invoice_po = $this->input->post('invoice_po');
        if($invoice_po == null)
        {
            $invoice_po = date("ymd-His");
        }
        
        $incpurchaseorder = array(
            'date_created'      => $this->input->post('date_created'),
            'invoice_po'        => $invoice_po,
            'createdby'         => $this->session->userdata['logged_in']['email'],
            'email_tenant'      => $this->session->userdata['logged_in']['email_tenant'],
            'payment_status'    => $this->input->post('payment_status'),
            'date_due'          => $this->input->post('date_due'),
            'payment_price'     => $this->input->post('payment_price'),
            'delivery_status'   => $this->input->post('delivery_status'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_supplier'       => $this->input->post('id_supplier'),
            'tax_cost'          => $this->input->post('tax_cost')
        );
        $id_po = $this->IncPurchaseOrder->Insert($incpurchaseorder);

        $sum_product = count($this->input->post('id_product'));
        for($i=0; $i < $sum_product; $i++){
            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();

            $incpurchaseorderproduct = array(
                'id_po'         => $id_po,
                'date_created'  => $this->input->post('date_created'),
                'id_product'    => $product->id_product,
                'sku'           => $product->sku,
                'quantity'      => $this->input->post('quantity')[$i],
                'purchase_price'=> $this->input->post('purchase_price')[$i],
                'subtotal'      => $this->input->post('quantity')[$i] * $this->input->post('purchase_price')[$i],
                'expired_date'  => $this->input->post('expired_date')[$i],
                'storage'       => $this->input->post('storage')[$i]
            );
            $this->IncPurchaseOrderProduct->Insert($incpurchaseorderproduct);
        }

        if($this->input->post('payment_status') == "Debt")
        {
            $masutang = array(
                'id_po'         => $id_po,
                'total_utang'   => $this->db->query("SELECT SUM(subtotal) AS sum FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->sum,
                'total_bayar'   => 0,
                'status'        => "Debt"
            );
            $this->MasUtang->Insert($masutang);
        }

        if($this->input->post('delivery_status') == "Done")
        {
            for($i=0; $i < $sum_product; $i++){
                $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();
                $masproduct = array(
                    'id_product'    => $product->id_product,
                    'quantity'      => $product->quantity + $this->input->post('quantity')[$i],
                    'purchase_price'=> $this->input->post('purchase_price')[$i]
                );
                $this->MasProduct->Update($masproduct);
            }
        }

        $this->session->set_flashdata('success', 'Purchase Order Created Successfully!');
        redirect('PurchaseOrders/Index');
    }

    public function Detail($id_po)
    {
        $data['menukey'] = "Purchase Orders";
        $data['javascripts'] = "PurchaseOrders/Detail";
		$data['content'] = "PurchaseOrders/Detail";

        $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetPurchaseOrderById($id_po)->row();
        $data['incpurchaseorderproduct'] = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($id_po)->result_array();
        $this->load->view('Shared/_Layout', $data);
    }
}