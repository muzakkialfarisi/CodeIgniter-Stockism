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
        $this->load->model('MasProduct');
        $this->load->model('MasEmployee');
        $this->load->model('SecUser');
    }
	
	public function Index()
	{
		$data['menukey'] = "Dashboards";
        $data['javascripts'] = "Dashboards/Index";
		$data['content'] = "Dashboards/Index";

        $this->load->view('Shared/_Layout', $data);
	}

	public function Profile()
	{
		$data['menukey'] = "Dashboards";
        $data['javascripts'] = "Dashboards/Profile";
		$data['content'] = "Dashboards/Profile";

        $this->load->view('Shared/_Layout', $data);
	}

}
