<?php
class MasCourier extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mascourier");
		return $data;
	}

	public function Insert($data){
        $this->db->insert('mascourier', $data);
    }

	public function Update($data){
        $this->db->where('id_courier', $data['id_courier']);
        $this->db->update('mascourier', $data);
    }

	public function GetCourierById($id){
		$data = $this->db->query("SELECT * FROM mascourier WHERE id_courier = '$id'");
		return $data;
	}

	public function GetCourierByName($name){
		$data = $this->db->query("SELECT * FROM mascourier WHERE name = '$name'");
		return $data;
	}

}