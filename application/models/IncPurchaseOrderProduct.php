<?php
class IncPurchaseOrderProduct extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM incpurchaseorderproduct");
		if($data){
            return $data;
        }
        return null;
	}

    public function Insert($data){
        if($this->db->insert('incpurchaseorderproduct', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_poproduct', $data['id_poproduct']);
        if($this->db->update('incpurchaseorderproduct', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_poproduct', $data);
        if($this->db->delete('incpurchaseorderproduct', $data)){
            return true;
        }
        return false;
    }

    public function GetPurchaseOrderProductById($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorderproduct WHERE id_poproduct = '$id' ");
		if($data){
            return $data;
        }
        return null;
    }

    public function GetPurchaseOrderProductByProductId($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorderproduct WHERE id_product = '$id' ");
		if($data){
            return $data;
        }
        return null;
    }

    public function GetPurchaseOrderProductByIdPo($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorderproduct WHERE id_po = '$id' ");
		if($data){
            return $data;
        }
        return null;
    }
}