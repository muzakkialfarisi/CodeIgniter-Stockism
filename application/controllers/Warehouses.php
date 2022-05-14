<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouses extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
		$this->load->model('MasWarehouse');
    }
	
	public function Index()
	{
		$data['menukey'] = "Warehouses";
		$data['content'] = "Warehouses/Index";
        $data['javascripts'] = "Warehouses/Index";

        if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){
            $data['maswarehouse'] = $this->MasWarehouse->GetAll()->result_array();
        }else{
            $data['maswarehouse'] = $this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->result_array();
        }
        
        $this->load->view('Shared/_Layout', $data);
	}

    public function CreatePost()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Warehouses/Index');
		}

        if ($this->MasWarehouse->GetWarehouseByTenant($this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'You can only create one warehouse!');
			redirect('Warehouses/Index');
		}

        if ($this->MasWarehouse->GetWarehouseByIdByTenant($this->input->post('id_warehouse'), $this->session->userdata['logged_in']['email_tenant'])->row() > 0){
			$this->session->set_flashdata('error', 'Warehouses Already Exist!');
			redirect('Warehouses/Index');
		}

        $id_warehouse = $this->IdBuilder($this->MasWarehouse->GetAll()->num_rows());
        $picture = "default-warehouse.png";
        if(!empty($_FILES['picture']['name'])){
            $picture = $this->UploadWarehousePicture($id_warehouse);
        }

        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Warehouses/Index');
        }

        $maswarehouse = array(
            'id_warehouse' => $id_warehouse,
			'name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'email_tenant' => $this->session->userdata['logged_in']['email_tenant'],
            'picture' => $picture
		);

		$this->MasWarehouse->Insert($maswarehouse);

        $this->session->set_flashdata('success', 'Warehouse Created Successfully!');
		redirect('Warehouses/Index');
    }

    public function EditPost(){
        $this->form_validation->set_rules('id_warehouse', 'id_warehouse', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid Modelstate!');
			redirect('Warehouses/Index');
		}

        $warehouse = $this->MasWarehouse->GetWarehouseById($this->input->post('id_warehouse'))->row();
        
        $picture = $warehouse->picture;
        if(!empty($_FILES['picture']['name'])){
            if($picture != "defaut-warehouse.png"){
                $this->load->helper("file");
                delete_files(FCPATH.'/assets/img/warehouses/'.$picture);
            }
            $picture = $this->UploadWarehousePicture($this->input->post('id_warehouse'));
        }

        if($picture == "error"){
            $this->session->set_flashdata('error', 'Something Wrong!');
			redirect('Warehouses/Index');
        }

        $maswarehouse = array(
            'id_warehouse' => $this->input->post('id_warehouse'),
			'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'picture' => $picture
		);

        $this->MasWarehouse->Update($maswarehouse);

        $this->session->set_flashdata('success', 'Warehouses Updated Successfully!');
		redirect('Warehouses/Index');
    }

    public function GetWarehouseById()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $maswarehouse = $this->MasWarehouse->GetWarehouseById($id_warehouse);
        echo json_encode($maswarehouse->row());
    }

    public function GetWarehouseByTenant()
    {
        $email_tenant = $this->input->post('email_tenant');
        $maswarehouse = $this->MasWarehouse->GetWarehouseByTenant($email_tenant);
        echo json_encode($maswarehouse->num_rows());
    }

    private function UploadWarehousePicture($name)
    {
        $config['upload_path']          = FCPATH.'/assets/img/warehouses/';
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
        return sprintf('%07d',$temp+1);
    }
}
