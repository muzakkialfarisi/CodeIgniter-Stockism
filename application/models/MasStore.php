<?php
class MasStore extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mastoko");
		return $data;
	}

	public function Insert($data){
        $this->db->insert('mastoko', $data);
	}
	
	public function Update($data){
        $this->db->where('id_toko', $data['id_toko']);
        $this->db->update('mastoko', $data);
    }

    public function Delete($data){
        $this->db->where('id_toko', $data['id_toko']);
        $this->db->delete('mastoko', $data);
    }

    public function GetStoreById($id_toko){
        $data = $this->db->query("SELECT * FROM mastoko WHERE id_toko = '$id_toko' ");
		return $data;
    }

	public function GetStoreByName($name){
		$data = $this->db->query("SELECT * FROM mastoko WHERE name = '$name'");
		return $data;
	}

	public function GetStoreByTenant($id){
		$data = $this->db->query("SELECT * FROM mastoko WHERE email_tenant = '$id'");
		return $data;
	}
	
	public function GetIdStoreByNameByTenant($name, $tenant){
        $data = $this->db->query("SELECT * FROM mastoko WHERE name = '$name' AND email_tenant = '$tenant' ");
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