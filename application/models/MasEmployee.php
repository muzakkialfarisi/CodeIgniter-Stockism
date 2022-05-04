<?php
class MasEmployee extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masemployee");
		return $data;
	}

	public function Insert($data){
        $this->db->insert('masemployee', $data);
	}
	
	public function Update($data){
        $this->db->where('id_employee', $data['id_employee']);
        $this->db->update('masemployee', $data);
    }

    public function Delete($data){
        $this->db->where('id_employee', $data['id_employee']);
        $this->db->delete('masemployee', $data);
	}
	
	public function GetEmployeeById($id_employee){
        $data = $this->db->query("SELECT * FROM masemployee WHERE id_employee = '$id_employee' ");
		return $data;
	}
	
	public function GetIdStoreByNameByEmailByTenant($name, $email, $tenant){
        $data = $this->db->query("SELECT * FROM masemployee WHERE name = '$name' AND email = '$email' AND email_tenant = '$tenant' ");
		return $data;
    }

	public function GetEmployeeByEmail($email){
		$data = $this->db->query("SELECT * FROM masemployee WHERE email = '$email'");
		return $data;
	}

	public function GetEmployeeByTenant($id){
		$data = $this->db->query("SELECT * FROM masemployee WHERE email_tenant = '$id'");
		return $data;
	}

}