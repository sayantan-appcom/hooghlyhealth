<?php 



function fetch_no_sample_tested($disease_sub_id,$start_date1,$end_date1,$institution_code)
{

 $ci =& get_instance();
 $ci->load->database();
 
 $sql="SELECT SUM(test_data.total_tested) AS total_Test FROM test_data INNER JOIN test_master ON test_master.test_type_code=test_data.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id  WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND test_data.test_date between '$start_date1' AND '$end_date1' AND test_data.institution_code='$institution_code' ";


$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}

function fetch_no_positive_tested($disease_sub_id,$start_date1,$end_date1,$institution_code)
{
   
///////////////////////////////////////Inner join/////////////////////
 $ci =& get_instance();
 $ci->load->database();
 $sql="SELECT COUNT(patient_test_details.PN_flag) AS POSITIVE FROM patient_test_details INNER JOIN test_master ON test_master.test_type_code =patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id WHERE patient_test_details.institution_code='$institution_code' AND patient_test_details.test_date BETWEEN '$start_date1' AND '$end_date1' AND disease_subcatagory.disease_sub_id='$disease_sub_id '";
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}

function fetch_no_case($disease_syndrome_id,$start_date,$end_date,$institution_code)
{

$sql=" SELECT COUNT(*) AS CASES FROM admission_details  WHERE admission_details.disease_syndrome_code='$disease_syndrome_id'  AND  admission_details.institution_code='$institution_code' AND admission_details.admission_date_time BETWEEN '$start_date' AND '$end_date'";
 $ci =& get_instance();
 $ci->load->database();
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}


function fetch_all_positive_case($disease_sub_id,$blockmuni_code)
{

$sql="select disease_subcatagory.disease_sub_id,count(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id= test_master.disease_sub_category_id  INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN block_muni ON block_muni.blockminicd=user_area.block_code WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND block_muni.blockminicd='$blockmuni_code' GROUP BY disease_subcatagory.disease_sub_id";
 $ci =& get_instance();
 $ci->load->database();
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}



function fetch_positive_case($test_type_code,$blockmuni_code)
	{
		$sql="select test_master.test_type_code,count(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN block_muni ON block_muni.blockminicd=user_area.block_code WHERE test_master.test_type_code='$test_type_code' AND block_muni.blockminicd='$blockmuni_code' GROUP BY test_master.test_type_code";
		 $ci =& get_instance();
		 $ci->load->database();
		$query = $ci->db->query($sql);
		$row = $query->result_array();
		return $row;
	}	
	
	
//////////////////////////////////// fetch all positive case districtwise//////////////////////////////////////////////////////
function fetch_all_positive_case_districtwise($disease_sub_id,$subdivision_code)
{

/*$sql="select disease_subcatagory.disease_sub_id,count(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id= test_master.disease_sub_category_id  INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN subdivisions ON subdivisions.subdivision_code=user_area.subdivision_code WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND subdivisions.subdivision_code='$subdivision_code' GROUP BY disease_subcatagory.disease_sub_id";*/
$sql="select COUNT(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id= test_master.disease_sub_category_id  INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN subdivisions ON subdivisions.subdivision_code=user_area.subdivision_code WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND subdivisions.subdivision_code='$subdivision_code' ";
 $ci =& get_instance();
 $ci->load->database();
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}	

//////////////////////////////////// fetch all positive case districtwise//////////////////////////////////////////////////////
function fetch_all_positive_case_blockwise($disease_sub_id,$blockmunicd)
{

/*$sql="select disease_subcatagory.disease_sub_id,SUM(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id= test_master.disease_sub_category_id  INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN block_muni ON  block_muni.blockminicd=user_area.block_code WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND block_muni.blockminicd='$blockmunicd' GROUP BY disease_subcatagory.disease_sub_id";*/


$sql="select COUNT(patient_test_details.PN_flag) as positive_flag from patient_test_details INNER JOIN test_master ON test_master.test_type_code=patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id= test_master.disease_sub_category_id  INNER JOIN user_area on user_area.user_id=patient_test_details.institution_code INNER JOIN block_muni ON  block_muni.blockminicd=user_area.block_code WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND block_muni.blockminicd='$blockmunicd' ";
 $ci =& get_instance();
 $ci->load->database();
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}	



?>