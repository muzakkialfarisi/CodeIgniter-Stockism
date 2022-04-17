<?php
class MasProductCategory extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM masproductcategory");
		return $data;
	}

    public function Insert($data){
        $this->db->insert('masproductcategory', $data);
    }

    public function Update($data){
        $this->db->where('id_productcategory', $data['id_productcategory']);
        $this->db->update('masproductcategory', $data);
    }

    public function Delete($data){
        $this->db->where('id_productcategory', $data['id_productcategory']);
        $this->db->delete('masproductcategory', $data);
    }

    public function GetProductCategoryById($id_productcategory){
        $data = $this->db->query("SELECT * FROM masproductcategory WHERE id_productcategory = '$id_productcategory' ");
		return $data;
    }

    public function GetProductCategoryByNameByTenant($name, $tenant){
        $data = $this->db->query("SELECT * FROM masproductcategory WHERE name = '$name' AND email_tenant = '$tenant' ");
		return $data;
    }

    public function GetProductCategoryByTenant($id){
        $data = $this->db->query("SELECT * FROM masproductcategory WHERE email_tenant = '$id' ");
		return $data;
    }

}