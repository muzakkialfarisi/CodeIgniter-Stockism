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
		$this->load->model('MasWarehouse');
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

        $data['maswarehouse'] = $this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
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
            'id_warehouse'      => $this->input->post('id_warehouse'),
            'payment_status'    => $this->input->post('payment_status'),
            'date_due'          => $this->input->post('date_due'),
            'payment_price'     => $this->input->post('payment_price'),
            'delivery_status'   => $this->input->post('delivery_status'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_supplier'       => $this->input->post('id_supplier'),
            'tax_cost'          => $this->input->post('tax_cost')
        );
        $id_po = $this->IncPurchaseOrder->Insert($incpurchaseorder);

        for($i=0; $i < count($this->input->post('id_product')); $i++){
            $quantity_accepted = 0;
            if($this->input->post('delivery_status') == "Done")
            {
                $quantity_accepted = $this->input->post('quantity')[$i];
            }

            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();
            $incpurchaseorderproduct = array(
                'id_po'             => $id_po,
                'date_created'      => $this->input->post('date_created'),
                'id_product'        => $product->id_product,
                'sku'               => $product->sku,
                'quantity'          => $this->input->post('quantity')[$i],
                'quantity_accepted' => $quantity_accepted,
                'quantity_stock'    => $quantity_accepted,
                'purchase_price'    => $this->input->post('purchase_price')[$i],
                'subtotal'          => $this->input->post('quantity')[$i] * $this->input->post('purchase_price')[$i],
                'expired_date'      => $this->input->post('expired_date')[$i],
                'storage'           => $this->input->post('storage')[$i]
            );
            $this->IncPurchaseOrderProduct->Insert($incpurchaseorderproduct);

            $masproduct = array(
                'id_product'    => $product->id_product,
                'purchase_price'=> $this->input->post('purchase_price')[$i]
            );
            $this->MasProduct->Update($masproduct);
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

    public function EditPurchaseOrderProductPost()
    {
        $this->form_validation->set_rules('id_poproduct', 'id_poproduct', 'required');
        $this->form_validation->set_rules('sku', 'sku', 'required');
        $this->form_validation->set_rules('purchase_price', 'purchase_price', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('PurchaseOrders/Detail/'.$this->input->post('id_po'));
		}

        $incpurchaseorderproduct = array(
            'id_poproduct'      => $this->input->post('id_poproduct'),
            'purchase_price'    => $this->input->post('purchase_price'),
            'expired_date'      => $this->input->post('expired_date'),
            'storage'           => $this->input->post('storage')
        );

        $this->IncPurchaseOrderProduct->Update($incpurchaseorderproduct);
        $this->session->set_flashdata('success', 'Updated Successfully!');
        redirect('PurchaseOrders/Detail/'.$this->input->post('id_po'));
    }

    public function GetPurchaseOrderById()
    {
        $id_po = $this->input->post('id_po');
        $incpurchaseorder = $this->IncPurchaseOrder->GetPurchaseOrderById($id_po);
        echo json_encode($incpurchaseorder->row());
    }
}