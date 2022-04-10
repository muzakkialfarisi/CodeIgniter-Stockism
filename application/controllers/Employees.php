<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('SecUser');
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

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Employees/Index');
		}	

		if ($this->MasEmployee->GetEmployeeByEmail($this->input->post('email'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Employees/Index');
		}

		if ($this->SecUser->GetUserByEmail($this->input->post('email'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Employees/Index');
		}

        $options['cost'] = 12;
        
		$masemployee = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
		);

		$this->MasEmployee->Insert($masemployee);

		$secuser = array(
			'email_user' => $this->input->post('email'),
			'password' => password_hash($this->input->post('email'), PASSWORD_BCRYPT, $options),
			'token' => bin2hex($this->encryption->create_key(16)),
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 3
		);

		$this->SecUser->Insert($secuser);

		$this->session->set_flashdata('success', 'Registered Employee Successfully!');
		redirect('Employees/Index');
	}

}
