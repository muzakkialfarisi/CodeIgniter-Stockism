<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketplaces extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasMarketplace');
    }
	
	public function Index()
	{
		$data['menukey'] = "Marketplaces";
		$data['javascripts'] = "Marketplaces/Index";
		$data['content'] = "Marketplaces/Index";
		$data['masmarketplace'] = $this->MasMarketplace->GetAll()->result_array();

        $this->load->view('Shared/_Layout', $data);
	}

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Marketplaces/Index');
		}	

		if ($this->MasMarketplace->GetMarketplaceByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Marketplace Type Already Exist!');
			redirect('Marketplaces/Index');
		}

        $data['count_marketplace'] = $this->MasMarketplace->GetMarketplaceCountId()->row()->count_marketplace;
		$masmarketplace = array(
			'id_marketplace' => $data['count_marketplace'] + 1,
			'name' => $this->input->post('name')
		);

		$this->MasMarketplace->Insert($masmarketplace);

		$this->session->set_flashdata('success', 'Add Marketplace Type Successfully!');
		redirect('Marketplaces/Index');
	}

	public function EditPost(){
        $this->form_validation->set_rules('id_marketplace', 'id_marketplace', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Marketplaces/Index');
		}

        if ($this->MasMarketplace->GetMarketplaceByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Marketplace Type Already Exist!');
			redirect('Marketplaces/Index');
		}

        $masmarketplace = array(
            'id_marketplace' => $this->input->post('id_marketplace'),
			'name' => $this->input->post('name'),
		);

        $this->MasMarketplace->Update($masmarketplace);

        $this->session->set_flashdata('success', 'Marketplace Updated Successfully!');
		redirect('Marketplaces/Index');
    }

	public function DeletePost(){
        $this->form_validation->set_rules('id_marketplace', 'id_marketplace', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Marketplaces/Index');
		}

        $masmarketplace = array(
            'id_marketplace' => $this->input->post('id_marketplace'),
		);

        $this->MasMarketplace->Delete($masmarketplace);

        $this->session->set_flashdata('success', 'Marketplace Deleted Successfully!');
		redirect('Marketplaces/Index');
    }

	public function GetAllMarketplace()
    {
        $masmarketplace = $this->MasMarketplace->GetAll();
        echo json_encode($masmarketplace->result_array());
    }

	public function GetMarketplaceById()
    {
        $id_marketplace = $this->input->post('id_marketplace');
        $masmarketplace = $this->MasMarketplace->GetMarketplaceById($id_marketplace);
        echo json_encode($masmarketplace->row());
    }

}
