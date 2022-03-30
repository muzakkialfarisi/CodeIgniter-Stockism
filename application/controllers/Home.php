<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('SecUser');
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
		redirect('Dashboards');
	}

	public function SignUp()
	{
		$data['title'] = "Registration";
		$data['content'] = "UserAuthentications/SignUp";
		$this->load->view('Home/_Layout', $data);
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
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		redirect('/home', 'refresh');
	}
}
