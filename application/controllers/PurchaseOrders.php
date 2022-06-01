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
        $this->load->model('MasUtangAngsuran');
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
        if($this->input->post('id_product') == null)
        {
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
            'delivery_status'   => $this->input->post('delivery_status'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_supplier'       => $this->input->post('id_supplier'),
            'tax_cost'          => $this->input->post('tax_cost')
        );
        $id_po = $this->IncPurchaseOrder->Insert($incpurchaseorder);

        if($id_po == null){
            $this->session->set_flashdata('error', 'Invalid Insert Purchase Order!');
		    redirect('PurchaseOrders/Create');
        }

        for($i=0; $i < count($this->input->post('id_product')); $i++){
            $quantity_accepted = 0;
            if($this->input->post('delivery_status') == "Done")
            {
                $quantity_accepted = $this->input->post('quantity')[$i];
            }

            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();
            if($product == null){
                $this->session->set_flashdata('error', 'IProduct Notfound!');
		        redirect('PurchaseOrders/Create');
            }
            $incpurchaseorderproduct = array(
                'id_po'             => $id_po,
                'date_created'      => $this->input->post('date_created'),
                'id_product'        => $product->id_product,
                'sku'               => $product->sku,
                'quantity'          => $this->input->post('quantity')[$i],
                'quantity_accepted' => $quantity_accepted,
                'purchase_price'    => $this->input->post('purchase_price')[$i],
                'subtotal'          => $this->input->post('quantity')[$i] * $this->input->post('purchase_price')[$i],
                'expired_date'      => $this->input->post('expired_date')[$i],
                'storage'           => $this->input->post('storage')[$i]
            );
            if(!$this->IncPurchaseOrderProduct->Insert($incpurchaseorderproduct)){
                $this->session->set_flashdata('error', 'Invalid Insert Purchase Order Product!');
                redirect('PurchaseOrders/Create');
            }

            $masproduct = array(
                'id_product'    => $product->id_product,
                'quantity'      => $product->quantity + $quantity_accepted,
                'purchase_price'=> $this->input->post('purchase_price')[$i]
            );
            if(!$this->MasProduct->Update($masproduct)){
                $this->session->set_flashdata('error', 'Invalid Update Product!');
                redirect('PurchaseOrders/Create');
            }
        }

        if($this->input->post('payment_status') == "Debt")
        {
            $total_utang = $this->db->query("SELECT SUM(subtotal) AS sum FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->sum + $this->input->post('shipping_cost') + $this->input->post('tax_cost');
            $payment_price = $this->input->post('payment_price');
            if($payment_price >= $total_utang){
                $payment_price = $total_utang - 1;
            }
            $masutang = array(
                'id_po'             => $id_po,
                'date_created'      => $this->input->post('date_created'),
                'date_due'          => $this->input->post('date_due'),
                'total_utang'       => $total_utang,
                'sum_payment_price' => $payment_price,
                'email_tenant'      => $this->session->userdata['logged_in']['email_tenant']
            );
            if(!$this->MasUtang->Insert($masutang)){
                $this->session->set_flashdata('error', 'Invalid Insert Utang!');
                redirect('PurchaseOrders/Create');
            }
        }

        if($this->input->post('payment_price') > 0)
        {
            $masutangangsuran = array(
                'id_po'         => $id_po,
                'date_created'  => $this->input->post('date_created'),
                'payment_price' => $this->input->post('payment_price')
            );

            if(!$this->MasUtangAngsuran->Insert($masutangangsuran)){
                $this->session->set_flashdata('error', 'Invalid Insert Utang Angsuran!');
                redirect('PurchaseOrders/Create');
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
        $data['maswarehouseid'] = $this->MasWarehouse->GetWarehouseById($data['incpurchaseorder']->id_warehouse)->row();
        $data['massupplierid'] = $this->MasSupplier->GetSupplierById($data['incpurchaseorder']->id_supplier)->row();
        
        $data['massupplier'] = $this->MasSupplier->GetSupplierByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['incpurchaseorderproduct'] = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($id_po)->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function EditPurchaseOrderPost()
    {
        if($this->IncPurchaseOrder->GetPurchaseOrderById($this->input->post('id_po'))->num_rows() < 1){
			$this->session->set_flashdata('error', 'Purchase Order Notfound!');
			redirect('PurchaseOrders/Index');
        }

        $incpurchaseorder = array(
            'id_po'             => $this->input->post('id_po'),
            'date_created'      => $this->input->post('date_created'),
            'invoice_po'        => $this->input->post('invoice_po'),
            'createdby'         => $this->session->userdata['logged_in']['email'],
            'date_due'          => $this->input->post('date_due'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_supplier'       => $this->input->post('id_supplier'),
            'tax_cost'          => $this->input->post('tax_cost')
        );
        
        $this->IncPurchaseOrder->Update($incpurchaseorder);

        $incpurchaseorder = array(
            'id_po'             => $this->input->post('id_po'),
            'invoice_po'        => $this->input->post('invoice_po'),
            'date_due'          => $this->input->post('date_due')
        );
        
        $this->session->set_flashdata('success', 'Updated Successfully!');
        redirect('PurchaseOrders/Detail/'.$this->input->post('id_po'));
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

    public function EditPurchaseOrderStatusPost()
    {
        if($this->input->post('payment_status') == "Paid"){
            $incpurcahseorder = array(
                'id_po'             => $this->input->post('id_po'),
                'payment_status'    => $this->input->post('payment_status')
            );
            $this->IncPurchaseOrder->Update($incpurcahseorder);

            $utang = $this->MasUtang->GetUtangById($this->input->post('id_po'))->row();

            $masutang = array(
                'id_po'             => $this->input->post('id_po'),
                'sum_payment_price' => $utang->total_utang
            );
            $this->MasUtang->Update($masutang);

            $masutangangsuran = array(
                'id_po'             => $this->input->post('id_po'),
                'date_created'      => date('Y-m-d'),
                'payment_price'     => $utang->total_utang - $utang->sum_payment_price
            );
            $this->MasUtangAngsuran->Insert($masutangangsuran);
        }

        if($this->input->post('delivery_status') == "Done"){
            $incpurcahseorder = array(
                'id_po'             => $this->input->post('id_po'),
                'delivery_status'    => $this->input->post('delivery_status')
            );
            $this->IncPurchaseOrder->Update($incpurcahseorder);

            $purchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($this->input->post('id_po'))->result();

            foreach ($purchaseorderproduct as $poproduct) {
                $incpurchaseorderproduct = array(
                    'id_poproduct'      => $poproduct->id_poproduct,
                    'quantity_accepted' => $poproduct->quantity
                );

                $product = $this->MasProduct->GetProductById($poproduct->id_product)->row();
                $masproduct = array(
                    'id_product'        => $product->id_product,
                    'quantity'          => $product->quantity + ($poproduct->quantity - $poproduct->quantity_accepted)
                );
                
                $this->IncPurchaseOrderProduct->Update($incpurchaseorderproduct);
                $this->MasProduct->Update($masproduct);

            }
        }

        $this->session->set_flashdata('success', 'Status Updated Successfully');
        redirect('PurchaseOrders/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_po', 'id_po', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('PurchaseOrders/Index');
		}

        $incpurchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($this->input->post('id_po'))->result();

        foreach ($incpurchaseorderproduct as $incpoproduct) {
            $product = $this->MasProduct->GetProductById($incpoproduct->id_product)->row();
            $masproduct = array(
                'id_product'        => $product->id_product,
                'quantity'          => $product->quantity - $incpoproduct->quantity_accepted,
            );
            $this->MasProduct->Update($masproduct);

            $this->IncPurchaseOrderProduct->Delete($incpoproduct->id_poproduct);
        }

        $id_po = array(
            'id_po'  => $this->input->post('id_po')
        );

        $masutang = $this->MasUtang->GetUtangById($this->input->post('id_po'))->num_rows();
        if($masutang > 0){
            $this->MasUtang->Delete($id_po);
        }

        $this->IncPurchaseOrder->Delete($id_po);

        $this->session->set_flashdata('success', 'Purchase Order Deleted Successfully!');
		redirect('PurchaseOrders/Index');
    }

    public function GetPurchaseOrderById()
    {
        $id_po = $this->input->post('id_po');
        $incpurchaseorder = $this->IncPurchaseOrder->GetPurchaseOrderById($id_po);
        echo json_encode($incpurchaseorder->row());
    }
}