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
		$data['secmenu'] = $this->SecMenu->GetAll();
		$data['menukey'] = "Security";
		$data['content'] = "Users/Index";
        $data['secuser'] = $this->SecUser->GetAll();
        $this->load->view('Shared/_Layout', $data);
	}

}
