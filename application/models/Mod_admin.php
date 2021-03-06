<?php

Class Mod_admin extends CI_Model {

    public function __construct()
	    {
	        $this->load->database();
	        $this->load->helper('string');
	    }
			// Read data using username and password

    public function admin_login($data) 
    	{	
			$condition = "user_email =" . "'" . $data['email'] . "' AND " . "user_password =" . "'" . $data['password'] . "' AND " . "(user_type_cd = 01 OR user_type_cd = 02 OR user_type_cd = 03 OR user_type_cd = 04 OR user_type_cd = 05 OR user_type_cd = 06 OR user_type_cd = 07 OR user_type_cd = 08 OR user_type_cd = 09 OR user_type_cd = 10)";
			$this->db->select('*');
			$this->db->from('user_login');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) 
				{
					return true;
				} 
			else
				{
					return false;
				}
  		}

			// Read data from database to show data in admin page
	public function read_user_information($username) 
		{
		   $condition = "user_email =" . "'" . $username . "'";
			$this->db->select('*');
			$this->db->from('user_profile_admin');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) 
				{
					return $query->result();
				} 
			else
				{
					return false;
				}
		}

	public function get_state()
    	{   
			$this->db->select ('state_code,state_name');
			$this->db->from('state');
			$query = $this->db->get();
	        return $query->result();
    	}

    public function get_institute()
    	{   
			$this->db->select ('inst_type_id,inst_type_name');
			$this->db->from('institution_type');
			$query = $this->db->get();
	        return $query->result();
    	}	

    public function get_user()
    	{   
			$this->db->select ('user_type_cd,user_type_name');
			$this->db->from('user_type');
			$this->db->where('user_type_cd NOT IN (01,03)');
			$query = $this->db->get();
	        return $query->result();
    	}	

    public function getDistrict($state)
    	{   
			$this->db->select ('district_code,district_name');
			$this->db->from('district');
			$this->db->join('state', 'district.state_code=state.state_code');
			$this->db->where('district.state_code',$state);
			$query = $this->db->get();
	        return $query->result();
    	} 	

    public function getSubdivision($district)
    	{   
			$this->db->select ('subdivision_code,subdivision_name');
			$this->db->from('subdivisions');
			$this->db->join('district', 'subdivisions.district_code=district.district_code');
			$this->db->where('district.district_code',$district);
			$query = $this->db->get();
	        return $query->result();
    	} 

    public function getBlockMuni($subdivision)
    	{   
			$this->db->select ('blockminicd,blockmuni');
			$this->db->from('block_muni');
			$this->db->join('subdivisions','block_muni.subdivisioncd=subdivisions.subdivision_code');
			$this->db->where('block_muni.subdivisioncd',$subdivision);
			$query = $this->db->get();
	        return $query->result();
    	}

    public function get_block_muni()
    	{   
			$this->db->select ('blockminicd,blockmuni');
			$this->db->from('block_muni');
			$query = $this->db->get();
	        return $query->result();
    	} 	 	

    public function get_max_rs()
    	{
			$this->db->select('max(rs) AS max_rs');
			$this->db->from('user_profile_inst');
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) 
				{
					return $query->result();
				} 
			else 
				{
					return false;
				}
		}	


	
	   /* public function get_user_insert($user_id,$state,$district,$subdivision,$block,$institution_type,$institution_name,$institution_license,$institution_address,$institution_email,$institution_mobile,$institution_phone,$institution_owner,$inst_owner_mobile,$inst_owner_email,$password,$labo_type,$patho_type,$radio_type)*/
  public function get_user_insert($user_id,$state,$district,$subdivision,$block,$institution_type,$institution_name,$institution_license,$institution_address,$institution_email,$institution_mobile,$institution_phone,$institution_owner,$inst_owner_mobile,$inst_owner_email,$password,$labo_type,$patho_type,$radio_type)
    	{   
						/////////////////02.06..2018//////////////
		/*	$data3=array();
	
	for($i=0;$i<count($radio_type);$i++)
	{
	$data3=array(
	'user_id'=>$user_id,
	'radio_type'=>$radio_type[i]
	);
	}
	print_r($data3);
	return $this->db->insert('radio_type',$data3);
    	
*/
			
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			
			$chk=""; 
			$chk2=array();
		if($radio_type!=0)
		{
			
			foreach($radio_type as $chk1) 
          { 
                 $chk.= $chk1.",";
				 
				  
           }
		   }
		   else
		   {
		   $chk="NULL";
		   }
	
			$data=array(
				'user_id'=>$user_id,
				'inst_type_id'=>$institution_type,
				'inst_name'=>$institution_name,
				'inst_license_no'=>$institution_license,
				'inst_addr'=>$institution_address,
				'inst_email'=>$institution_email,
				'inst_mobile'=>$institution_mobile,
				'inst_phone'=>$institution_phone,
				'inst_owner_name'=>$institution_owner,
				'inst_owner_mobile'=>$inst_owner_mobile,
				'inst_owner_email'=>$inst_owner_email,
				'labo_type'=>$labo_type,
				'patho_type'=>$patho_type,
				'radio_type'=>$chk
				);
			$this->db->insert('user_profile_inst',$data);

			$data1=array(
				'user_id'=>$user_id,
				'state_code'=>$state,	
				'district_code'=>$district,
				'subdivision_code'=>$subdivision,
				'block_code'=>$block	
				);
			$this->db->insert('user_area',$data1);

			$data2=array(
				'user_id'=>$user_id,
				'inst_type_cd'=>$institution_type,	
				'user_email'=>$institution_email,
				'user_password'=>$password,
				'creation_timestamp'=>$create_timestamp	
				);
			return $this->db->insert('user_login',$data2);

}

    public function get_admin_max_rs()
    	{
			$this->db->select('max(rs) AS max_rs');
			$this->db->from('user_profile_admin');
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) 
				{
					return $query->result();
				} 
			else 
				{
					return false;
				}
		}
		
    public function get_admin_insert($user_id,$state,$district,$user_subdivision,$user_block,$user_type,$user_name,$user_desg,$user_email,$user_mobile,$user_password)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
				'user_id'=>$user_id,
				'user_type_cd'=>$user_type,
				'user_name'=>$user_name,
				'user_desg'=>$user_desg,
				'user_email'=>$user_email,
				'user_mobile'=>$user_mobile
				);
			$this->db->insert('user_profile_admin',$data);

			$data1=array(
				'user_id'=>$user_id,
				'state_code'=>$state,	
				'district_code'=>$district,	
				'subdivision_code'=>$user_subdivision,	
				'block_code'=>$user_block
				);
			$this->db->insert('user_area',$data1);

			$data2=array(
				'user_id'=>$user_id,
				'user_type_cd'=>$user_type,	
				'user_email'=>$user_email,
				'user_password'=>$user_password,
				'creation_timestamp'=>$create_timestamp	
				);
			return $this->db->insert('user_login',$data2);
    	} 						


    public function get_disease()
    	{   
			$this->db->select ('disease_category_id,disease_category_name');
			$this->db->from('disease_category');
			$query = $this->db->get();
	        return $query->result();
    	}

    public function getsubdisease($disease_category)
    	{   
			$this->db->select ('disease_sub_id,disease_sub_name');
			$this->db->from('disease_subcatagory');
			$this->db->join('disease_category','disease_category.disease_category_id=disease_subcatagory.disease_category_id');
			$this->db->where('disease_subcatagory.disease_category_id',$disease_category);
			$query = $this->db->get();
	        return $query->result();
    	}	

    public function insert_subcategory($disease_code,$disease_subcase_code,$fetch_disease_sub_category)
    	{ $disease_sub_id1= $fetch_disease_sub_category; 
		$disease_sub_id=$disease_sub_id1+1;			
			$data=array(
				'disease_sub_name'=>$disease_subcase_code,
				'disease_category_id'=>$disease_code,
				'disease_sub_id'=>$disease_sub_id
				);
			
			return $this->db->insert('disease_subcatagory',$data);
    	} 


    public function insert_test_name($disease_id,$disease_subcat_id,$test_name,$fetch_test_type_sub_category)
    	{   			
		
				$fetch_test_type_sub_category1=$fetch_test_type_sub_category + 1;
				if($fetch_test_type_sub_category < 9)
				 {
					
				$fetch_test_type_sub_category1="0".$fetch_test_type_sub_category1;
				}
				else if($fetch_test_type_sub_category1 >= 10 ) 
				{
				//$fetch_test_type_sub_category1=$fetch_test_type_sub_category + 1;
				$fetch_test_type_sub_category1=$fetch_test_type_sub_category1;
				}
						/*else if($fetch_test_type_sub_category >= 100 && $fetch_test_type_sub_category<= 999) {
							
							$fetch_test_type_sub_category1=(int)$fetch_test_type_sub_category + 1;
							$fetch_test_type_sub_category1=$fetch_test_type_sub_category1;
						}*/
						/*else if($max_rs1 < 1000) {
							$max_rs1="000".$max_rs1;
						}
						else if($max_rs1 < 10000) {
							$max_rs1="00".$max_rs1;
						}
						else if($max_rs1 < 100000) {
							$max_rs1="0".$max_rs1;
						}
						else if($max_rs1 < 1000000) {
							$max_rs1="".$max_rs1;
						}
			*/
			//$fetch_test_type_sub_category1=$fetch_test_type_sub_category + 1;
			
			$data=array(
			'test_type_code'=>$fetch_test_type_sub_category1,
				'test_type_name'=>$test_name,
				'disease_category_id'=>$disease_id,
				'disease_sub_category_id'=>$disease_subcat_id
				);
			
			return $this->db->insert('test_master',$data);
    	} 	
