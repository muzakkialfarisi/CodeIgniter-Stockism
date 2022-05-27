<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utangs extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MasUtang');
    }
	
	public function Index()
	{
		$data['menukey'] = "Utangs";
		$data['javascripts'] = "Utangs/Index";
		$data['content'] = "Utangs/Index";

		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['masutang'] = $this->MasUtang->GetAll()->result_array();
        }else{
            $data['masutang'] = $this->MasUtang->GetUtangByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }

        $this->load->view('Shared/_Layout', $data);
	}

    
}
