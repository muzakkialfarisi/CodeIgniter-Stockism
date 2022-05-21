<?php
class OutSalesOrderProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM outsalesorderproduct");
		return $data;
	}

    public function Insert($data){
        $this->db->insert('outsalesorderproduct', $data);
    }

    public function Update($data){
        $this->db->where('id_soproduct', $data['id_soproduct']);
        $this->db->update('outsalesorderproduct', $data);
    }

    public function Delete($data){
        $this->db->where('id_soproduct', $data['id_soproduct']);
        $this->db->delete('outsalesorderproduct', $data);
    }

    public function GetSalesOrderProductById($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_soproduct = '$id' ");
		return $data;
    }

    public function GetSalesOrderProductByProductId($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_soproduct = '$id' ");
		return $data;
    }

    public function GetSalesOrderProductByIdPo($id){
        $data = $this->db->query("SELECT * FROM outsalesorderproduct WHERE id_so = '$id' ");
		return $data;
    }
}