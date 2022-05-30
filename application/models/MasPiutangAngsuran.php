<?php
class MasPiutangAngsuran extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM mas_piutangangsuran");
        return $query;
    }

    public function Insert($data){
        $this->db->insert('mas_piutangangsuran', $data);
    }

    public function Update($data){
        $this->db->where('id_so', $data['id_so']);
        $this->db->update('mas_piutangangsuran', $data);
    }

    public function Delete($data){
        $this->db->where('id_so', $data['id_so']);
        $this->db->delete('mas_piutangangsuran', $data);
	}

    public function GetPiutangByIdSo($id){
        $query = $this->db->query("SELECT * FROM mas_piutangangsuran WHERE id_so = '$id'");
        return $query;
    }

    public function GetPiutangById($id){
        $query = $this->db->query("SELECT * FROM mas_piutangangsuran WHERE id_angsuran = '$id'");
        return $query;
    }
}