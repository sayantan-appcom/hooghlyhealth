<?php

Class Mod_health extends CI_Model {

    public function __construct()
	    {
	        $this->load->database();
	    }
			// Read data using username and password

   
	public function get_state()
    	{   
			$this->db->select ('state_code,state_name');
			$this->db->from('state');
			$query = $this->db->get();
	        return $query->result();
    	}    

    public function get_disease()
    	{   
			$this->db->select ('disease_category_id,disease_category_name');
			$this->db->from('disease_category');
			$query = $this->db->get();
	        return $query->result();
    	}	

    public function get_relation()
    	{   
			$this->db->select ('relative_cd,relative_details');
			$this->db->from('relative_details');
			$query = $this->db->get();
	        return $query->result();
    	}		

    public function patient_status()
    	{   
			$this->db->select ('patient_status_cd,patient_status_name');
			$this->db->from('patient_status');
			$query = $this->db->get();
	        return $query->result();
    	}				

    
    public function getsubdisease($disease_category,$user_type)
    	{   
		
			$this->db->select ('disease_sub_id,disease_sub_name');
			$this->db->from('disease_subcatagory');
			$this->db->join('disease_category','disease_category.disease_category_id=disease_subcatagory.disease_category_id');
			$this->db->join('institution_type','institution_type.sub_disease_flag=disease_subcatagory.sub_disease_flag');
			$this->db->where('disease_subcatagory.disease_category_id',$disease_category);
			$this->db->where('institution_type.inst_type_id',$user_type);
			$query = $this->db->get();
	        return $query->result();
    	}


    public function gettestname($disease_sub_category)
    	{   
			$this->db->select ('test_type_code,test_type_name');
			$this->db->from('test_master');
			$this->db->join('disease_subcatagory', 'disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id');
			$this->db->where('test_master.disease_sub_category_id',$disease_sub_category);
			$query = $this->db->get();
	        return $query->result();
    	} 

    
  	 public function getDistrict($state,$user_id)
    	{   
    		//$condition="user_area.user_id='".$user_id."'AND user_area.state_code='".$state."'";
			$this->db->select ('district.district_code,district.district_name');
			$this->db->from('district');
			$this->db->join('user_area', 'district.district_code = user_area.district_code');
			$this->db->where('user_area.user_id',$user_id);
			$query = $this->db->get();
	        return $query->result();
    	} 	


     public function getSubdivision($district,$user_id)
    	{   
    		$this->db->select ('subdivisions.subdivision_code,subdivisions.subdivision_name');
			$this->db->from('subdivisions');
			$this->db->join('user_area', 'subdivisions.subdivision_code = user_area.subdivision_code');
			$this->db->where('user_area.user_id',$user_id);
			$query = $this->db->get();
	        return $query->result();
    	} 


     public function getBlockmuni($subdivision,$user_id)
    	{   
    		$this->db->select ('block_muni.blockminicd,block_muni.blockmuni');
			$this->db->from('block_muni');
			$this->db->join('user_area', 'block_muni.blockminicd = user_area.block_code');
			$this->db->where('user_area.user_id',$user_id);
			$query = $this->db->get();
	        return $query->result();
    	}

    

    public function get_admission_ward()
    	{   
    		$this->db->select ('ward_id,ward_name');
			$this->db->from('ward');
			$query = $this->db->get();
	        return $query->result();
    	}

    public function get_test_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_id,$total_tested)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
								
				'institution_code'=>$institution_code,
				'test_date'=>$test_date,
				'test_id'=>$test_id,
				'total_tested'=>$total_tested,
				'create_timestamp' => $create_timestamp
				);
			return $this->db->insert('test_data',$data);
			
    	}	
		
		//////////////////////get_max_regisID///////////////////////////////////////
		
    public function get_max_regisID()
    	{
    		$date= date("Y");
			$this->db->select('MAX(convert(SUBSTRING(patient_id,-6),UNSIGNED INTEGER)) AS max_regisID');
			$this->db->from('patient_details');
			$this->db->WHERE("DATE_FORMAT(create_timestamp,'%Y')",$date);
			$query = $this->db->get();
			
			$max_regisID = $query->row()->max_regisID;
			$max_date=substr($max_regisID,12,-6);
			$max_rs=$max_regisID;

			if ($query->num_rows() > 0) 
				{
					/*if($date == $max_date)
					{
						$max_rs1=$max_rs + 1;
						if($max_rs1 < 10) {
							$max_rs1="00000".$max_rs1;
						}
						else if($max_rs1 < 100) {
							$max_rs1="0000".$max_rs1;
						}
						else if($max_rs1 < 1000) {
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
						}*/
						$max_rs1=$max_rs + 1;
						$max_rs1=str_pad($max_rs1,6,"0",STR_PAD_LEFT);

					}
					else
					{
						$max_rs1="000001";
					}
				
			/*else 
				{
					$max_rs1="000001";
				}*/
			return $max_rs1;	
				
		}
		/////////////////////////////////////// patient details add///////////////////////////////////
		 public function get_diagnosis_insert($patient_id,$institution_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$test_type_code,$test_date,$PN_flag)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
				'patient_id' => $patient_id,				
				'institution_code'=>$institution_code,
				'patient_name'=>$patient_name,
				'patient_gurdain_name'=>$patient_gurdain_name,
				'relation_gurdain'=>$relation_gurdain,
				'paient_age'=>$paient_age,
				'patient_gender'=>$patient_gender,
				'patient_district'=>$patient_district,
				'patient_village_town'=>$patient_village_town,
				'patient_pin'=>$patient_pin,
				'patient_address'=>$patient_address,
				'patient_mobile'=>$patient_mobile,
				'patient_phone_no'=>$patient_phone_no,
				'patient_email'=>$patient_email,
				'patient_aadhar'=>$patient_aadhar,
				'patient_epic'=>$patient_epic,
				'create_timestamp' => $create_timestamp
				);
			 $this->db->insert('patient_details',$data);
			
			$data1=array('patient_id'=>$patient_id,
				'institution_code'=>$institution_code,
				'test_id'=>$test_type_code,
				'test_date'=>$test_date,
				'PN_flag'=>$PN_flag,
				'create_timestamp' =>$create_timestamp
				
				);
			return $this->db->insert('patient_test_details',$data1);
			
    	}
