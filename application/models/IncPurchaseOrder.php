<?php
class IncPurchaseOrder extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM incpurchaseorder");
		return $data;
	}

    public function GetPurchaseOrderByTenant($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorder WHERE email_tenant = '$id' ");
		return $data;
    }

    public function Insert($data){
        $this->db->insert('incpurchaseorder', $data);
        $id_product = $this->db->insert_id();
        return $id_product;
    }

    public function Update($data){
        $this->db->where('id_po', $data['id_po']);
        $this->db->update('incpurchaseorder', $data);
    }

    public function Delete($data){
        $this->db->where('id_po', $data['id_po']);
        $this->db->delete('incpurchaseorder', $data);
    }

    public function GetPurchaseOrderById($id){
        $data = $this->db->query("SELECT * FROM incpurchaseorder WHERE id_po = '$id' ");
		return $data;
    }

}