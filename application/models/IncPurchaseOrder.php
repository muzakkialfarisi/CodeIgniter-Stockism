<?php
class IncPurchaseOrder extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM incpurchaseorder");
		if($data){
            return $data;
        }
        return null;
	}

    public function GetPurchaseOrderByTenant($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorder WHERE email_tenant = '$id'");
		if($data){
            return $data;
        }
        return null;
    }

    public function Insert($data){
        $this->db->insert('incpurchaseorder', $data);
        $id_product = $this->db->insert_id();
        if($id_product){
            return $id_product;
        }
        return null;
    }

    public function Update($data){
        $this->db->where('id_po', $data['id_po']);
        if($this->db->update('incpurchaseorder', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_po', $data['id_po']);
        if($this->db->delete('incpurchaseorder', $data)){
            return true;
        }
        return false;
    }

    public function GetPurchaseOrderById($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorder WHERE id_po = '$id' ");
		if($data){
            return $data;
        }
        return null;
    }

}