<?php
class MasProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masproduct");
		if($data){
            return $data;
        }
        return null;
	}

    public function GetProductByTenant($id){
        $data = $this->db->query("SELECT * FROM masproduct WHERE email_tenant = '$id' order by status asc ");
		if($data){
            return $data;
        }
        return null;
    }

    public function Insert($data){
        $this->db->insert('masproduct', $data);
        $id_product = $this->db->insert_id();
        if($id_product){
            return $id_product;
        }
        return null;
    }

    public function Update($data){
        $this->db->where('id_product', $data['id_product']);
        if($this->db->update('masproduct', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_product', $data['id_product']);
        if($this->db->delete('masproduct', $data)){
            return true;
        }
        return false;
    }

    public function GetProductById($id){
        $data = $this->db->query("SELECT * FROM masproduct WHERE id_product = '$id' ");
		if($data){
            return $data;
        }
        return null;
    }

    public function GetProductByNameByTenant($name, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE name = '$name' AND email_tenant = '$tenant' ");
		if($data){
            return $data;
        }
        return null;
    }

    public function GetProductBySkuByTenant($sku, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE sku = '$sku' AND email_tenant = '$tenant' ");
		if($data){
            return $data;
        }
        return null;
    }

    public function GetProductByCodeByTenant($code, $tenant){
        $data = $this->db->query("SELECT * FROM masproduct WHERE code = '$code' AND email_tenant = '$tenant' ");
		if($data){
            return $data;
        }
        return null;
    }

}