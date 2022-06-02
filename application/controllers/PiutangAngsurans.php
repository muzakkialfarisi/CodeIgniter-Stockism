<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PiutangAngsurans extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasPiutang');
        $this->load->model('MasPiutangAngsuran');
        $this->load->model('OutSalesOrder');
    }
	
	public function DeletePost()
    {
        $id_angsuran = $this->input->post('id_angsuran');
        $piutangangsuran = $this->MasPiutangAngsuran->GetPiutangAngsuranById($id_angsuran);
        if($piutangangsuran == null)
        {
            $this->session->set_flashdata('error', 'Invalid Get Angsuran!');
            redirect('Piutangs/index');
        }

        $piutangangsuran = $piutangangsuran->row();

        if(!$this->MasPiutangAngsuran->Delete($piutangangsuran->id_angsuran)){
            $this->session->set_flashdata('error', 'Can not Delete Angsuran!');
            redirect('Piutangs/Detail/'.$piutangangsuran->id_so);
        }

        $piutang = $this->MasPiutang->GetPiutangById($piutangangsuran->id_so)->row();

        $maspiutang = array(
            'id_so'             => $piutangangsuran->id_so,
            'sum_payment_price' => $piutang->sum_payment_price - $piutangangsuran->payment_price
        );

        if(!$this->MasPiutang->Update($maspiutang)){
            $this->session->set_flashdata('error', 'Can not Update Piutang!');
            redirect('UtanPiutangsgs/Detail/'.$piutangangsuran->id_so);
        }

        $salesorder = $this->OutSalesOrder->GetSalesOrderById($piutangangsuran->id_so)->row();
        $outsalesorder = array(
            'id_so'             => $salesorder->id_so,
            'status_payment'    => "Debt"
        );

        if(!$this->OutSalesOrder->Update($outsalesorder)){
            $this->session->set_flashdata('error', 'Can not Update Sales Order!');
            redirect('Piutangs/Detail/'.$piutangangsuran->id_so);
        }

        $this->session->set_flashdata('success', 'Angsuran Deleted Successfully!!');
        redirect('Piutangs/Detail/'.$piutangangsuran->id_so);
    }
    
}