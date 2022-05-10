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
		$data['javascripts'] = "Employees";
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
		$this->form_validation->set_rules('address', 'address');
		$this->form_validation->set_rules('email', 'email', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Employees/Index');
		}	

		if ($this->MasEmployee->GetIdStoreByNameByEmailByTenant($this->input->post('name'), $this->input->post('email'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Employee Already Exist!');
			redirect('Employees/Index');
		}

		if ($this->SecUser->GetUserByEmail($this->input->post('email'))->row() > 0){
			$this->session->set_flashdata('error', 'User Already Exist!');
			redirect('Employees/Index');
		}

        $options['cost'] = 12;
		
		$picture = "default-employees.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }
		
		$masemployee = array(
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'picture' => $picture,
			'status' => 'active'
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

	public function EditPost(){
		$this->form_validation->set_rules('id_employee', 'id_employee', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Stores/Index');
		}

		$picture = "default-employees.png";
        if($this->input->post('picture') != null){
            //$picture = functtion add picture
        }

        $masemployee = array(
			'id_employee' => $this->input->post('id_employee'),
            'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'picture' => $picture,
			'status' => 'active'
		);

		$this->MasEmployee->Update($masemployee);
		
		$options['cost'] = 12;
		$email_before = $this->input->post('email_before');
		$secuser = array(
			'email_user' => $this->input->post('email'),
			'password' => password_hash($this->input->post('email'), PASSWORD_BCRYPT, $options),
			'token' => bin2hex($this->encryption->create_key(16)),
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 3
		);

		$this->SecUser->Update($secuser, $email_before);

        $this->session->set_flashdata('success', 'Employee Updated Successfully!');
		redirect('Employees/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_employee', 'id_employee', 'required');
		$email_user = $this->MasEmployee->GetEmployeeById($this->input->post('id_employee'))->row()->email;
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Employees/Index');
		}

        $masemployee = array(
            'id_employee' => $this->input->post('id_employee')
		);

		$this->MasEmployee->Delete($masemployee);
		
		$secuser = array(
            'email_user' => $email_user
		);

		$this->SecUser->Delete($secuser);

        $this->session->set_flashdata('success', 'Employee Deleted Successfully!');
		redirect('Employees/Index');
    }

    public function GetEmployeeById()
    {
        $id_employee = $this->input->post('id_employee');
        $masemployee = $this->MasEmployee->GetEmployeeById($id_employee);
        echo json_encode($masemployee->row());
    }

}
