<?php 



function fetch_no_sample_tested($disease_sub_id,$start_date1,$end_date1,$institution_code)
{

 $ci =& get_instance();
 $ci->load->database();

 //$sql="SELECT SUM(test_data.total_tested) AS total_Test,SUM(patient_test_details.PN_flag) AS POSITIVE FROM test_master LEFT JOIN patient_test_details ON test_master.test_type_code=patient_test_details.test_id LEFT JOIN test_data ON test_data.test_id=test_master.test_type_code LEFT JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id  WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND test_data.test_date between '$start_date1' AND '$end_date1' AND test_data.institution_code='$institution_code' ";
 
 $sql="SELECT SUM(test_data.total_tested) AS total_Test FROM test_data INNER JOIN test_master ON test_master.test_type_code=test_data.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id  WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND test_data.test_date between '$start_date1' AND '$end_date1' AND test_data.institution_code='$institution_code' ";


$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}

function fetch_no_positive_tested($disease_sub_id,$start_date1,$end_date1,$institution_code)
{

 $ci =& get_instance();
 $ci->load->database();


 //$sql="SELECT SUM(patient_test_details.PN_flag) AS POSITIVE FROM patient_test_details LEFT JOIN test_data ON test_data.test_id=patient_test_details.test_id LEFT JOIN test_master ON test_master.test_type_code=test_data.test_id LEFT JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id  WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND patient_test_details.test_date between '$start_date1' AND '$end_date1' AND patient_test_details.institution_code='$institution_code' ";
 //////////////////////////running query/////////////////////
 
 /* $sql="SELECT COUNT(patient_test_details.PN_flag) AS POSITIVE FROM patient_test_details,test_master,disease_subcatagory WHERE patient_test_details.test_id=test_master.test_type_code AND  test_master.disease_sub_category_id=disease_subcatagory.disease_sub_id AND patient_test_details.institution_code='$institution_code' AND patient_test_details.test_date BETWEEN '$start_date1' AND '$end_date1' AND disease_subcatagory.disease_sub_id='$disease_sub_id '";*/
   //////////////////////////running query/////////////////////
   
   
   
///////////////////////////////////////Inner join/////////////////////

 $sql="SELECT COUNT(patient_test_details.PN_flag) AS POSITIVE FROM patient_test_details INNER JOIN test_master ON test_master.test_type_code =patient_test_details.test_id INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id WHERE patient_test_details.institution_code='$institution_code' AND patient_test_details.test_date BETWEEN '$start_date1' AND '$end_date1' AND disease_subcatagory.disease_sub_id='$disease_sub_id '";



$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}
?>