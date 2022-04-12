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

		if ($this->MasStore->GetStoreByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Stores/Index');
		}

        $options['cost'] = 12;
        
        $DataSession = $this->session->all_userdata();

		$masstore = array(
			'name' => $this->input->post('name'),
			'phone_number' => $this->input->post('phone_number'),
			'komisi' => $this->input->post('komisi'),
			'photo' => "default-avatar.png",
			'id_marketplace' => $IdMarketplace,
			'email_tenant' => $DataSession['logged_in']['email_user']
		);

		$this->MasStore->Insert($masstore);

		$this->session->set_flashdata('success', 'Registered Store Successfully!');
		redirect('Stores/Index');
	}


}
