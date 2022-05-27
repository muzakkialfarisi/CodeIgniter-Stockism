<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrders extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('OutSalesOrder');
        $this->load->model('OutSalesOrderProduct');
        $this->load->model('MasWarehouse');
        $this->load->model('MasStore');
        $this->load->model('MasCustomer');
		$this->load->model('MasProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Index";
		$data['content'] = "SalesOrders/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['outsalesorder'] = $this->OutSalesOrder->GetAll()->result_array();
        }else{
            $data['outsalesorder'] = $this->OutSalesOrder->GetSalesOrderByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function Create()
    {
        $data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Create";
		$data['content'] = "SalesOrders/Create";

        $data['maswarehouse'] = $this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masstore'] = $this->MasStore->GetStoreByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['mascustomer'] = $this->MasCustomer->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function CreatePost()
    {
        if($this->input->post('id_product') == null){
            $this->session->set_flashdata('error', 'Product Notfound!');
		    redirect('SalesOrders/Create');
        }

        $invoice_so = $this->input->post('invoice_so');
        if($invoice_so == null)
        {
            $invoice_so = date("ymd-His");
        }
        
        $outsalesorder = array(
            'date_created'      => $this->input->post('date_created'),
            'invoice_so'        => $invoice_so,
            'createdby'         => $this->session->userdata['logged_in']['email'],
            'email_tenant'      => $this->session->userdata['logged_in']['email_tenant'],
            'payment_status'    => $this->input->post('payment_status'),
            'date_due'          => $this->input->post('date_due'),
            'payment_price'     => $this->input->post('payment_price'),
            'delivery_status'   => $this->input->post('delivery_status'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_customer'       => $this->input->post('id_customer'),
            'tax_cost'          => $this->input->post('tax_cost'),
            'id_toko'           => $this->input->post('id_toko')
        );
        $id_so = $this->OutSalesOrder->Insert($outsalesorder);

        $sum_product = count($this->input->post('id_product'));
        for($i=0; $i < $sum_product; $i++){
            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();

            $outsalesorderproduct = array(
                'id_so'         => $id_so,
                'date_created'  => $this->input->post('date_created'),
                'id_product'    => $product->id_product,
                'sku'           => $product->sku,
                'quantity'      => $this->input->post('quantity')[$i],
                'purchase_price'=> $this->input->post('purchase_price')[$i],
                'subtotal'      => $this->input->post('quantity')[$i] * $this->input->post('purchase_price')[$i],
                'expired_date'  => $this->input->post('expired_date')[$i],
                'storage'       => $this->input->post('storage')[$i]
            );
            $this->OutSalesOrderProduct->Insert($outsalesorderproduct);
        }

        // if($this->input->post('payment_status') == "Debt")
        // {
        //     $masutang = array(
        //         'id_so'         => $id_po,
        //         'total_utang'   => $this->db->query("SELECT SUM(subtotal) AS sum FROM incpurchaseorderproduct where id_po = '$id_po'")->row()->sum,
        //         'total_bayar'   => 0,
        //         'status'        => "Debt"
        //     );
        //     $this->MasUtang->Insert($masutang);
        // }

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
        redirect('SalesOrders/Index');
    }

    public function Detail($id_po)
    {
        $data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Detail";
		$data['content'] = "SalesOrders/Detail";

        $data['outsalesorder'] = $this->OutSalesOrder->GetSalesOrderById($id_so)->row();
        $data['outsalesorderproduct'] = $this->OutSalesOrderProduct->GetSalesOrderProductByIdSo($id_so)->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

}
