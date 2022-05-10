<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('url');
        $this->load->library('form_validation');
		$this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('SecUser');
		$this->load->model('SecUserRole');
		$this->load->model('MasTenant');
		$this->load->model('MasEmployee');
		$this->load->model('SecMenu');
    }
	
	public function Index()
	{
		$data['title'] = "Home";
		$data['content'] = "Home/MainBody";
		$this->load->view('Home/_Layout', $data);
	}

	public function SignIn()
	{
		$this->form_validation->set_rules('email_user', 'email_user', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Home');
		};

		$secuser = $this->SecUser->GetUserByEmail($this->input->post('email_user'));
		if($secuser->num_rows() < 1){
			$this->session->set_flashdata('error', 'Account Not Found!');
			redirect('Home');
		};

		if($secuser->row()->status != "active"){
			$this->session->set_flashdata('error', 'Inactive Account!');
			redirect('Home');
		};

		if(!password_verify($this->input->post('password'), $secuser->row()->password)){
			$this->session->set_flashdata('error', 'Incorect Password!');
			redirect('Home');
		};

		$secuserrole = $this->SecUserRole->GetUserRoleById($secuser->row()->id_usertype);
		$mastenant = $this->MasTenant->GetTenantByEmail($this->input->post('email_user'));
		$masemployee = $this->MasEmployee->GetEmployeeByEmail($this->input->post('email_user'));

		if($secuserrole->row()->name == "Admin"){
			$session_data = array(
				'email_user' => $this->input->post('email_user'),
				'id_usertype' => $secuserrole->row()->name,
				'name' => "Admin",
				'photo' => "admin.png",
				'secmenu' => $this->SecMenu->GetAll()->result_array()
			);
		}
		elseif($secuserrole->row()->name == "Tenant"){
			$session_data = array(
				'email_user' => $this->input->post('email_user'),
				'email_tenant' => $this->input->post('email_user'),
				'id_usertype' => $secuserrole->row()->name,
				'name' => $mastenant->row()->name,
				'photo' => $mastenant->row()->photo,
				'phone_number' => $mastenant->row()->phone_number,
				'address' => $mastenant->row()->address,
				'secmenu' => $this->SecMenu->GetMenuByTenant(1)->result_array()
			);
		}
		elseif($secuserrole->row()->name == "Employee"){
			$session_data = array(
				'email_user' => $this->input->post('email_user'),
				'email_tenant' => $mastenant->row()->email_tenant,
				'id_usertype' => $secuserrole->row()->name,
				'name' => $masemployee->row()->name,
				'photo' => $masemployee->row()->picture,
				'phone_number' => $masemployee->row()->phone_number,
				'address' => $masemployee->row()->address,
				'secmenu' => $this->SecMenu->GetMenuByEmployee(1)->result_array()
			);
		}
		else{
			$this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Home');
		}

		$this->session->set_userdata('logged_in', $session_data);
		redirect('Dashboards');
	}

	public function SignUp()
	{
		$data['title'] = "Registration";
		$data['content'] = "UserAuthentications/SignUp";
		$this->load->view('Home/_Layout', $data);
	}

	public function SignUpProcess()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email_user', 'email_user', 'required');
		$this->form_validation->set_rules('phone_number', 'phone_number', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('password_confirmed', 'password_confirmed', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Home/SignUp');
		}

		if ($this->input->post('password') != $this->input->post('password_confirmed')){
			$this->session->set_flashdata('error', 'Password Does Not Match!');
			redirect('Home/SignUp');
		}		

		if ($this->SecUser->GetUserByEmail($this->input->post('email_user'))->row() > 0){
			$this->session->set_flashdata('error', 'Account Already Exist!');
			redirect('Home/SignUp');
		}

		$options['cost'] = 12;

		$secuser = array(
			'email_user' => $this->input->post('email_user'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options),
			'token' => bin2hex($this->encryption->create_key(16)),
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 2
		);

		$this->SecUser->Insert($secuser);

		$mastenant = array(
			'email_tenant' => $this->input->post('email_user'),
			'name' => $this->input->post('name'),
			'address' => "",
			'phone_number' => "62".$this->input->post('phone_number'),
			'photo' => "default-avatar.png"
		);

		$this->MasTenant->Insert($mastenant);

		$this->session->set_flashdata('success', 'Account Registered Successfully!');
		redirect('Home');
	}

	public function ForgotPassword()
	{
		$data['title'] = "Forgot Password";
		$data['content'] = "UserAuthentications/ForgotPassword";
		$this->load->view('Home/_Layout', $data);
	}

	public function SignOut() 
	{
		$sess_array = array(
			'email_user' => '',
			'id_usertype' => '',
			'name' => '',
			'photo' => '',
			'secmenu' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		redirect('Home', 'refresh');
	}
}
