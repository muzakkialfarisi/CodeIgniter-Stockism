<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserRoles extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('SecUser');
		$this->load->model('SecMenu');
        $this->load->model('SecUserRole');
    }
	
	public function Index()
	{
		$data['menukey'] = "Security";
		$data['javascripts'] = "UserRoles/Index";
		$data['content'] = "UserRoles/Index";
        $data['secuserrole'] = $this->SecUserRole->GetAll()->result_array();
        $this->load->view('Shared/_Layout', $data);
	}

	public function AddUserRoleProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('UserRoles/Index');
		}	

		if ($this->SecUserRole->GetUserRoleByName($this->input->post('name'))->row() > 0){
			$this->session->set_flashdata('error', 'Role Already Exist!');
			redirect('UserRoles/Index');
		}

		$options['cost'] = 12;
		$data['count_userrole'] = $this->SecUserRole->GetUserRoleCountId();
		$secuserrole = array(
			'id_usertype' => $data['count_userrole'] + 1,
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'status' => 'active'
		);

		$this->SecUserRole->InsertRole($secuserrole);

		$this->session->set_flashdata('success', 'Insert Role Successfully!');
		redirect('UserRoles/Index');
	}


}
