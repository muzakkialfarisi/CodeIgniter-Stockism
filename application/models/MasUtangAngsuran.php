<?php
class MasUtangAngsuran extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM masutangangsuran");
        if($query){
            return $query;
        }
        return null;
    }

    public function Insert($data){
        if($this->db->insert('masutangangsuran', $data)){
            return true;
        }
        return false;
    }

    public function Update($data){
        $this->db->where('id_angsuran', $data['id_angsuran']);
        if($this->db->update('masutangangsuran', $data)){
            return true;
        }
        return false;
    }

    public function Delete($id){
        $this->db->where('id_angsuran', $id);
        if($this->db->delete('masutangangsuran')){
            return true;
        }
        return false;
	}

    public function GetUtangAngsuranByIdPo($id){
        $query = $this->db->query("SELECT * FROM masutangangsuran WHERE id_po = '$id'");
        if($query){
            return $query;
        }
        return null;
    }

    public function GetUtangAngsuranById($id){
        $query = $this->db->query("SELECT * FROM masutangangsuran WHERE id_angsuran = '$id'");
        if($query){
            return $query;
        }
        return null;
    }
}