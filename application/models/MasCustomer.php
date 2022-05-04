<?php
class MasCustomer extends CI_Model{

    public function GetAll(){
		$data = $this->db->query("SELECT * FROM mascustomer");
		return $data;
	}

	function Insert($data){
        $this->db->insert('mascustomer', $data);
	}
	
	public function Update($data){
        $this->db->where('id_customer', $data['id_customer']);
        $this->db->update('mascustomer', $data);
    }

    public function Delete($data){
        $this->db->where('id_customer', $data['id_customer']);
        $this->db->delete('mascustomer', $data);
    }

    public function GetCustomerById($id_customer){
        $data = $this->db->query("SELECT * FROM mascustomer WHERE id_customer = '$id_customer' ");
		return $data;
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