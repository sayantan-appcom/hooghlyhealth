<?php

Class Mod_Login extends CI_Model {
   public function __construct()
    {
        //$this->load->database();
    }
// Read data using username and password
public function user_login($data) {
//echo("test model");

	$condition = "user_email =" . "'" . $data['email'] . "' AND " . "user_password =" . "'" . $data['password'] . "' AND " . "user_type_cd NOT IN (01,02,03,04,05,06,07,08)";
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

	//get change password flag 1 st time

	public function get_flag_chng($user_id) 
	{

	   	$this->db->select('change_password_flag');
		$this->db->from('user_login');
		$this->db->where('user_id',$user_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$flag = $query->row();
		return $flag->change_password_flag;
	}

	public function get_password($user_id) 
	{

	   	$this->db->select('user_password');
		$this->db->from('user_login');
		$this->db->where('user_id',$user_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$flag = $query->row();
		return $flag->user_password;
	}

	public function get_change_password($user_id,$current_password,$new_password,$confirm_password) 
	{
		date_default_timezone_set('Asia/Kolkata');
        $update_timestamp=date("Y-m-d H:i:s");
		//$this->db->set('user_password', $new_password);
		$data = array(
               'user_password' => md5($new_password),
               'password_update_time' => $update_timestamp,
               'change_password_flag' => 1
            );   
		$this->db->where('user_id', $user_id);  
		return $this->db->update('user_login',$data); 
	   	
	}

	/////////////////////////////////////////////////// fetch documents/////////////////////////////////////////////////////	
    public function fetch_documents()
{
	$this->db->select('*');
	$this->db->from('uploads');
	$query=$this->db->get();
	return $query->result_array();


}

}




?>

