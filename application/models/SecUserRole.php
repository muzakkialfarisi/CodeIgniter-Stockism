<?php
class SecUserRole extends CI_Model{

    function GetAll(){
        $query = $this->db->query("SELECT * FROM SecUserRole");
        return $query->result_array();;
    }

} 