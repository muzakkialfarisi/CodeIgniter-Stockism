<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasTenant');
        $this->load->model('MasEmployee');
    }
	
	public function Index()
	{
		$data['menukey'] = "Employees";
		$data['content'] = "Employees/Index";
		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	$data['masemployees'] = $this->MasEmployee->GetAll()->result_array();
		}else{
			$data['masemployees'] = $this->MasEmployee->GetEmployeeByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		}
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddEmployeeProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Dashboards');
		}	

		if ($this->MasEmployee->GetEmployeeByEmail($this->input->post('email'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Dashboards');
		}

        $options['cost'] = 12;
        
        $DataSession = $this->session->all_userdata();

		$masemployee = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'email_tenant' => $DataSession['logged_in']['email_user']
		);

		$this->MasEmployee->Insert($masemployee);

		$this->session->set_flashdata('success', 'Registered Employee Successfully!');
		redirect('Dashboards');
	}


}
