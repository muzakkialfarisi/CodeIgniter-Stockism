<?php
class MasMarketplace extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masmarketplace");
		return $data;
	}

	public function Insert($data){
        $this->db->insert('masmarketplace', $data);
	}

	public function Update($data){
        $this->db->where('id_marketplace', $data['id_marketplace']);
        $this->db->update('masmarketplace', $data);
    }
	
	public function Delete($data){
        $this->db->where('id_marketplace', $data['id_marketplace']);
        $this->db->delete('masmarketplace', $data);
    }

	public function GetMarketplaceById($id){
		$data = $this->db->query("SELECT * FROM masmarketplace WHERE id_marketplace = '$id'");
		return $data;
	}

	public function GetMarketplaceByName($name){
		$data = $this->db->query("SELECT * FROM masmarketplace WHERE name = '$name'");
		return $data;
	}

	public function GetMarketplaceCountId(){
        $data = $this->db->query("SELECT COUNT(id_marketplace) as count_marketplace FROM masmarketplace");
        return $data;
    }

}