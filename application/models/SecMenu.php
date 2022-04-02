<?php
class SecMenu extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM secmenu");
		return $data->result_array();
	}

	public function GetMenuByRole($id){
		$data = $this->db->query("SELECT * FROM secmenu WHERE id_usertype = '$id' ORDER BY menusort");
		return $data->result_array();
	}

}