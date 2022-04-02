<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {

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
		//$data['secmenu'] = $this->SecMenu->GetAll();
		$data['menukey'] = "Dashboards";
		$data['content'] = "Dashboards/Index";
        $this->load->view('Shared/_Layout', $data);
	}

	public function Profile()
	{
		$data['secmenu'] = $this->SecMenu->GetAll();
		$data['menukey'] = "Dashboards";
		$data['content'] = "Dashboards/Profile";
        $this->load->view('Shared/_Layout', $data);
	}

}
