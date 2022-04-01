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
		$this->form_validation->set_rules('email_user', 'email_user', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Home');
		}

		$temp = array(
			'email_user' => $this->input->post('email_user'),
			'password' => $this->input->post('password')
		);

		$result = $this->SecUser->GetuserByEmailPassword($temp);

		if($result->row() < 1){
			$this->session->set_flashdata('error', 'Account Not Found!');
			redirect('Home');
		};

		$session_data = array(
			'email_user' => $temp['email_user'],
			'id_usertype' => $this->SecUser->GetuserByEmailPassword($temp)->row()->name,
		);
		
		$this->session->set_userdata('logged_in', $session_data);
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
		redirect('Home', 'refresh');
	}
}
