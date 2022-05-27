<?php
class MasUtangAngsuran extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM masutangangsuran");
        return $query;
    }

    public function Insert($data){
        $this->db->insert('masutangangsuran', $data);
    }

    public function Update($data){
        $this->db->where('id_po', $data['id_po']);
        $this->db->update('masutangangsuran', $data);
    }

    public function Delete($data){
        $this->db->where('id_po', $data['id_po']);
        $this->db->delete('masutangangsuran', $data);
	}

    public function GetUtangByIdPo($id){
        $query = $this->db->query("SELECT * FROM masutangangsuran WHERE id_po = '$id'");
        return $query;
    }

    public function GetUtangById($id){
        $query = $this->db->query("SELECT * FROM masutangangsuran WHERE id_angsuran = '$id'");
        return $query;
    }
}