//............from satantan da 23.05.2018 start..............//
    public function edit_admin_user($user_state,$user_district,$user_type)
		{
	       $this->db->select('*');
		   $this->db->from('user_profile_admin');
		   $this->db->where('user_profile_admin.user_type_cd',$user_type);
		   $query = $this->db->get();
		   return $query->result_array();

		}
//////////////////////////Admin user Upadte////////////////////////////////////////

	public function admin_user_update($user_name,$user_desg,$user_mobile,$user_id)
		{   
	
			//date_default_timezone_set('Asia/Kolkata');
			$data=array(
				'user_name'=>$user_name,
				'user_desg'=>$user_desg,
				'user_mobile'=>$user_mobile
				);
				$this->db->where('user_id',$user_id);
				$flag = $this->db->update('user_profile_admin', $data);
				return $flag;	
	
		}
///////////////////////////Fetch Institutioin Name/////////////////////////////
	public function get_institution_name($inst_district,$inst_subdivision,$inst_block,$inst_type)
		{      
			   $this->db->select('user_profile_inst.inst_name,user_profile_inst.user_id');
			   $this->db->from('user_profile_inst');
			   $this->db->join('user_area','user_area.user_id=user_profile_inst.user_id');	
			   $condition="user_area.subdivision_code='".$inst_subdivision."' AND user_area.district_code='".$inst_district."' AND user_area.block_code='".$inst_block."' AND user_profile_inst.inst_type_id='".$inst_type."'";
			   $this->db->where($condition);
			   $query = $this->db->get();
			 return $query->result_array();
		}

