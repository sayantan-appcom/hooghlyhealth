<?php 
$block1=array();


function fetch_no_sample_tested($disease_sub_id,$start_date,$end_date)
{
$ci =& get_instance();
 $ci->load->database();
 $sql="SELECT SUM(disease_subcase_code) AS totl_case FROM `diagnosis_tests` INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=diagnosis_tests.disease_subcase_code WHERE diagnosis_tests.disease_subcase_code = '$disease_sub_id'  AND test_date between '$start_date' AND '$end_date'";
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}
?>