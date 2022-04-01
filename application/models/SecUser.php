<?php
class SecUser extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUser");
        return $query->result_array();;
    }

    function GetuserByEmailPassword($data){
        $email_user = $data['email_user'];
        $password = $data['password'];
        $query = $this->db->query("SELECT * FROM SecUser 
        INNER JOIN SecUserRole ON SecUser.id_usertype=SecUserRole.id_usertype WHERE email_user='$email_user' AND password='$password' LIMIT 1 ");
        return $query;
    }

}