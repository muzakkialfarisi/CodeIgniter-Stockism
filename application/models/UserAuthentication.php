<?php
class UserAuthentication extends CI_Model{

    function AuthAdmin($email,$password){
        $query = $this->db->query("SELECT * FROM SecUser WHERE email='$email' AND password='$password' LIMIT 1");
        return $query;
    }

}