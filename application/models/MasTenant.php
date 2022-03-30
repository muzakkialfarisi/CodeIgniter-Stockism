<?php
class MasTenant extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mastenant");
		return $data->result_array();
	}

}