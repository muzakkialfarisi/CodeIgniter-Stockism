<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutangs extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasPiutang');
        $this->load->model('MasPiutangAngsuran');
        $this->load->model('OutSalesOrder');
        $this->load->model('OutsalesOrderProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Pitangs";
		$data['javascripts'] = "Piutangs/Index";
		$data['content'] = "Piutangs/Index";

		if($this->session->userdata['logged_in']['id_usertype'] == "Admin")
        {
            $data['maspiutang'] = $this->MasPiutang->GetAll()->result_array();
        }
        else
        {
            $data['maspiutang'] = $this->MasPiutang->GetPiutangByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }

        $this->load->view('Shared/_Layout', $data);
	}

    // public function EditUtangAngsuranPost()
    // {
    //     $masutangangsuran = array(
    //         'id_po'         => $this->input->post('id_po'),
    //         'date_created'  => $this->input->post('date_created'),
    //         'payment_price' => $this->input->post('payment_price')
    //     );

    //     $redirect = "Utangs/Index";
    //     if($this->input->post('type') == "inside"){
    //         $redirect = "Utangs/Detail/".$this->input->post('id_po');
    //     }

    //     if(!$this->MasUtangAngsuran->Insert($masutangangsuran))
    //     {
    //         $this->session->set_flashdata('error', 'Invalid Modelstate Angsuran!');
    //         redirect($redirect);
    //     }
        
    //     $utang = $this->MasUtang->GetUtangById($this->input->post('id_po'))->row();

    //     $masutang = array(
    //         'id_po'             => $this->input->post('id_po'),
    //         'sum_payment_price' => $utang->sum_payment_price + $this->input->post('payment_price')
    //     );

    //     if(!$this->MasUtang->Update($masutang))
    //     {
    //         $this->session->set_flashdata('error', 'Invalid Modelstate Utang!');
    //         redirect($redirect);
    //     }

    //     $incpurchaseorder = array(
    //         'id_po'             => $this->input->post('id_po'),
    //         'payment_status'    => "Paid"
    //     );

    //     if(!$this->IncPurchaseOrder->Update($incpurchaseorder))
    //     {
    //         $this->session->set_flashdata('error', 'Invalid Modelstate Purchase Order!');
    //         redirect($redirect);
    //     }

    //     $this->session->set_flashdata('success', 'Paid Seccessully!');
    //     redirect($redirect);
    // }

    public function Detail($id_so)
    {
        $data['menukey'] = "Piutang";
        $data['javascripts'] = "Piutangs/Detail";
		$data['content'] = "Piutangs/Detail";

        $data['maspiutang'] = $this->MasPiutang->GetPiutangById($id_so)->row();
        $data['outsalesorder'] = $this->IncPurchaseOrder->GetPurchaseOrderById($id_so)->row();
        $data['maspiutangangsurans'] = $this->MasUtangAngsuran->GetUtangAngsuranByIdPo($id_so);
        $data['outsalesorderproducts'] = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($id_so);
        $this->load->view('Shared/_Layout', $data);
    }

    public function GetPiutangById()
    {
        $id_so = $this->input->post('id_so');
        $maspiutang = $this->MasPiutang->GetPiutangById($id_so);
        echo json_encode($maspiutang->row());
    }
}