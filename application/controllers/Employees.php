<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('SecUser');
		$this->load->model('MasTenant');
        $this->load->model('MasEmployee');
    }
	
	public function Index()
	{
		$data['menukey'] = "Employees";
		$data['javascripts'] = "Employees/Index";
		$data['content'] = "Employees/Index";
		if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
        	$data['masemployees'] = $this->MasEmployee->GetAll()->result_array();
		}else{
			$data['masemployees'] = $this->MasEmployee->GetEmployeeByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
		}
        $this->load->view('Shared/_Layout', $data);
	}

	public function CreatePost()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('address', 'address');
		$this->form_validation->set_rules('phone_number', 'phone_number');
		$this->form_validation->set_rules('email', 'email', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Employees/Index');
		}	

		if ($this->MasEmployee->GetEmployeeByNameByEmailByTenant($this->input->post('name'), $this->input->post('email'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Employee Already Exist!');
			redirect('Employees/Index');
		}

		if ($this->SecUser->GetUserByEmail($this->input->post('email'))->row() > 0){
			$this->session->set_flashdata('error', 'User Already Exist!');
			redirect('Employees/Index');
		}

        $options['cost'] = 12;
		
		$new_id_employee = $this->IdBuilder($this->MasEmployee->GetAll()->num_rows());
        $picture = "default-avatar.png";
        if(!empty($_FILES['picture']['name'])){
            $picture = $this->UploadEmployeePicture("employee-".$new_id_employee);
        }
        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Employees/Index');
        }
		
		$masemployee = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
			'picture' => $picture,
			'status' => 'active',
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number')

		);

		$this->MasEmployee->Insert($masemployee);

		$secuser = array(
			'email_user' => $this->input->post('email'),
			'password' => password_hash($this->input->post('email'), PASSWORD_BCRYPT, $options),
			'token' => bin2hex($this->encryption->create_key(16)),
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 3
		);

		$this->SecUser->Insert($secuser);

		$this->session->set_flashdata('success', 'Employee Registered Successfully!');
		redirect('Employees/Index');
	}

	public function EditPost(){
		$this->form_validation->set_rules('id_employee', 'id_employee', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Stores/Index');
		}

		$employee = $this->MasEmployee->GetEmployeeById($this->input->post('id_employee'))->row();

		$picture = $employee->picture;
        if(!empty($_FILES['picture']['name'])){
            if($picture != "default-avatar.png"){
                $this->load->helper("file");
                delete_files(FCPATH.'/assets/img/avatar/'.$picture);
            }
            $picture = $this->UploadEmployeePicture("employee-". $this->input->post('id_employee'));
        }

        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Employees/Index');
        }

        $masemployee = array(
			'id_employee' => $this->input->post('id_employee'),
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'email_tenant' => $this->input->post('email_tenant'),
			'picture' => $picture,
			'status' => 'active'
		);

		$this->MasEmployee->Update($masemployee);
		
		$options['cost'] = 12;
		$email_before = $this->input->post('email_before');
		$secuser = array(
			'email_user' => $this->input->post('email'),
			'password' => password_hash($this->input->post('email'), PASSWORD_BCRYPT, $options),
			'token' => bin2hex($this->encryption->create_key(16)),
			'email_confirmed' => 0,
			'status' => 'active',
			'id_usertype' => 3
		);

		$this->SecUser->Update($secuser, $email_before);

        $this->session->set_flashdata('success', 'Employee Updated Successfully!');
		redirect('Employees/Index');
    }

    public function DeletePost(){
        $this->form_validation->set_rules('id_employee', 'id_employee', 'required');
		$email_user = $this->MasEmployee->GetEmployeeById($this->input->post('id_employee'))->row()->email;
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Employees/Index');
		}

        $masemployee = array(
            'id_employee' => $this->input->post('id_employee')
		);

		$this->MasEmployee->Delete($masemployee);
		
		$secuser = array(
            'email_user' => $email_user
		);

		$this->SecUser->Delete($secuser);

        $this->session->set_flashdata('success', 'Employee Deleted Successfully!');
		redirect('Employees/Index');
    }

    public function GetEmployeeById()
    {
        $id_employee = $this->input->post('id_employee');
        $masemployee = $this->MasEmployee->GetEmployeeById($id_employee);
        echo json_encode($masemployee->row());
    }

	private function UploadEmployeePicture($name)
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
	
	private function IdBuilder($temp)
    {
        return sprintf($temp+1);
    }
}