////////////////////////////////////////edit_institute_details//////////////////////////////////
	public function edit_institute_details($user_id)
		{
	   	   $this->db->select('*');
		   $this->db->from('user_profile_inst');
		   $this->db->where('user_profile_inst.user_id',$user_id);
		   $query = $this->db->get();
		   return $query->result_array();
		}
//////////////institute user update/////////////////////////////////////////////

	public function institution_user_update($inst_license_no,$inst_addr,$inst_email,$inst_mobile,$inst_phone,$inst_owner_name,$inst_owner_mobile,$inst_owner_email,$user_id)
		{
			$data=array(
				'inst_license_no'=>$inst_license_no,
				'inst_addr	'=>$inst_addr,
				'inst_email'=>$inst_email,
				'inst_mobile'=>$inst_mobile,
				'inst_phone'=>$inst_phone,
				'inst_owner_name'=>$inst_owner_name,
				'inst_owner_mobile'=>$inst_owner_mobile,
				'inst_owner_email'=>$inst_owner_email
				);
				$this->db->where('user_id',$user_id);
				$flag = $this->db->update('user_profile_inst', $data);
				return $flag;	

		}

// end of 23.05.2018 //

/////////////////////////////////fetch_disease_sub_category////////////////////////////////////////////////////
/*public function fetch_disease_sub_category($disease_code)
{
$this->db->select('MAX(convert(disease_sub_id),UNSIGNED INTEGER) AS disease_sub_id ' );
$this->db->from('disease_subcatagory');
$condition="disease_subcatagory.disease_sub_id < (SELECT MAX(disease_sub_id) FROM disease_subcatagory)  AND disease_subcatagory.disease_category_id='".$disease_code."'";
$this->db->where($condition);
$query=$this->db->get();
$ret = $query->row();
return $ret->disease_sub_id;
}*/

public function fetch_disease_sub_category()
{
$this->db->select('MAX(disease_sub_id) AS disease_sub_id');
$this->db->from('disease_subcatagory');
$query=$this->db->get();
$ret = $query->row();
return $ret->disease_sub_id;

}

//////////////////////////////////fetch_test_type_sub_category/////////////////////////////////////////////////////

 public function fetch_test_type_sub_category()
{
$this->db->select('MAX(test_type_code) AS test_type_code ' );
$this->db->from('test_master');
$query=$this->db->get();
$ret = $query->row();
return $ret->test_type_code;

}

