<?php
class MasPiutang extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM maspiutang");
        return $query;
    }

    public function Insert($data){
        $this->db->insert('maspiutang', $data);
    }

    public function Update($data){
        $this->db->where('id_so',  $data['id_so']);
        $this->db->update('maspiutang', $data);
    }

    public function Delete($data){
        $this->db->where('id_so', $data['id_so']);
        $this->db->delete('maspiutang', $data);
	}

    public function GetPiutangByTenant($email_tenant){
        $query = $this->db->query("SELECT * FROM maspiutang WHERE email_tenant = '$email_tenant'");
        return $query;
    }

    public function GetPiutangById($id){
        $query = $this->db->query("SELECT * FROM maspiutang WHERE id_so = '$id'");
        return $query;
    }
}