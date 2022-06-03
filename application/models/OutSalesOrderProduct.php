<?php
class OutSalesOrderProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM outsalesorderproduct");
		return $data;
	}

    public function Insert($data){
        if($this->db->insert('outsalesorderproduct', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_soproduct', $data['id_soproduct']);
        if($this->db->update('outsalesorderproduct', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_soproduct', $data);
        if($this->db->delete('outsalesorderproduct')){
            return true;
        }
        return false;
    }

    public function GetSalesOrderProductById($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_soproduct = '$id' ");
		return $data;
    }

    public function GetSalesOrderProductByProductId($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_product = '$id' ");
		return $data;
    }

    public function GetSalesOrderProductByIdSo($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_so = '$id' ");
		return $data;
    }
}