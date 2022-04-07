<?php
class MasSupplier extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM massupplier");
		return $data->result_array();
	}

	function Insert($data){
        $this->db->insert('massupplier', $data);
    }

	public function GetSupplierByName($name){
		$data = $this->db->query("SELECT * FROM massupplier WHERE name = '$name'");
		return $data;
	}

}