<?php
class MasPiutang extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM maspiutang");
        return $query;
    }

    public function Insert($data){
        if($this->db->insert('maspiutang', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_so',  $data['id_so']);
        if($this->db->update('maspiutang', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_so', $data);
        if($this->db->delete('maspiutang')){
            return true;
        }
        return false;
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