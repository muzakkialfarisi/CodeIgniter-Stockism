<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouses extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasWarehouse');
    }
	
	public function Index()
	{
		$data['menukey'] = "Warehouses";
		$data['content'] = "Warehouses/Index";
        $data['javascripts'] = "Warehouses";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['maswarehouse'] = $this->MasWarehouse->GetAll()->result_array();
        }else{
            $data['maswarehouse'] = $this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function CreatePost()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Warehouses/Index');
		}

        if ($this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'You can only create one warehouse!');
			redirect('Warehouses/Index');
		}

        if ($this->MasWarehouse->GetWarehouseByIdByTenant($this->input->post('id_warehouse'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Warehouses Already Exist!');
			redirect('Warehouses/Index');
		}

        $picture = "default-warehouse.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

        $maswarehouse = array(
            'id_warehouse' => $this->IdBuilder($this->MasWarehouse->GetAll()->num_rows()),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
            'picture' => $picture
		);

		$this->MasWarehouse->Insert($maswarehouse);

        $this->session->set_flashdata('success', 'Warehouse Created Successfully!');
		redirect('Warehouses/Index');
    }

    public function EditPost(){
        $this->form_validation->set_rules('id_warehouse', 'id_warehouse', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Warehouses/Index');
		}

        $picture = "default-warehouse.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

        $maswarehouse = array(
            'id_warehouse' => $this->input->post('id_warehouse'),
			'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'picture' => $picture
		);

        $this->MasWarehouse->Update($maswarehouse);

        $this->session->set_flashdata('success', 'Warehouses Updated Successfully!');
		redirect('Warehouses/Index');
    }

    public function GetWarehouseById()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $maswarehouse = $this->MasWarehouse->GetWarehouseById($id_warehouse);
        echo json_encode($maswarehouse->row());
    }

    private function IdBuilder($temp)
    {
        return sprintf('%07d',$temp+1);
    }
}
