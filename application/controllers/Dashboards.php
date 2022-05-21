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
        $this->load->model('MasTenant');
        $this->load->model('MasEmployee');
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

	public function ProfileAccount()
	{

		if($this->session->userdata['logged_in']['id_usertype'] == "Tenant")
		{
			$account = $this->MasTenant->GetTenantByEmail($this->input->post('email'))->row();
		}
		else
		{
			$account = $this->MasEmployee->GetEmployeeByEmail($this->input->post('email'))->row();
		}

		$picture = $account->picture;
        if(!empty($_FILES['picture']['name'])){
            if($picture != "default-avatar.png"){
                $this->load->helper("file");
                delete_files(FCPATH.'/assets/img/tenant/'.$picture);
            }
            $picture = $this->UploadStorePicture($this->input->post('id_toko'));
        }

        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Dashboards/Profile');
		}

		if($this->session->userdata['logged_in']['id_usertype'] == "Tenant")
		{
			$mastenant = array(
				'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
				'name' => $this->input->post('name'),
				'phone_number' => $this->input->post('phone_number'),
				'address' => $this->input->post('address'),
				'picture' => $picture
			);
			$this->MasTenant->Update($mastenant);
		}
		else
		{
			$masemployee = array(
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'),
				'phone_number' => $this->input->post('phone_number'),
				'address' => $this->input->post('address'),
				'picture' => $picture
			);
			
			$this->MasEmployee->Update($masemployee);
		}

        $this->session->set_flashdata('success', 'Updated Successfully!');
		redirect('Dashboards/Profile');
	}

}