/////////////////////////////check patient record/////////////////////////////////
public function search_patient($patient_name,$patient_mobile)
	{
	
	$this->db->select('patient_id');
	$this->db->from('patient_details');
	$condition="patient_details.patient_name='".$patient_name."' AND patient_details.patient_mobile='".$patient_mobile."' ";
	
	 $this->db->where($condition);
	 $query = $this->db->get();

 
   	 if($query->num_rows()>0) 
	{
      $data = $query->row_array();
      $value = $data['patient_id'];
      return $value;
 
   }
   else
   {
   return false;
   }
	
	
	}	
	
/////////////////////fetch patient details////////////////////
public function fetch_patient_details($result)
{
		$this->db->select ('*');
		$this->db->from('patient_details');
	$this->db->where('patient_details.patient_id',$result);
		//$this->db->where($condition);
$query=$this->db->get();
return $query->result_array();

}

	// .......... Insert Admission Details .......... //
	public function get_insert_admission($patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$institution_code,$doctor_name,$disease_subcase_code,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_status,$dischrg_date_time,$referout_date_time,$cause_of_referout,$referout_to_whom,$lama_datetime,$lama_cause,$absconded_datetime,$death_date_time,$cause_of_death,$patient_id)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
        	$data=array(
				'patient_id' => $patient_id,				
				'institution_code'=>$institution_code,
				'patient_name'=>$patient_name,
				'patient_gurdain_name'=>$patient_gurdain_name,
				'relation_gurdain'=>$relation_gurdain,
				'paient_age'=>$paient_age,
				'patient_gender'=>$patient_gender,
				'patient_district'=>$patient_district,
				'patient_village_town'=>$patient_village_town,
				'patient_pin'=>$patient_pin,
				'patient_address'=>$patient_address,
				'patient_mobile'=>$patient_mobile,
				'patient_phone_no'=>$patient_phone_no,
				'patient_email'=>$patient_email,
				'patient_aadhar'=>$patient_aadhar,
				'patient_epic'=>$patient_epic,
				'create_timestamp' => $create_timestamp
				);
			 $this->db->insert('patient_details',$data);
			$data1=array(
				'patient_id' => $patient_id,
				'institution_code' => $institution_code,
				'disease_subcase_code'=>$disease_subcase_code,
				'doctor_name'=>$doctor_name,
				'admission_date_time'=>$admission_date_time,
				'admission_ward'=>$admission_ward,
				'admission_block'=>$admission_block,
				'admission_floor'=>$admission_floor,
				'admission_bed_no'=>$admission_bed_no,
				'patient_status'=>$patient_status,
				'dischrg_date_time'=>$dischrg_date_time,
				'referout_date_time'=>$referout_date_time,
				'cause_of_referout'=>$cause_of_referout,
				'referout_to_whom'=>$referout_to_whom,
				'lama_datetime'=>$lama_datetime,
				'lama_cause'=>$lama_cause,
				'absconded_datetime'=>$absconded_datetime,
				'death_date_time'=>$death_date_time,
				'cause_of_death'=>$cause_of_death,
				'create_timestamp' => $create_timestamp
				);
			 
			return $this->db->insert('admission_details',$data1);
			
    	}

    // .......... Insert Only Admission Details .......... //
	public function get_insert_admission_only($patient_name,$patient_gurdain_name,$paient_age,$patient_mobile,$institution_code,$doctor_name,$disease_subcase_code,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_status,$dischrg_date_time,$referout_date_time,$cause_of_referout,$referout_to_whom,$lama_datetime,$lama_cause,$absconded_datetime,$death_date_time,$cause_of_death,$patient_id)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
        	
			$data=array(
				'patient_id' => $patient_id,
				'institution_code' => $institution_code,
				'disease_subcase_code'=>$disease_subcase_code,
				'doctor_name'=>$doctor_name,
				'admission_date_time'=>$admission_date_time,
				'admission_ward'=>$admission_ward,
				'admission_block'=>$admission_block,
				'admission_floor'=>$admission_floor,
				'admission_bed_no'=>$admission_bed_no,
				'patient_status'=>$patient_status,
				'dischrg_date_time'=>$dischrg_date_time,
				'referout_date_time'=>$referout_date_time,
				'cause_of_referout'=>$cause_of_referout,
				'referout_to_whom'=>$referout_to_whom,
				'lama_datetime'=>$lama_datetime,
				'lama_cause'=>$lama_cause,
				'absconded_datetime'=>$absconded_datetime,
				'death_date_time'=>$death_date_time,
				'cause_of_death'=>$cause_of_death,
				'create_timestamp' => $create_timestamp
				);
			 
			return $this->db->insert('admission_details',$data);
			
    	}			
		

}
?>

