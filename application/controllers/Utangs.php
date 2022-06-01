<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utangs extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasUtang');
        $this->load->model('MasUtangAngsuran');
        $this->load->model('IncPurchaseOrder');
        $this->load->model('IncPurchaseOrderProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Utangs";
		$data['javascripts'] = "Utangs/Index";
		$data['content'] = "Utangs/Index";

		if($this->session->userdata['logged_in']['id_usertype'] == "Admin")
        {
            $data['masutang'] = $this->MasUtang->GetAll()->result_array();
        }
        else
        {
            $data['masutang'] = $this->MasUtang->GetUtangByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }

        $this->load->view('Shared/_Layout', $data);
	}

    public function EditUtangAngsuranPost()
    {
        $masutangangsuran = array(
            'id_po'         => $this->input->post('id_po'),
            'date_created'  => $this->input->post('date_created'),
            'payment_price' => $this->input->post('payment_price')
        );

        $redirect = "Utangs/Index";
        if($this->input->post('type') == "inside"){
            $redirect = "Utangs/Detail/".$this->input->post('id_po');
        }

        if(!$this->MasUtangAngsuran->Insert($masutangangsuran))
        {
            $this->session->set_flashdata('error', 'Invalid Modelstate Angsuran!');
            redirect($redirect);
        }
        
        $utang = $this->MasUtang->GetUtangById($this->input->post('id_po'))->row();

        $masutang = array(
            'id_po'             => $this->input->post('id_po'),
            'sum_payment_price' => $utang->sum_payment_price + $this->input->post('payment_price')
        );

        if(!$this->MasUtang->Update($masutang))
        {
            $this->session->set_flashdata('error', 'Invalid Modelstate Utang!');
            redirect($redirect);
        }

        $incpurchaseorder = array(
            'id_po'             => $this->input->post('id_po'),
            'payment_status'    => "Paid"
        );

        if(!$this->IncPurchaseOrder->Update($incpurchaseorder))
        {
            $this->session->set_flashdata('error', 'Invalid Modelstate Purchase Order!');
            redirect($redirect);
        }

        $this->session->set_flashdata('success', 'Paid Seccessully!');
        redirect($redirect);
    }

    public function Detail($id_po)
    {
        $data['menukey'] = "Utang";
        $data['javascripts'] = "Utangs/Detail";
		$data['content'] = "Utangs/Detail";

        $data['masutang'] = $this->MasUtang->GetUtangById($id_po)->row();
        $data['incpurchaseorder'] = $this->IncPurchaseOrder->GetPurchaseOrderById($id_po)->row();
        $data['masutangangsuran'] = $this->MasUtangAngsuran->GetUtangAngsuranByIdPo($id_po);
        $data['incpurchaseorderproduct'] = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($id_po);
        $this->load->view('Shared/_Layout', $data);
    }

    public function GetUtangById()
    {
        $id_po = $this->input->post('id_po');
        $masutang = $this->MasUtang->GetUtangById($id_po);
        echo json_encode($masutang->row());
    }
}