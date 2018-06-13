<?php 



function fetch_no_sample_tested($disease_sub_id,$start_date1,$end_date1,$institution_code)
{

 $ci =& get_instance();
 $ci->load->database();

 $sql="SELECT test_data.total_tested AS total_Test,SUM(patient_test_details.PN_flag) AS POSITIVE FROM test_master INNER JOIN patient_test_details ON test_master.test_type_code=patient_test_details.test_id INNER JOIN test_data ON test_data.test_id=test_master.test_type_code INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_master.disease_sub_category_id  WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND test_data.test_date between '$start_date1' AND '$end_date1' AND test_data.institution_code='$institution_code'";


$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}
?>