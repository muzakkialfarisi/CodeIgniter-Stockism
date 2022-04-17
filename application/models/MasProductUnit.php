<?php
class MasProductUnit extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masproductunit");
		return $data;
	}

    public function Insert($data){
        $this->db->insert('masproductunit', $data);
    }

    public function Update($data){
        $this->db->where('id_productunit', $data['id_productunit']);
        $this->db->update('masproductunit', $data);
    }

    public function Delete($data){
        $this->db->where('id_productunit', $data['id_productunit']);
        $this->db->delete('masproductunit', $data);
    }

    public function GetProductUnitById($id){
        $data = $this->db->query("SELECT * FROM masproductunit WHERE id_productunit = '$id' ");
		return $data;
    }

    public function GetProductUnitByNameByTenant($name, $tenant){
        $data = $this->db->query("SELECT * FROM masproductunit WHERE name = '$name' AND email_tenant = '$tenant' ");
		return $data;
    }

    public function GetProductUnitByTenant($id){
        $data = $this->db->query("SELECT * FROM masproductunit WHERE email_tenant = '$id' ");
		return $data;
    }

}