//////////////////////////////////////fetch radiology type//////////////////////////////////////////////////////

 public function fetch_radiology_type()
{
$this->db->select('*' );
$this->db->from('master_radiology_type');
$query = $this->db->get();
 return $query->result_array();


}
////////////////////////////////fetch institute details////////////////////////////////////////////////////////////
public function fetch_institute_details($subdivision,$district,$inst_type)
{
$this->db->DISTINCT();
$this->db->select('inst_name,inst_license_no,inst_addr,inst_mobile,inst_phone,inst_email,inst_owner_name,inst_owner_mobile,inst_owner_email,subdivisions.subdivision_name');
$this->db->from('user_profile_inst');
$this->db->join('user_area','user_area.user_id=user_profile_inst.user_id');	
$this->db->join('subdivisions','subdivisions.subdivision_code=user_area.subdivision_code');	
$condition="user_area.subdivision_code='".$subdivision."'  AND user_profile_inst.inst_type_id='".$inst_type."' AND user_area.district_code='".$district."' ";
$this->db->where($condition);
$query=$this->db->get();
return $query->result_array();
}

//.......... Get Password ..........//

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

//.......... Update Password ..........//
	public function get_change_password($user_id,$current_password,$new_password,$confirm_password) 
	{
		date_default_timezone_set('Asia/Kolkata');
        $update_timestamp=date("Y-m-d H:i:s");
		//$this->db->set('user_password', $new_password);
		$data = array(
               'user_password' => md5($new_password),
               'password_update_time' => $update_timestamp
            );   
		$this->db->where('user_id', $user_id);  
		return $this->db->update('user_login',$data); 
	   	
	}

//........... Start Reset Password ...........//

	public function getEmailUser($user_type)
    	{   
			$this->db->select ('user_id,user_email');
			$this->db->from('user_profile_admin');
			$this->db->where('user_type_cd',$user_type);
			$query = $this->db->get();
	        return $query->result();
    	} 

    public function getEmailInstitution($institution_block)
    	{   
			$this->db->select ('user_profile_inst.inst_email');
			$this->db->from('user_profile_inst');
			$this->db->join('user_area','user_area.user_id=user_profile_inst.user_id');
			$this->db->where('user_area.block_code',$institution_block);
			$query = $this->db->get();
	        return $query->result();
    	} 	

    public function getResetUser($user_email,$password)
    	{  
    		//$password= random_string('num', 8); 			
			$this->db->where('user_email',$user_email);
			$this->db->update('user_login',array('user_password'=>MD5($password),'reset_password_flag'=>1));
			return $password;
    	}

    public function getInstitutionUser($user_email,$password)
    	{  
    		//$password= random_string('num', 8); 			
			$this->db->where('user_email',$user_email);
			$this->db->update('user_login',array('user_password'=>MD5($password),'change_password_flag'=>0,'reset_password_flag'=>1));
			return $password;
    	}	 

//.......... End Reset Password ..........//    	

//////........ fetch upload document type......////////////////////////////////

     public function get_upload_document_type()
{

    $this->db->select('*');
    $this->db->from('upload_documents');
    $query=$this->db->get();
	return $query->result_array();


}

///////////////////////////// fetch MaxdocumentID//////////////////////////////////////////////
	public function getMaxDocId() 
	{
		$this->db->select('max(doc_id) AS max_doc_id');
		$this->db->from('uploads');
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
////////////////////////////////// insert documents///////////////////////////////////
public function insertdocuments($document_type,$msg,$user_id,$from_date,$doc_id){
			date_default_timezone_set('Asia/Kolkata');
			$data=array(
				//'doc_id' => $filename,
				'document_message' => $msg,
				//'file_path'=> "notifications_uploads".$user_id."_".$document_type.".pdf",
				'file_path'=> "notifications_uploads/".$user_id."_".$document_type.$doc_id.".pdf",
				'document_type'=> $document_type,
				'uploaded_by'=>$user_id,
				'upload_date'=>$from_date
				
			);
			$flag = $this->db->insert('uploads', $data);
			return $flag;
}	
	
/////////////////////////////////////////////////// fetch documents/////////////////////////////////////////////////////	
    public function fetch_documents()
{
	$this->db->select('*');
	$this->db->from('uploads');
	$query=$this->db->get();
	return $query->result_array();


}

///////////////////////////////////////////////////  fetch_subdivision_report/////////////////////////////////////////////////////	
    public function fetch_subdivision_report($subdivision)
{
	$this->db->select('*');
	$this->db->from('subdivisions');
	$this->db->where('subdivision_code',$subdivision);
	$query=$this->db->get();
	return $query->result_array();


}
		


}
?>

