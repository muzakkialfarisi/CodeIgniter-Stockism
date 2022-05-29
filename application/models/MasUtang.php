<?php
class MasUtang extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM masutang");
        if($query){
            return $query;
        }
        return null;
    }

    public function Insert($data){
        if($this->db->insert('masutang', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_po',  $data['id_po']);
        if($this->db->update('masutang', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_po', $data['id_po']);
        if($this->db->delete('masutang', $data)){
            return true;
        }
        return false;
	}

    public function GetUtangByTenant($email_tenant){
        $query = $this->db->query("SELECT * FROM masutang WHERE email_tenant = '$email_tenant'");
        if($query){
            return $query;
        }
        return null;
    }

    public function GetUtangById($id){
        $query = $this->db->query("SELECT * FROM masutang WHERE id_po = '$id'");
        if($query){
            return $query;
        }
        return null;
    }
}