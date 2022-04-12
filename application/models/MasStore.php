<?php
class MasStore extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mastoko");
		return $data;
	}

	function Insert($data){
        $this->db->insert('mastoko', $data);
    }

	public function GetStoreByName($name){
		$data = $this->db->query("SELECT * FROM mastoko WHERE name = '$name'");
		return $data;
	}

	public function GetStoreByTenant($id){
		$data = $this->db->query("SELECT * FROM mastoko WHERE email_tenant = '$id'");
		return $data;
	}

	public function GetAllMarketplace(){
		$data = $this->db->query("SELECT * FROM masmarketplace");
		return $data;
	}

	public function GetIdMarketplaceByName($data){
        $data = $this->db->query("SELECT id_marketplace FROM masmarketplace WHERE name = '$data'");
		return $data;
    }
}