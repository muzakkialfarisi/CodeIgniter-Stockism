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

        $data['masstore'] = $this->MasStore->GetStoreByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masmarketplace'] = $this->MasMarketplace->GetAll()->result_array();
        // $data['masstoremarketplace'] = $this->MasStore->GetStoreByMarketplace($data['masmarketplace']->id_marketplace)->row();
        $data['mascustomer'] = $this->MasCustomer->GetCustomerByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        $data['masproduct'] = $this->MasProduct->GetProductByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        // $data['masstoretax'] = $this->MasStore->GetTaxCostByIdTokoByIdMarketplace($data['masstore']->name,$data['masmarketplace']->id_marketplace)->row();
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

        $tax_cost = 10;
        
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
            'Id_CustomerType'   => $this->MasCustomer->GetIdCustomertypeById($this->input->post('id_customer'))->row()->Id_CustomerType,
            'shipping_cost'	    => $this->input->post('shipping_cost')
        );
        $id_so = $this->OutSalesOrder->Insert($outsalesorder);

        for($i=0; $i < count($this->input->post('id_product')); $i++){
            $quantity_delivered = 0;
            if($this->input->post('status_delivery') == "Done")
            {
                $quantity_delivered = $this->input->post('quantity')[$i];
            }

            $product = $this->MasProduct->GetProductById($this->input->post('id_product')[$i])->row();
            if($product == null){
                $this->session->set_flashdata('error', 'Product Notfound!');
		        redirect('SalesOrders/Create');
            }

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
                'quantity'      => $product->quantity - $quantity_delivered,
                'purchase_price'=> $this->input->post('purchase_price')[$i]
            );
            // $this->MasProduct->Update($masproduct);
        }

        if($this->input->post('payment_status') == "Debt")
        {
            $maspiutang = array(
                'id_so'             => $id_so,
                'total_piutang'     => $this->db->query("SELECT SUM(subtotal) AS sum FROM outsalesorderproduct where id_so = '$id_so'")->row()->sum,
                'sum_payment_price' => $this->input->post('payment_price'),
                'status'            => $this->input->post('status'),
                'email_tenant'      => $this->session->userdata['logged_in']['email_tenant'],
                'date_created'      => $this->input->post('date_created'),
                'date_due'          => $this->input->post('date_due')
            );
            $this->MasPiutang->Insert($maspiutang);
        }

        if($this->input->post('payment_price') > 0)
        {
            $maspiutangangsuran = array(
                'id_so'         => $id_so,
                'date_created'  => $this->input->post('date_created'),
                'payment_price' => $this->input->post('payment_price')
            );

            $this->MasPiutangAngsuran->Insert($maspiutangangsuran);
        }

        $this->session->set_flashdata('success', 'Sales Order Created Successfully!');
        redirect('SalesOrders/Index');
    }
        //belum
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

    public function EditSalesOrderPost()
    {
        if($this->OutSalesOrder->GetSalesOrderById($this->input->post('id_so'))->num_rows() < 1){
			$this->session->set_flashdata('error', 'Sales Order Notfound!');
			redirect('SalesOrders/Index');
        }

        $incpurchaseorder = array(
            'id_so'             => $this->input->post('id_so'),
            'date_created'      => $this->input->post('date_created'),
            'invoice_so'        => $this->input->post('invoice_so'),
            'createdby'         => $this->session->userdata['logged_in']['email'],
            'date_due'          => $this->input->post('date_due'),
            'shipping_cost'     => $this->input->post('shipping_cost'),
            'id_customer'       => $this->input->post('id_customer'),
            'tax_cost'          => $this->input->post('tax_cost')
        );
        
        $this->OutSalesOrder->Update($outsalesorder);

        $outsalesorder = array(
            'id_so'             => $this->input->post('id_so'),
            'invoice_so'        => $this->input->post('invoice_so'),
            'date_due'          => $this->input->post('date_due')
        );
        
        $this->session->set_flashdata('success', 'Updated Successfully!');
        redirect('SalesOrders/Detail/'.$this->input->post('id_so'));
    }

    public function EditSalesOrderProductPost()
    {
        $this->form_validation->set_rules('id_soproduct', 'id_soproduct', 'required');
        $this->form_validation->set_rules('selling_price', 'selling_price', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('SalesOrders/Detail/'.$this->input->post('id_so'));
		}

        $outsalesorderproduct = array(
            'id_soproduct'      => $this->input->post('id_soproduct'),
            'selling_price'    => $this->input->post('selling_price')
        );

        $this->OutSalesOrderProduct->Update($outsalesorderproduct);
        $this->session->set_flashdata('success', 'Updated Successfully!');
        redirect('SalesOrders/Detail/'.$this->input->post('id_so'));
    }

    public function EditSalesOrderStatusPost()
    {
        if($this->input->post('status_payment') == "Paid"){
            $incpurcahseorder = array(
                'id_so'             => $this->input->post('id_so'),
                'status_payment'    => $this->input->post('status_payment')
            );
            $this->OutSalesOrder->Update($outsalesorder);

            $piutang = $this->MasPiutang->GetPiutangById($this->input->post('id_so'))->row();

            $maspiutang = array(
                'id_so'             => $this->input->post('id_so'),
                'sum_payment_price' => $utang->total_piutang
            );
            $this->MasUtang->Update($masutang);

            $maspiutangangsuran = array(
                'id_so'             => $this->input->post('id_so'),
                'date_created'      => date(),
                'payment_price'     => $piutang->total_utang - $piutang->sum_payment_price
            );
            $this->MasPiutangAngsuran->Insert($maspiutangangsuran);
        }

        if($this->input->post('status_delivery') == "Done"){
            $incpurcahseorder = array(
                'id_so'             => $this->input->post('id_so'),
                'status_delivery'    => $this->input->post('status_delivery')
            );
            $this->OutSalesOrder->Update($outsalesorder);

            $salesorderproduct = $this->OutSalesOrderProduct->GetSalesOrderProductByIdSo($this->input->post('id_so'))->result();

            foreach ($salesorderproduct as $soproduct) {
                $outsalesorderproduct = array(
                    'id_soproduct'      => $soproduct->id_soproduct,
                    'quantity_delivered' => $soproduct->quantity
                );

                $product = $this->MasProduct->GetProductById($soproduct->id_product)->row();
                $masproduct = array(
                    'id_product'        => $product->id_product,
                    'quantity'          => $product->quantity - ($soproduct->quantity - $soproduct->quantity_delivered)
                );
                
                $this->OutSalesOrderProduct->Update($outsalesorderproduct);
                $this->MasProduct->Update($masproduct);

            }
        }

        $this->session->set_flashdata('success', 'Status Updated Successfully');
        redirect('SalesOrders/Index');
    }

    // public function DeletePost(){
    //     $this->form_validation->set_rules('id_po', 'id_po', 'required');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->session->set_flashdata('error', 'Invalid Modelstate!');
	// 		redirect('PurchaseOrders/Index');
	// 	}

    //     $incpurchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($this->input->post('id_po'))->result();

    //     foreach ($incpurchaseorderproduct as $incpoproduct) {
    //         $product = $this->MasProduct->GetProductById($incpoproduct->id_product)->row();
    //         $masproduct = array(
    //             'id_product'        => $product->id_product,
    //             'quantity'          => $product->quantity - $incpoproduct->quantity_accepted,
    //         );
    //         $this->MasProduct->Update($masproduct);

    //         $this->IncPurchaseOrderProduct->Delete($incpoproduct->id_poproduct);
    //     }

    //     $id_po = array(
    //         'id_po'  => $this->input->post('id_po')
    //     );

    //     $masutang = $this->MasUtang->GetUtangById($this->input->post('id_po'))->num_rows();
    //     if($masutang > 0){
    //         $this->MasUtang->Delete($id_po);
    //     }

    //     $this->IncPurchaseOrder->Delete($id_po);

    //     $this->session->set_flashdata('success', 'Purchase Order Deleted Successfully!');
	// 	redirect('PurchaseOrders/Index');
    // }

    public function GetSalesOrderById()
    {
        $id_so = $this->input->post('id_so');
        $outsalesorder = $this->OutSalesOrder->GetSalesOrderById($id_so);
        echo json_encode($outsalesorder->row());
    }

}
