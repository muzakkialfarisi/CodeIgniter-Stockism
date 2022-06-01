<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrderProducts extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('IncPurchaseOrder');
		$this->load->model('IncPurchaseOrderProduct');
        $this->load->model('MasUtang');
		$this->load->model('MasWarehouse');
		$this->load->model('MasSupplier');
		$this->load->model('MasProduct');
    }

    public function EditPurchaseOrderProductQuantityPost()
    {
        for($i = 0; $i < count($this->input->post('id_poproduct')); $i++)
        {
            $poproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductById($this->input->post('id_poproduct')[$i])->row();
            $incpurchaseorderproduct = array(
                'id_poproduct'      => $poproduct->id_poproduct,
                'quantity_accepted' => $poproduct->quantity_accepted + $this->input->post('update_quantity_accepted')[$i]
            );

            if(!$this->IncPurchaseOrderProduct->Update($incpurchaseorderproduct))
            {
                $this->session->set_flashdata('error', 'Invalid Update PO Product'. $product->name .'!');
                redirect('PurchaseOrders/Index');
            }

            $product = $this->MasProduct->GetProductById($poproduct->id_product)->row();
            $masproduct = array(
                'id_product'        => $poproduct->id_product,
                'quantity'          => $product->quantity + $this->input->post('update_quantity_accepted')[$i]
            );

            if(!$this->MasProduct->Update($masproduct))
            {
                $this->session->set_flashdata('error', 'Invalid Update Product'. $product->name .'!');
                redirect('PurchaseOrders/Index');
            }
        }

        $purchaseorderproducts = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($this->input->post('id_po'))->result_array();
        $count = true;
        foreach ($purchaseorderproducts as $item) {
            if($item['quantity'] != $item['quantity_accepted'])
            {
                $count = false;
                break;
            }
        }

        if($count == true)
        {
            $purchaseorder = array(
                'id_po'             => $this->input->post('id_po'),
                'delivery_status'   => 'Done'
            );

            if(!$this->IncPurchaseOrder->Update($purchaseorder))
            {
                $this->session->set_flashdata('error', 'Invalid Update Pucahse Order!');
                redirect('PurchaseOrders/Index');
            }
        }

        $this->session->set_flashdata('success', 'Quantity Updated Successfully!');
        redirect('PurchaseOrders/Index');
    }

    public function GetPurchaseOrderProductByIdPo()
    {
        $id_po = $this->input->post('id_po');
        $incpurchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductByIdPo($id_po);
        echo json_encode($incpurchaseorderproduct->result_array());
    }
	
	public function GetPurchaseOrderProductById()
    {
        $id_poproduct = $this->input->post('id_poproduct');
        $incpurchaseorderproduct = $this->IncPurchaseOrderProduct->GetPurchaseOrderProductById($id_poproduct);
        echo json_encode($incpurchaseorderproduct->row());
    }
    
}