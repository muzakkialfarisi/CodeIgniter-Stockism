<?php
class MasEmployee extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masemployee");
		return $data->result_array();
	}

	function Insert($data){
        $this->db->insert('masemployee', $data);
    }

	public function GetEmployeeByEmail($email){
		$data = $this->db->query("SELECT * FROM masemployee WHERE email = '$email'");
		return $data;
	}

}