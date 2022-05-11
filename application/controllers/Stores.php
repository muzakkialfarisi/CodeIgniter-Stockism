<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stores extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasTenant');
        $this->load->model('MasStore');
    }
	
	public function Index()
	{
		$data['menukey'] = "Stores";
		$data['javascripts'] = "Stores/Index";
		$data['content'] = "Stores/Index";
		$data['masmarketplace'] = $this->MasStore->GetAllMarketplace()->result_array();
		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	$data['mastoko'] = $this->MasStore->GetAll()->result_array();
		}else{
			$data['mastoko'] = $this->MasStore->GetStoreByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		}
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddStoreProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('phone_number', 'phone_number');
		$this->form_validation->set_rules('komisi', 'komisi');
		$IdMarketplace = $this->MasStore->GetIdMarketplaceByName($this->input->post('id_marketplace'))->row()->id_marketplace;
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Stores/Index');
		}	

		if ($this->MasStore->GetIdStoreByNameByTenant($this->input->post('name'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Store Already Exist!');
			redirect('Stores/Index');
		}

        $options['cost'] = 12;

		$picture = "default-store.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

		$masstore = array(
			'name' => $this->input->post('name'),
			'phone_number' => $this->input->post('phone_number'),
			'komisi' => $this->input->post('komisi'),
			'photo' => $picture,
			'id_marketplace' => $IdMarketplace,
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'status' => 'active'
		);

		$this->MasStore->Insert($masstore);

		$this->session->set_flashdata('success', 'Registered Store Successfully!');
		redirect('Stores/Index');
	}

	public function EditPost(){
        $this->form_validation->set_rules('id_toko', 'id_toko', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('phone_number', 'phone_number');
		$this->form_validation->set_rules('komisi', 'komisi');
		$IdMarketplace = $this->MasStore->GetIdMarketplaceByName($this->input->post('id_marketplace'))->row()->id_marketplace;

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Stores/Index');
		}

		$picture = "default-store.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

        $masstore = array(
            'id_toko' => $this->input->post('id_toko'),
			'name' => $this->input->post('name'),
			'phone_number' => $this->input->post('phone_number'),
			'komisi' => $this->input->post('komisi'),
			'photo' => $picture,
			'id_marketplace' => $IdMarketplace,
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'status' => 'active'
		);

        $this->MasStore->Update($masstore);

        $this->session->set_flashdata('success', 'Store Updated Successfully!');
		redirect('Stores/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_toko', 'id_toko', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Stores/Index');
		}

        $masstore = array(
            'id_toko' => $this->input->post('id_toko'),
		);

        $this->MasStore->Delete($masstore);

        $this->session->set_flashdata('success', 'Store Deleted Successfully!');
		redirect('Stores/Index');
    }

    public function GetStoreById()
    {
        $id_toko = $this->input->post('id_toko');
        $masstore = $this->MasStore->GetStoreById($id_toko);
        echo json_encode($masstore->row());
    }
}
