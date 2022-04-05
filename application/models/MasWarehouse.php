<?php
class MasWarehouse extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM maswarehouse");
		return $data;
	}

    public function GetWarehouseById($id){
        $data = $this->db->query("SELECT * FROM maswarehouse WHERE id_warehouse = '$id' ");
		return $data;
    }

    public function GetWarehouseByTenant($id){
        $data = $this->db->query("SELECT * FROM maswarehouse WHERE email_tenant = '$id' ");
		return $data;
    }

}