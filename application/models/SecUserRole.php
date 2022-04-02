<?php
class SecUserRole extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUserRole");
        return $query->result_array();;
    }

    function GetUserRoleById($id){
        $query = $this->db->query("SELECT * FROM SecUserRole WHERE id_usertype = '$id'");
        return $query;
    }

} 