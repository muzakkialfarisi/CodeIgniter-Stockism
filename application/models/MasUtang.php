<?php
class MasUtang extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM masutang");
        return $query;
    }

    public function Insert($data){
        $this->db->insert('masutang', $data);
    }

    public function Update($data){
        $this->db->where('id_po',  $data['id_po']);
        $this->db->update('masutang', $data);
    }

    public function Delete($data){
        $this->db->where('id_po', $data['id_po']);
        $this->db->delete('masutang', $data);
	}

    public function GetUtangByTenant($email_tenant){
        $query = $this->db->query("SELECT * FROM masutang WHERE email_tenant = '$email_tenant'");
        return $query;
    }

    public function GetUtangById($id){
        $query = $this->db->query("SELECT * FROM masutang WHERE id_po = '$id'");
        return $query;
    }
}