<?php
class OutSalesOrder extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM outsalesorder");
		return $data;
	}

    public function GetSalesOrderByTenant($id){
        $data = $this->db->query("SELECT * FROM outsalesorder WHERE email_tenant = '$id' ");
		return $data;
    }

    public function Insert($data){
        $this->db->insert('outsalesorder', $data);
        $id_product = $this->db->insert_id();
        return $id_product;
    }

    public function Update($data){
        $this->db->where('id_so', $data['id_so']);
        $this->db->update('outsalesorder', $data);
    }

    public function Delete($data){
        $this->db->where('id_so', $data['id_so']);
        $this->db->delete('outsalesorder', $data);
    }

    public function GetSalesOrderById($id){
        $data = $this->db->query("SELECT * FROM outsalesorder WHERE id_so = '$id' ");
		return $data;
    }

}