<?php
class SecUser extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM secuser");
        return $query->result_array();
    }

    public function Insert($data){
        $this->db->insert('secuser', $data);
    }

    public function Update($data,$email_before){
        $this->db->where('email_user', $email_before);
        $this->db->update('secuser', $data);
    }

    public function Delete($data){
        $this->db->delete('secuser', $data);
	}

    public function GetUserByEmail($email_user){
        $query = $this->db->query("SELECT * FROM secuser WHERE email_user = '$email_user'");
        return $query;
    }
}