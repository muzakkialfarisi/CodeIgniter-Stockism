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
        if($this->db->insert('outsalesorder', $data)){
            $id_product = $this->db->insert_id();
            return $id_product;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_so', $data['id_so']);
        if($this->db->update('outsalesorder', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_so', $data);
        if($this->db->delete('outsalesorder')){
            return true;
        }
        return false;
    }

    public function GetSalesOrderById($id){
        $data = $this->db->query("SELECT * FROM outsalesorder WHERE id_so = '$id' ");
		return $data;
    }

}