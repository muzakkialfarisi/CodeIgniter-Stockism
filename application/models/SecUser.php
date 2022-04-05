<?php
class SecUser extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUser");
        return $query->result_array();
    }

    function Insert($data){
        $this->db->insert('secuser', $data);
    }

    function GetUserByEmail($email_user){
        $query = $this->db->query("SELECT * FROM SecUser WHERE email_user = '$email_user'");
        return $query;
    }
    
}