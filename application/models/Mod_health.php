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

    public function get_week()
    	{   
			$this->db->select ('week_cd,week_name');
			$this->db->from('weekly');
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

    public function get_details()
    	{   
			$this->db->select ('district_code,district_name');
			$this->db->from('district');
			$this->db->join('state', 'district.state_code=state.state_code');
			$this->db->where('district.state_code',$state);
			$query = $this->db->get();
	        return $query->result();
    	} 

    public function get_case_type()
    	{   
			$this->db->select ('case_type_cd,case_type_name');
			$this->db->from('case_type');
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

    
    public function getsubdisease($disease_category)
    	{   
			$this->db->select ('disease_sub_id,disease_sub_name');
			$this->db->from('disease_subcatagory');
			$this->db->join('disease_category','disease_category.disease_category_id=disease_subcatagory.disease_category_id');
			$this->db->where('disease_subcatagory.disease_category_id',$disease_category);
			$query = $this->db->get();
	        return $query->result();
    	}


    public function gettestname($disease_sub_category)
    	{   
			$this->db->select ('test_type_code,test_type_name');
			$this->db->from('test_type');
			$this->db->join('disease_subcatagory', 'disease_subcatagory.disease_sub_id=test_type.disease_sub_category_id');
			$this->db->where('test_type.disease_sub_category_id',$disease_sub_category);
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

    public function entry_admission_next($test_date,$registration_id)
    	{   
    		$this->db->select ('registration_id,patient_name,patient_address,patient_mobile,paient_age,patient_gender');
			$this->db->from('diagnosis_tests');
			$this->db->where('registration_id',$registration_id);
			$query = $this->db->get();
	        return $query->result_array();
    	}

    public function get_admission_ward()
    	{   
    		$this->db->select ('ward_id,ward_name');
			$this->db->from('ward');
			$query = $this->db->get();
	        return $query->result();
    	}

    public function test_date($user_id)
    	{   
    		$this->db->distinct();
    		$this->db->select ('test_date');
			$this->db->from('test_data');
			$this->db->WHERE('institution_code',$user_id);
			$query = $this->db->get();
	        return $query->result();
    	}

    public function get_registrationId($test_date)
    	{   
			$this->db->select ('registration_id');
			$this->db->from('diagnosis_tests');			
			$this->db->where('test_date',$test_date);
			$query = $this->db->get();
	        return $query->result();
    	}		

     public function get_fulldetails($institution_code)
    	{   
    		$this->db->select ('*');
			$this->db->from('user_area');
			$this->db->WHERE('user_id',$institution_code);
			$query = $this->db->get();
	        return $query->result_array();
    	}

    public function get_test_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_type_code,$total_tested,$positive_case/*,$negative_case*/)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
								
				'institution_code'=>$institution_code,
				'test_date'=>$test_date,
				'test_type_code'=>$test_type_code,
				'total_tested'=>$total_tested,
				'positive_case'=>$positive_case,
				//'negative_case'=>$negative_case,
				'create_timestamp' => $create_timestamp
				);
			return $this->db->insert('test_data',$data);
			
    	}					 			

    public function get_max_regisID()
    	{
    		$date= date("Y");
			$this->db->select('MAX(convert(SUBSTRING(registration_id,-6),UNSIGNED INTEGER)) AS max_regisID');
			$this->db->from('diagnosis_tests');
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
		
    public function get_diagnosis_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_type_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$registration_id)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
				'registration_id' => $registration_id,				
				'institution_code'=>$institution_code,
				'disease_code'=>$disease_code,
				'disease_subcase_code'=>$disease_subcase_code,
				'test_type_code'=>$test_type_code,
				'test_date'=>$test_date,
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
			return $this->db->insert('diagnosis_tests',$data);
			
    	}

    
    public function get_insert_admission($registration_id,$institution_code,$doctor_name,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_status,$dischrg_date_time,$transfer_date_time,$cause_of_transfer,$transfer_to_whom,$force_transfer_datetime,$force_transfer_cause,$death_date_time,$cause_of_death)
    	{   
			date_default_timezone_set('Asia/Kolkata');
        	$create_timestamp=date("Y-m-d H:i:s");
			$data=array(
				'registration_id' => $registration_id,
				'institution_code' => $institution_code,
				'doctor_name'=>$doctor_name,
				'admission_date_time'=>$admission_date_time,
				'admission_ward'=>$admission_ward,
				'admission_block'=>$admission_block,
				'admission_floor'=>$admission_floor,
				'admission_bed_no'=>$admission_bed_no,
				'patient_status'=>$patient_status,
				'dischrg_date_time'=>$dischrg_date_time,
				'transfer_date_time'=>$transfer_date_time,
				'cause_of_transfer'=>$cause_of_transfer,
				'transfer_to_whom'=>$transfer_to_whom,
				'force_transfer_datetime'=>$force_transfer_datetime,
				'force_transfer_cause'=>$force_transfer_cause,
				'death_date_time'=>$death_date_time,
				'cause_of_death'=>$cause_of_death,
				'create_timestamp' => $create_timestamp
				);
			 
			return $this->db->insert('admission',$data);
			
    	} 			 						

    public function getdisease($test_date,$institution_code)
    	{   
    		$condition="test_data.institution_code='".$institution_code."' AND test_data.test_date='".$test_date."' ";
    		$this->db->distinct();
			$this->db->select ('disease_category.disease_category_name,disease_category.disease_category_id');
			$this->db->from('test_type');
			$this->db->join('disease_category', 'test_type.disease_category_id = disease_category.disease_category_id');
			$this->db->join('test_data', 'test_type.test_type_code = test_data.test_type_code');
			$this->db->where($condition);
			$query = $this->db->get();
	        return $query->result();
    	}	

 ///////////////////////////////////////fetch get_subdisease/////////////////////////////////
    	public function get_subdisease($test_date,$disease_code,$institution_code)
    	{
    		$condition=$condition="test_data.institution_code='".$institution_code."' AND test_data.test_date='".$test_date."'  AND disease_subcatagory.disease_category_id='".$disease_code."' ";
    		$this->db->distinct();
            $this->db->select ('disease_sub_id,disease_sub_name');
			$this->db->from('test_type');
			$this->db->join('disease_subcatagory', 'test_type.disease_sub_category_id = disease_subcatagory.disease_sub_id');
			$this->db->join('test_data', 'test_type.test_type_code = test_data.test_type_code');
			$this->db->where($condition);

			$query = $this->db->get();
	        return $query->result();

    	}

    ///////////////////////////////////////fetch test name/////////////////////////////////
    	public function get_test_name($disease_subcase_code,$test_date,$disease_code,$institution_code)
    	{
    		$condition=$condition="test_data.institution_code='".$institution_code."' AND test_data.test_date='".$test_date."'  AND test_type.disease_sub_category_id='".$disease_subcase_code."'";
    		$this->db->distinct();
            $this->db->select ('test_type.test_type_code,test_type.test_type_name');
			$this->db->from('test_type');
			$this->db->join('disease_subcatagory', 'test_type.disease_sub_category_id = disease_subcatagory.disease_sub_id');
			$this->db->join('test_data', 'test_type.test_type_code = test_data.test_type_code');
			$this->db->where($condition);
			$query = $this->db->get();
	        return $query->result();

    	}	




}
?>

