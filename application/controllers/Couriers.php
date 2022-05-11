<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Couriers extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasCourier');
    }
	
	public function Index()
	{
		$data['menukey'] = "Couriers";
		$data['javascripts'] = "Couriers/Index";
		$data['content'] = "Couriers/Index";
		$data['mascourier'] = $this->MasCourier->GetAll()->result_array();
        $this->load->view('Shared/_Layout', $data);
	}

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Couriers/Index');
		}	

		if ($this->MasCourier->GetCourierByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Courier Already Exist!');
			redirect('Couriers/Index');
		}

		$mascourier = array(
			'name' => $this->input->post('name')
		);

		$this->MasCourier->Insert($mascourier);

		$this->session->set_flashdata('success', 'Courier Created Successfully!');
		redirect('Couriers/Index');
	}

	public function EditPost(){
        $this->form_validation->set_rules('id_courier', 'id_courier', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Couriers/Index');
		}

        if ($this->MasCourier->GetCourierByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Courier Already Exist!');
			redirect('Couriers/Index');
		}

        $mascourier = array(
            'id_courier' => $this->input->post('id_courier'),
			'name' => $this->input->post('name'),
		);

        $this->MasCourier->Update($mascourier);

        $this->session->set_flashdata('success', 'Courier Updated Successfully!');
		redirect('Couriers/Index');
    }

	public function GetAllCourier()
    {
        $mascourier = $this->MasCourier->GetAll();
        echo json_encode($mascourier->result_array());
    }

	public function GetCourierById()
    {
        $id_courier = $this->input->post('id_courier');
        $mascourier = $this->MasCourier->GetCourierById($id_courier);
        echo json_encode($mascourier->row());
    }

}
