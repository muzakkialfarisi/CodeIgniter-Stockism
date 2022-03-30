<?php
class SecUser extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUser");
        return $query->result_array();;
    }

    function AuthAdmin($email,$password){
        $query = $this->db->query("SELECT * FROM SecUser WHERE email='$email' AND password='$password' LIMIT 1");
        return $query;
    }

}