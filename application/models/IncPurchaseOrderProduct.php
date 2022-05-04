<?php
class IncPurchaseOrderProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM incpurchaseorderproduct");
		return $data;
	}

    public function Insert($data){
        $this->db->insert('incpurchaseorderproduct', $data);
    }

    public function Update($data){
        $this->db->where('id_productunit', $data['id_productunit']);
        $this->db->update('incpurchaseorderproduct', $data);
    }

    public function Delete($data){
        $this->db->where('id_productunit', $data['id_productunit']);
        $this->db->delete('incpurchaseorderproduct', $data);
    }

    public function GetPurchaseOrderProductById($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorderproduct WHERE id_poproduct = '$id' ");
		return $data;
    }

    public function GetPurchaseOrderProductByProductId($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorderproduct WHERE id_product = '$id' ");
		return $data;
    }
}