<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('encryption');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('SecUser');
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
		$account = "";
		
		if($this->session->userdata['logged_in']['id_usertype'] == "Tenant")
		{
			$account = $this->MasTenant->GetTenantByEmail($this->input->post('email'))->row();
		}
		else
		{
			$account = $this->MasEmployee->GetEmployeeByEmail($this->input->post('email'))->row();
		}

		if($account == ""){
			$this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Dashboards/Profile');
		}
		
		$picture = $account->picture;
        if(!empty($_FILES['picture']['name'])){
            if($picture != "default-avatar.png"){
                $this->load->helper("file");
                delete_files(FCPATH.'/assets/img/avatars/'.$picture);
            }
            $picture = $this->UploadPicture($this->SecUser->GetUserByEmail($this->input->post('email'))->row()->name.$this->input->post('email'));
        }

        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Dashboards/Profile');
		}

		if($this->session->userdata['logged_in']['id_usertype'] == "Tenant")
		{
			$mastenant = array(
				'email_tenant' => $account->email_tenant,
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
				'id_employee' => $account->id_employee,
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

	public function ProfilePassword()
	{
		$this->form_validation->set_rules('current_password', 'current_password', 'required');
        $this->form_validation->set_rules('new_password', 'new_password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[new_password]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Dashboards/Profile');
		}

		$user = $this->SecUser->GetUserByEmail($this->input->post('email'))->row();
		
		if ($user == NULL) {
			$this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Dashboards/Profile');
		}

		if(!password_verify($this->input->post('current_password'), $user->password)){
			$this->session->set_flashdata('error', 'Incorect Password!');
			redirect('Dashboards/Profile');
		};

		$options['cost'] = 12;
		$secuser = array(
			'email_user'	=> $user->email_user,
			'password'		=> password_hash($this->input->post('new_password'), PASSWORD_BCRYPT, $options)
		);

		$this->SecUser->Update($secuser);

		$this->session->set_flashdata('success', 'Password Updated Successfully!');
		redirect('Dashboards/Profile');

	}

	private function UploadPicture($name)
    {
        $config['upload_path']          = FCPATH.'/assets/img/avatars/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $name;
        $config['overwrite']            = true;
        $config['max_size']             = 512; // 1MB

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('picture')) {
            return "error";
        }
        $uploaded_data = $this->upload->data();
        return $uploaded_data['file_name'];
	}

}
