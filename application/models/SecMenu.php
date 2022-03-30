<?php
class SecMenu extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM secmenu");
		return $data->result_array();
	}

}