<?php
class SecUserRole extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUserRole");
        return $query->result_array();
    }

    function InsertRole($data){
        $this->db->insert('secuserrole', $data);
    }

    function GetUserRoleById($id){
        $query = $this->db->query("SELECT * FROM SecUserRole WHERE id_usertype = '$id'");
        return $query;
    }

    function GetUserRoleByName($name){
        $query = $this->db->query("SELECT * FROM SecUserRole WHERE name = '$name'");
        return $query;
    }

    function GetUserRoleCountId(){
        $query = $this->db->query("SELECT COUNT(id_usertype) as count_userrole from SecUserRole");
        return $query->row()->count_userrole;
    }

} 