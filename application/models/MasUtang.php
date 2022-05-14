<?php
class MasUtang extends CI_Model{

    public function GetAll(){
        $query = $this->db->query("SELECT * FROM masutang");
        return $query;
    }

    public function Insert($data){
        $this->db->insert('masutang', $data);
    }

    public function Update($data,$email_before){
        $this->db->where('email_user', $email_before);
        $this->db->update('masutang', $data);
    }

    public function Delete($data){
        $this->db->delete('masutang', $data);
	}

    public function GetUtangByTenant($email_tenant){
        $query = $this->db->query("SELECT * FROM masutang WHERE email_tenant = '$email_tenant'");
        return $query;
    }
}