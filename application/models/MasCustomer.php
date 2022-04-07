<?php
class MasCustomer extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mascustomer");
		return $data;
	}

	function Insert($data){
        $this->db->insert('mascustomer', $data);
    }

	public function GetCustomerByName($name){
		$data = $this->db->query("SELECT * FROM mascustomer WHERE name = '$name'");
		return $data;
	}

	public function GetCustomerByTenant($id){
		$data = $this->db->query("SELECT * FROM mascustomer WHERE email_tenant = '$id'");
		return $data;
	}

    public function GetAllCustomerType(){
        $data = $this->db->query("SELECT * FROM mascustomertype");
		return $data;
    }

    public function GetIdCustomertypeByName($data){
        $data = $this->db->query("SELECT Id_CustomerType FROM mascustomertype WHERE name = '$data'");
		return $data;
    }

}