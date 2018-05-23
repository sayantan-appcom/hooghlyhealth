<?php

Class Mod_Login extends CI_Model {
   public function __construct()
    {
        //$this->load->database();
    }
// Read data using username and password
public function user_login($data) {
//echo("test model");

	$condition = "user_email =" . "'" . $data['email'] . "' AND " . "user_password =" . "'" . $data['password'] . "' AND " . "user_type_cd NOT IN (01)";
	$this->db->select('*');
	$this->db->from('user_login');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();

	if ($query->num_rows() == 1) {
		return true;
	} 
	else
	{
		return false;
	}
	}




// Read data from database to show data in admin page
public function read_user_information($username) {

	   $condition = "inst_email =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('user_profile_inst');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
		return $query->result();
	} 
	else
	{
	return false;
	}
	}
}




?>

