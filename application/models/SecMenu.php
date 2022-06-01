<?php
class SecMenu extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM secmenu WHERE status = 1 ORDER BY menusort");
		return $data;
	}

	public function GetMenuByTenant($id){
		$data = $this->db->query("SELECT * FROM secmenu WHERE status = 1 AND tenant = '$id' ORDER BY menusort");
		return $data;
	}

	public function GetMenuByEmployee($id){
		$data = $this->db->query("SELECT * FROM secmenu WHERE status = 1 AND employee = '$id' ORDER BY menusort");
		return $data;
	}

}