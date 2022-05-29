<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UtangAngsurans extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasUtangAngsuran');
		$this->load->model('MasUtang');
		$this->load->model('IncPurchaseOrder');
		$this->load->model('IncPurchaseOrderProduct');
    }
	
	public function DeletePost()
    {
        $id_angsuran = $this->input->post('id_angsuran');
        $masutangangsuran = $this->MasUtangAngsuran->GetUtangAngsuranById($id_angsuran);
        if($masutangangsuran == null){
            $this->session->set_flashdata('error', 'Invalid Get Angsuran!');
            redirect('Utangs/Index');
        }
        print_r($id_angsuran);
        // $masutangangsuran = $masutangangsuran->row();

        // $utang = $this->MasUtang->GetUtangById($masutangangsuran->id_po);
        // if($utang == null){
        //     $this->session->set_flashdata('error', 'Invalid Get Utang!');
        //     redirect('Utangs/Detail/'.$masutangangsuran->row()->id_po);
        // }

        // $masutang = array(
        //     'id_po'             => $this->input->post('id_po'),
        //     'sum_payment_price' => $utang->row()->sum_payment_price - $id_angsuran->row()->payment_price
        // );
        // if(!$this->MasUtang->Update($masutang)){
        //     $this->session->set_flashdata('error', 'Invalid Update Utang!');
        //     redirect('Utangs/Detail/'.$masutangangsuran->row()->id_po);
        // }

        // $incpurchaseorder = array(
        //     'id_po'             => $this->input->post('id_po'),
        //     'payment_status'    => "Debt"
        // );
        // if(!$this->IncPurchaseOrder->Update($incpurchaseorder)){
        //     $this->session->set_flashdata('error', 'Invalid Update Angsuran!');
        //     redirect('Utangs/Detail/'.$masutangangsuran->row()->id_po);
        // }

        // if(!$this->MasUtangAngsuran->Delete($id_angsuran)){
        //     $this->session->set_flashdata('error', 'Invalid Delete Angsuran!');
        //     redirect('Utangs/Detail/'.$masutangangsuran->row()->id_po);
        // }

        // $this->session->set_flashdata('success', 'Angsuran Deleted Successfully!');
        // redirect('Utangs/Detail/'.$masutangangsuran->row()->id_po);
    }
    
}