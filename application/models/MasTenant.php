<?php
class MasTenant extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mastenant");
		return $data->result_array();
	}

	function Insert($data){
        $this->db->insert('mastenant', $data);
    }

	public function GetTenantByEmail($email){
		$data = $this->db->query("SELECT * FROM mastenant WHERE email_tenant = '$email'");
		return $data;
	}

}