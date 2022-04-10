<?php
class SecUserRole extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUserRole");
        return $query;
    }

    public function InsertRole($data){
        $this->db->insert('secuserrole', $data);
    }

    public function GetUserRoleById($id){
        $query = $this->db->query("SELECT * FROM SecUserRole WHERE id_usertype = '$id'");
        return $query;
    }

    public function GetUserRoleByName($name){
        $query = $this->db->query("SELECT * FROM SecUserRole WHERE name = '$name'");
        return $query;
    }

    public function GetUserRoleCountId(){
        $query = $this->db->query("SELECT COUNT(id_usertype) as count_userrole from SecUserRole");
        return $query->row()->count_userrole;
    }

} 