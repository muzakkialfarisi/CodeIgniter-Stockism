<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenants extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('SecUser');
		$this->load->model('SecMenu');
        $this->load->model('MasTenant');
    }
	
	public function Index()
	{
		$data['menukey'] = "Tenants";
		$data['content'] = "Tenants/Index";
        $data['mastenant'] = $this->MasTenant->GetAll();
        $this->load->view('Shared/_Layout', $data);
	}

	


}
