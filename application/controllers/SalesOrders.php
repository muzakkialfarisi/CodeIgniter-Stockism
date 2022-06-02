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
        $this->load->model('MasPiutang');
        $this->load->model('MasPiutangAngsuran');
        $this->load->model('MasWarehouse');
        $this->load->model('MasMarketplace');
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

        $data['masmarketplace'] = $this->MasMarketplace->GetAll()->result_array();
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
            'invoice_so'        => $invoice_so,
            'date_created'      => $this->input->post('date_created'),            
            'createby'          => $this->session->userdata['logged_in']['email'],
            'email_tenant'      => $this->session->userdata['logged_in']['email_tenant'],
            'id_marketplace'    => $this->input->post('id_marketplace'),
            'id_toko'           => $this->input->post('id_toko'),
            'tax_cost'          => $this->input->post('tax_cost'),
            'status_delivery'   => $this->input->post('status_delivery'),
            'airway_bill'       => $this->input->post('airway_bill'),
            'status_payment'    => $this->input->post('status_payment'),
            'date_due'          => $this->input->post('date_due'),
            'id_customer'       => $this->input->post('id_customer'),
            'Id_CustomerType'   => $this->MasCustomer->GetCustomerById($this->input->post('id_customer'))->row()->id_customertype,
            'shipping_cost'	    => $this->input->post('shipping_cost')
        );
        $id_so = $this->OutSalesOrder->Insert($outsalesorder);

        for($i=0; $i < count($this->input->post('id_product')); $i++){
            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();
            if($product == null){
                $this->session->set_flashdata('error', 'Product Notfound!');
		        redirect('SalesOrders/Create');
            }

            if($product->quantity >= $this->input->post('quantity')[$i])
            {
                $outsalesorderproduct = array(
                    'id_so'             => $id_so,
                    'id_product'        => $product->id_product,
                    'quantity'          => $this->input->post('quantity')[$i],
                    'selling_price'     => $this->input->post('selling_price')[$i],
                    'subtotal'          => $this->input->post('quantity')[$i] * $this->input->post('selling_price')[$i] 
                );
    
                if(!$this->OutSalesOrderProduct->Insert($outsalesorderproduct)){
                    $this->session->set_flashdata('error', 'Invalid Insert Sales Order Product!');
                    redirect('SalesOrders/Create');
                }
    
                $masproduct = array(
                    'id_product'    => $product->id_product,
                    'quantity'      => $product->quantity - $this->input->post('quantity')[$i],
                );
                
                if(!$this->MasProduct->Update($masproduct)){
                    $this->session->set_flashdata('error', 'Invalid Update Product!');
                    redirect('SalesOrders/Create');
                }
            }
        }

        if($this->input->post('status_payment') == "Debt")
        {
            $total_piutang = $this->db->query("SELECT SUM(subtotal) AS sum FROM outsalesorderproduct where id_so = '$id_so'")->row()->sum;
            $total_piutang = $total_piutang + ($total_piutang * ($this->input->post('tax_cost') / 100)) + $this->input->post('shipping_cost');
            $payment_price = $this->input->post('payment_price');
            if($payment_price >= $total_piutang){
                $payment_price = $total_piutang - 1;
            }
            $maspiutang = array(
                'id_so'             => $id_so,
                'total_piutang'     => $total_piutang,
                'sum_payment_price' => $payment_price,
                'status'            => $this->input->post('status_payment'),
                'email_tenant'      => $this->session->userdata['logged_in']['email_tenant'],
                'date_created'      => $this->input->post('date_created'),
                'date_due'          => $this->input->post('date_due')
            );
            if(!$this->MasPiutang->Insert($maspiutang)){
                $this->session->set_flashdata('error', 'Invalid Insert Piutang!');
                redirect('SalesOrders/Create');
            }
        }

        if($this->input->post('payment_price') > 0)
        {
            $maspiutangangsuran = array(
                'id_so'         => $id_so,
                'date_created'  => $this->input->post('date_created'),
                'payment_price' => $this->input->post('payment_price')
            );

            if(!$this->MasPiutangAngsuran->Insert($maspiutangangsuran)){
                $this->session->set_flashdata('error', 'Invalid Insert Piutang Angsuran!');
                redirect('SalesOrders/Create');
            }
        }

        $this->session->set_flashdata('success', 'Sales Order Created Successfully!');
        redirect('SalesOrders/Index');
    }

    public function Detail($id_so)
    {
        $data['menukey'] = "Sales Orders";
        $data['javascripts'] = "SalesOrders/Detail";
		$data['content'] = "SalesOrders/Detail";

        $data['masstore'] = $this->MasStore->GetStoreByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masmarketplace'] = $this->MasMarketplace->GetAll()->result_array();
        $data['mascustomer'] = $this->MasCustomer->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['outsalesorder'] = $this->OutSalesOrder->GetSalesOrderById($id_so)->row();
        $data['outsalesorderproduct'] = $this->OutSalesOrderProduct->GetSalesOrderProductByIdSo($id_so)->result_array();
        $this->load->view('Shared/_Layout', $data);
    }

    public function EditSalesOrderStatusPost()
    {
        echo $this->input->post('status_payment');
        echo $this->input->post('status_delivery');
        if($this->input->post('status_payment') == "Paid"){
            $outsalesorder = array(
                'id_so'             => $this->input->post('id_so'),
                'status_payment'    => $this->input->post('status_payment')
            );
            if(!$this->OutSalesOrder->Update($outsalesorder)){
                $this->session->set_flashdata('error', 'Invalid Update Sales Order Payment!');
		        redirect('SalesOrders/Index');
            }

            $piutang = $this->MasPiutang->GetPiutangById($this->input->post('id_so'))->row();

            $maspiutang = array(
                'id_so'             => $this->input->post('id_so'),
                'sum_payment_price' => $piutang->total_piutang
            );
            if(!$this->MasPiutang->Update($maspiutang)){
                $this->session->set_flashdata('error', 'Invalid Update Piutang!');
		        redirect('SalesOrders/Index');
            }

            $maspiutangangsuran = array(
                'id_so'             => $this->input->post('id_so'),
                'date_created'      => date("Y-m-d"),
                'payment_price'     => $piutang->total_piutang - $piutang->sum_payment_price
            );
            if(!$this->MasPiutangAngsuran->Insert($maspiutangangsuran)){
                $this->session->set_flashdata('error', 'Invalid Insert Piutang Angsuran!');
		        redirect('SalesOrders/Index');
            }
        }

        if($this->input->post('status_delivery') == "Done"){
            $outsalesorder = array(
                'id_so'             => $this->input->post('id_so'),
                'status_delivery'    => $this->input->post('status_delivery')
            );
            if(!$this->OutSalesOrder->Update($outsalesorder)){
                $this->session->set_flashdata('error', 'Invalid Update Sales Order Delivery!');
		        redirect('SalesOrders/Index');
            }
        }

        $this->session->set_flashdata('success', 'Status Updated Successfully');
        redirect('SalesOrders/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_so', 'id_so', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('SalesOrders/Index');
		}

        $salesorderproducts = $this->OutSalesOrderProduct->GetSalesOrderProductByIdSo($this->input->post('id_so'))->result();

        foreach ($salesorderproducts as $salesorderproduct) {
            $product = $this->MasProduct->GetProductById($salesorderproduct->id_product)->row();
            $masproduct = array(
                'id_product'        => $product->id_product,
                'quantity'          => $product->quantity + $salesorderproduct->quantity,
            );
            $this->MasProduct->Update($masproduct);

            $this->OutSalesOrderProduct->Delete($salesorderproduct->id_soproduct);
        }

        if($this->MasPiutang->GetPiutangById($this->input->post('id_so'))->num_rows() > 0){
            if(!$this->MasPiutang->Delete($this->input->post('id_so'))){
                $this->session->set_flashdata('error', 'Invalid Delete Piutang!');
                redirect('SalesOrders/Index');
            }
        }

        if(!$this->OutSalesOrder->Delete($this->input->post('id_so'))){
            $this->session->set_flashdata('error', 'Invalid Delete Sales Order!');
            redirect('SalesOrders/Index');
        }

        $this->session->set_flashdata('success', 'Purchase Order Deleted Successfully!');
		redirect('SalesOrders/Index');
    }

    public function GetSalesOrderById()
    {
        $id_so = $this->input->post('id_so');
        $outsalesorder = $this->OutSalesOrder->GetSalesOrderById($id_so);
        echo json_encode($outsalesorder->row());
    }

}
