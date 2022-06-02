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
        $this->load->model('OutSalesOrderProduct');
    }
	
	public function Index()
	{
		$data['menukey'] = "Piutang";
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

    public function EditPiutangAngsuranPost()
    {
        $maspiutangangsuran = array(
            'id_so'         => $this->input->post('id_so'),
            'date_created'  => $this->input->post('date_created'),
            'payment_price' => $this->input->post('payment_price')
        );

        $redirect = "Piutangs/Index";
        if($this->input->post('type') == "inside"){
            $redirect = "Piutangs/Detail/".$this->input->post('id_so');
        }

        if(!$this->MasPiutangAngsuran->Insert($maspiutangangsuran))
        {
            $this->session->set_flashdata('error', 'Invalid Modelstate Angsuran!');
            redirect($redirect);
        }
        
        $piutang = $this->MasPiutang->GetPiutangById($this->input->post('id_so'))->row();

        $maspiutang = array(
            'id_so'             => $this->input->post('id_so'),
            'sum_payment_price' => $piutang->sum_payment_price + $this->input->post('payment_price')
        );

        if(!$this->MasPiutang->Update($maspiutang))
        {
            $this->session->set_flashdata('error', 'Invalid Modelstate Piutang!');
            redirect($redirect);
        }

        if($maspiutang['sum_payment_price'] == $piutang->total_piutang)
        {
            $outsalesorder = array(
                'id_so'             => $this->input->post('id_so'),
                'status_payment'    => "Paid"
            );
    
            if(!$this->OutSalesOrder->Update($outsalesorder))
            {
                $this->session->set_flashdata('error', 'Invalid Modelstate Purchase Order!');
                redirect($redirect);
            }
        }
        

        $this->session->set_flashdata('success', 'Paid Seccessully!');
        redirect($redirect);
    }

    public function Detail($id_so)
    {
        $data['menukey'] = "Piutang";
        $data['javascripts'] = "Piutangs/Detail";
		$data['content'] = "Piutangs/Detail";

        $data['maspiutang'] = $this->MasPiutang->GetPiutangById($id_so)->row();
        $data['outsalesorder'] = $this->OutSalesOrder->GetSalesOrderById($id_so)->row();
        $data['maspiutangangsurans'] = $this->MasPiutangAngsuran->GetPiutangAngsuranByIdSo($id_so);
        $data['outsalesorderproducts'] = $this->OutSalesOrderProduct->GetSalesOrderProductByIdSo($id_so);
        $this->load->view('Shared/_Layout', $data);
    }

    public function GetPiutangById()
    {
        $id_so = $this->input->post('id_so');
        $maspiutang = $this->MasPiutang->GetPiutangById($id_so);
        echo json_encode($maspiutang->row());
    }
}