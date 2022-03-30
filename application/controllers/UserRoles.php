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
		$data['secmenu'] = $this->SecMenu->GetAll();
		$data['menukey'] = "Security";
		$data['content'] = "UserRoles/Index";
        $data['secuserrole'] = $this->SecUserRole->GetAll();;
        $this->load->view('Shared/_Layout', $data);
	}

}
