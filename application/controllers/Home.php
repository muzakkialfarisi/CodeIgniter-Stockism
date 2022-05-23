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
				'email' => $this->input->post('email_user'),
				'id_usertype' => $secuserrole->row()->name,
				'name' => "Admin",
				'photo' => "admin.png",
				'secmenu' => $this->SecMenu->GetAll()->result_array()
			);
		}
		elseif($secuserrole->row()->name == "Tenant"){
			$session_data = array(
				'email' => $this->input->post('email_user'),
				'email_tenant' => $mastenant->row()->email_tenant,
				'id_usertype' => $secuserrole->row()->name,
				'secmenu' => $this->SecMenu->GetMenuByTenant(1)->result_array()
			);
		}
		elseif($secuserrole->row()->name == "Employee"){
			$session_data = array(
				'email' => $this->input->post('email_user'),
				'email_tenant' => $masemployee->row()->email_tenant,
				'id_usertype' => $secuserrole->row()->name,
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
		$data['content'] = "Home/UserAuthentications/SignUp";
		$this->load->view('Home/_Layout', $data);
	}

	public function SignUpPost()
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
			'token' => '',
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 2
		);

		$this->SecUser->Insert($secuser);

		$mastenant = array(
			'email' => $this->input->post('email_user'),
			'email_tenant' => date("ymd-His"),
			'name' => $this->input->post('name'),
			'address' => "",
			'phone_number' => $this->input->post('phone_number'),
			'picture' => "default-avatar.png"
		);

		$this->MasTenant->Insert($mastenant);

		$this->session->set_flashdata('success', 'Account Registered Successfully!');
		redirect('Home');
	}

	public function ForgotPassword()
	{
		$data['title'] = "Forgot Password";
		$data['content'] = "Home/UserAuthentications/ForgotPassword";
		$this->load->view('Home/_Layout', $data);
	}

	public function ForgotPasswordPost()
	{
		$user = $this->SecUser->GetUserByEmail($this->input->post('email_user'))->row();
		if ($user == NULL) {
			$this->session->set_flashdata('error', 'Not Found!');
			redirect('Home/ForgotPassword');
		}

		$secuser = array(
			'email_user' => $this->input->post('email_user'),
			'token'		 => bin2hex($this->encryption->create_key(16))
		);
		
		$this->load->library('email');
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter';
		$config['protocol']= "smtp";
		$config['mailtype']= "html";
		$config['smtp_host']= "ssl://smtp.gmail.com";
		$config['smtp_port']= "465";
		$config['smtp_timeout']= "5";
		$config['smtp_user']= "stockism2022@gmail.com"; // isi dengan email kamu
		$config['smtp_pass']= "jualbelibarang"; // isi dengan password kamu
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n"; 
		$config['wordwrap'] = TRUE;
			
		$this->email->initialize($config);
		$this->email->from($config['smtp_user']);
		$this->email->to($this->input->post('email_user'));
		$this->email->subject("Reset Password Request");

		$message = "<h3>You have requested to reset your password</h3>";
		$message .= "<h5>Hi ". $secuser['email_user'] ."</h5>";
		$message .= "<p>We can't just send you your old password. A unique link to reset your password has been generated for you. To reset your password, click the following button and follow the instructions.<p>";
		$message .= "<a href='".site_url('Home/ResetPassword/'.$secuser['email_user']).'/'.$secuser['token']."' style='color:white; padding:3px; background: #4568DC; background: -webkit-linear-gradient(to right, #B06AB3, #4568DC); background: linear-gradient(to right, #B06AB3, #4568DC);'>CLICK ME</a>";
		$this->email->message($message);
		
		if(!$this->email->send())
		{
			$this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Home/ForgotPassword');
		}

		$this->SecUser->Update($secuser);

		$this->session->set_flashdata('success', 'Request has been sent, please check your email!');
		redirect('Home/ForgotPassword');
	}

	public function ResetPassword($email_user, $token)
	{
		$user = $this->SecUser->GetUserByEmail($email_user)->row();
		if ($user == NULL) {
			$this->session->set_flashdata('error', 'Account Notfound!');
			redirect('Home', 'refresh');
		}

		if($token != $user->token){
			$this->session->set_flashdata('error', 'Invalid Token!');
			redirect('Home', 'refresh');
		};

		$data['email'] = $email_user;

		$data['title'] = "Reset Password";
		$data['content'] = "Home/UserAuthentications/ResetPassword";
		$this->load->view('Home/_Layout', $data);
	}

	public function ResetPasswordPost()
	{
        $this->form_validation->set_rules('new_password', 'new_password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[new_password]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Dashboards/Profile');
		}

		$user = $this->SecUser->GetUserByEmail($this->input->post('email_user'))->num_rows();
		
		if ($user < 1) {
			$this->session->set_flashdata('error', 'Account Notfound!');
			redirect('Home');
		}

		$options['cost'] = 12;
		
		$secuser = array(
			'email_user'	=> $this->input->post('email_user'),
			'token'			=> "",
			'password'		=> password_hash($this->input->post('new_password'), PASSWORD_BCRYPT, $options)
		);

		$this->SecUser->Update($secuser);

		$this->session->set_flashdata('success', 'Password Updated Successfully!');
		redirect('Home');
	}

	public function SignOut() 
	{
		$this->session->sess_destroy();
		redirect('Home', 'refresh');
	}
}
