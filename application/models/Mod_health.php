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

}
?>

