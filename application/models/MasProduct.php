<?php
class MasProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masproduct");
		return $data;
	}

    public function GetProductByTenant($id){
        $data = $this->db->query("SELECT * FROM masproduct WHERE email_tenant = '$id' order by status asc ");
		return $data;
    }

    public function Insert($data){
        $this->db->insert('masproduct', $data);
        $id_product = $this->db->insert_id();
        return $id_product;
    }

    public function Update($data){
        $this->db->where('id_product', $data['id_product']);
        $this->db->update('masproduct', $data);
    }

    public function Delete($data){
        $this->db->where('id_product', $data['id_product']);
        $this->db->delete('masproduct', $data);
    }

    public function GetProductById($id){
        $data = $this->db->query("SELECT * FROM masproduct WHERE id_product = '$id' ");
		return $data;
    }

    public function GetProductByNameByTenant($name, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE name = '$name' AND email_tenant = '$tenant' ");
		return $data;
    }

    public function GetProductBySkuByTenant($sku, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE sku = '$sku' AND email_tenant = '$tenant' ");
		return $data;
    }

    public function GetProductByCodeByTenant($code, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE code = '$code' AND email_tenant = '$tenant' ");
		return $data;
    }

}