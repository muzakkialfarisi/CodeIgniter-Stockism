<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('SecUser');
		$this->load->model('SecMenu');
    }
	
	public function Index()
	{
		$data['menukey'] = "Security";
		$data['javascripts'] = "Users/Index";
		$data['content'] = "Users/Index";

        $data['secuser'] = $this->SecUser->GetAll();
        $this->load->view('Shared/_Layout', $data);
	}

	public function Activation($email_user, $status){
		if($status == "active"){
			$status = "nonactive";
		}
		else{
			$status = "active";
		}

		$secuser = array(
			'email_user'	=> $email_user,
			'status'		=> $status
		);
		$this->SecUser->Update($secuser);

		$this->session->set_flashdata('success', 'Status Updated Successfully!');
		redirect('Users/Index');
	}
}
