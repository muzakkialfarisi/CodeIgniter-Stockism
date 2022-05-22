<?php
class SecMenu extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM secmenu ORDER BY menusort");
		return $data;
	}

	public function GetMenuByTenant($id){
		$data = $this->db->query("SELECT * FROM secmenu WHERE tenant = '$id' ORDER BY menusort");
		return $data;
	}

	public function GetMenuByEmployee($id){
		$data = $this->db->query("SELECT * FROM secmenu WHERE employee = '$id' ORDER BY menusort");
		return $data;
	}

}