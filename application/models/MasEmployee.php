<?php
class MasEmployee extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masemployee");
		return $data;
	}

	public function Insert($data){
        $this->db->insert('masemployee', $data);
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