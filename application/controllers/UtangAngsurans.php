<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UtangAngsurans extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasUtang');
		$this->load->model('MasUtangAngsuran');
		$this->load->model('IncPurchaseOrder');
    }
	
	public function DeletePost()
    {
        $id_angsuran = $this->input->post('id_angsuran');
        $utangangsuran = $this->MasUtangAngsuran->GetUtangAngsuranById($id_angsuran);
        if($utangangsuran == null)
        {
            $this->session->set_flashdata('error', 'Invalid Get Angsuran!');
            redirect('Utangs/index');
        }

        $utangangsuran = $utangangsuran->row();

        if(!$this->MasUtangAngsuran->Delete($utangangsuran->id_angsuran)){
            $this->session->set_flashdata('error', 'Can not Delete Angsuran!');
            redirect('Utangs/Detail/'.$utangangsuran->id_po);
        }

        $utang = $this->MasUtang->GetUtangById($utangangsuran->id_po)->row();

        $masutang = array(
            'id_po'             => $utangangsuran->id_po,
            'sum_payment_price' => $utang->sum_payment_price - $utangangsuran->payment_price
        );

        if(!$this->MasUtang->Update($masutang)){
            $this->session->set_flashdata('error', 'Can not Update Utang!');
            redirect('Utangs/Detail/'.$utangangsuran->id_po);
        }

        $purchaseorder = $this->IncPurchaseOrder->GetPurchaseOrderById($utangangsuran->id_po)->row();
        $incpurchaseorder = array(
            'id_po'             => $purchaseorder->id_po,
            'payment_status'    => "Debt"
        );

        if(!$this->IncPurchaseOrder->Update($incpurchaseorder)){
            $this->session->set_flashdata('error', 'Can not Update Purchase Order!');
            redirect('Utangs/Detail/'.$utangangsuran->id_po);
        }

        $this->session->set_flashdata('success', 'Angsuran Deleted Successfully!!');
        redirect('Utangs/Detail/'.$utangangsuran->id_po);
    }
    
}