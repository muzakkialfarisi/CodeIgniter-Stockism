<?php
class MasPiutangAngsuran extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM maspiutangangsuran");
        return $query;
    }

    public function Insert($data){
        if($this->db->insert('maspiutangangsuran', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_so', $data['id_so']);
        if($this->db->update('maspiutangangsuran', $data)){
            return true;
        }
        return false;
    }

    public function Delete($data){
        $this->db->where('id_so', $data);
        if($this->db->delete('maspiutangangsuran')){
            return true;
        }
        return false;
	}

    public function GetPiutangAngsuranByIdSo($id){
        $query = $this->db->query("SELECT * FROM maspiutangangsuran WHERE id_so = '$id'");
        if($query){
            return $query;
        }
        return null;
    }

    public function GetPiutangAngsuranById($id){
        $query = $this->db->query("SELECT * FROM maspiutangangsuran WHERE id_angsuran = '$id'");
        if($query){
            return $query;
        }
        return null;
    }
}