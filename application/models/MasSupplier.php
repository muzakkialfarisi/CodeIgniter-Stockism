<?php
class MasSupplier extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM massupplier");
		return $data;
	}

    public function GetSupplierByTenant($id){
        $data = $this->db->query("SELECT * FROM massupplier WHERE email_tenant = '$id' ");
		return $data;
    }

	public function Insert($data){
        $this->db->insert('massupplier', $data);
	}
	
	public function Update($data){
        $this->db->where('id_supplier', $data['id_supplier']);
        $this->db->update('massupplier', $data);
    }

    public function Delete($data){
        $this->db->where('id_supplier', $data['id_supplier']);
        $this->db->delete('massupplier', $data);
    }

    public function GetSupplierById($id_supplier){
        $data = $this->db->query("SELECT * FROM massupplier WHERE id_supplier = '$id_supplier' ");
		return $data;
    }

	public function GetSupplierByName($name){
		$data = $this->db->query("SELECT * FROM massupplier WHERE name = '$name'");
		return $data;
	}

}