<?php

Class Mod_report extends CI_Model {

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
		
		
		
////////////////////////////////fetch state and district subdivision block muni//////////////////////////////////////////////////////////////
    public function getDistrict_reports($state)
    	{   
			$this->db->select ('district_code,district_name');
			$this->db->from('district');
			$this->db->join('state', 'district.state_code=state.state_code');
			$this->db->where('district.state_code',$state);
			$query = $this->db->get();
	        return $query->result();
    	} 	

    public function getSubdivision_reports($district)
    	{   
			$this->db->select ('subdivision_code,subdivision_name');
			$this->db->from('subdivisions');
			$this->db->join('district', 'subdivisions.district_code=district.district_code');
			$this->db->where('district.district_code',$district);
			$query = $this->db->get();
	        return $query->result();
    	} 

    public function getBlockMuni_reports($subdivision)
    	{   
			$this->db->select ('blockminicd,blockmuni');
			$this->db->from('block_muni');
			$this->db->join('subdivisions','block_muni.subdivisioncd=subdivisions.subdivision_code');
			$this->db->where('block_muni.subdivisioncd',$subdivision);
			$query = $this->db->get();
	        return $query->result();
    	} 	

		
////////////////////////////////fetch state and district subdivision block muni//////////////////////////////////////////////////////////////
		 						
///////////////////////////////// fetch Institution Name///////////////////////////////////////////////////////////////////////////////////////
    public function get_institute()
    	{   
			$this->db->select ('inst_type_id,inst_type_name');
			$this->db->from('institution_type');
			$query = $this->db->get();
	        return $query->result();
    	}	

///////////////////////////////// fetch Institution Name///////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////fetch instiruion Details/////////////////////////////////////////////////////////////////////////////////
public function fetch_instituion_details($inst_name)
{

$this->db->select('district.district_name,block_muni.blockmuni,user_profile_inst.inst_name,user_profile_inst.inst_mobile,user_profile_inst.user_id');
$this->db->from('user_area');
$this->db->join('district','district.district_code=user_area.district_code');
$this->db->join('block_muni','block_muni.blockminicd=user_area.block_code');
$this->db->join('user_profile_inst','user_profile_inst.user_id=user_area.user_id');
$this->db->where('user_profile_inst.user_id',$inst_name);
$query = $this->db->get();
 return $query->result_array();

}
///////////////////////////////////fetch Disease subcategory////////////////////////////////////////////////////////////////
public function fetch_all_disease_subcategory()
{
$this->db->select('*');
$this->db->from('disease_subcatagory');
$query=$this->db->get();
return $query->result_array();


}
public function fetch_positive_test($disease_sub_id,$institution_code)
{
$this->db->select('patient_details.registration_id,patient_details.patient_name,patient_details.patient_address,patient_details.patient_mobile,patient_details.patient_pin,patient_details.registration_id,user_profile_inst.inst_name,patient_details.paient_age,patient_details.patient_gender,test_type.test_type_name,disease_subcatagory.disease_sub_name,user_profile_inst.inst_mobile,user_profile_inst.inst_addr');
$this->db->from('patient_details');
$this->db->join('test_type',' test_type.test_type_code=patient_details.test_type_code');
$this->db->join('disease_subcatagory',' disease_subcatagory.disease_sub_id=patient_details.disease_subcase_code');
$this->db->join('user_profile_inst',' user_profile_inst.user_id=patient_details.institution_code');
$condition="patient_details.disease_subcase_code='".$disease_sub_id."' AND patient_details.institution_code='".$institution_code."' ";
$this->db->where($condition);
$query=$this->db->get();
return $query->result_array();

}

}
?>

