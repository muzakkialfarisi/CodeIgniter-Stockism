<?php
class MasWarehouse extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM maswarehouse");
		return $data;
	}

    public function Insert($data){
        $this->db->insert('maswarehouse', $data);
    }

    public function Update($data){
        $this->db->where('id_warehouse', $data['id_warehouse']);
        $this->db->update('maswarehouse', $data);
    }

    public function GetWarehouseById($id){
        $data = $this->db->query("SELECT * FROM maswarehouse WHERE id_warehouse = '$id' ");
		return $data;
    }

    public function GetWarehouseByIdByTenant($id, $tenant){
        $data = $this->db->query("SELECT * FROM maswarehouse WHERE id_warehouse = '$id' AND email_tenant = '$tenant' ");
		return $data;
    }

    public function GetWarehouseByTenant($id){
        $data = $this->db->query("SELECT * FROM maswarehouse WHERE email_tenant = '$id' ");
		return $data;
    }

}