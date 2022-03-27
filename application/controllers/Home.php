<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('UserAuthentication');
    }
	
	public function Index()
	{
		$this->load->view('Template/Header');
		$this->load->view('Home/Header');
		$this->load->view('Home/AboutUs');
		$this->load->view('Home/Help');
		$this->load->view('Home/Footer');
		$this->load->view('UserAuthentications/SignIn');
		$this->load->view('Template/Footer');
	}

	public function SignUp_View(){
		$this->load->view('Template/Header');
		$this->load->view('Home/Header');
		$this->load->view('UserAuthentications/SignUp');
		$this->load->view('Home/Footer');
		$this->load->view('Template/Footer');
	}

	public function ForgotPassword_View(){
		$this->load->view('Template/Header');
		$this->load->view('Home/Header');
		$this->load->view('UserAuthentications/ForgotPassword');
		$this->load->view('Home/Footer');
		$this->load->view('Template/Footer');
	}

	public function dashboard()
	{
        $this->load->view('Template/Header');
		$this->load->view('Dashboard/Dashboard');
		$this->load->view('Template/Footer');
	}

	public function Logout() {
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		redirect('/home', 'refresh');
	}
}
