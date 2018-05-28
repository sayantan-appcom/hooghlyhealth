<?php 



function fetch_no_sample_tested($disease_sub_id,$start_date1,$end_date1)
{

$ci =& get_instance();
 $ci->load->database();
 $sql="SELECT SUM(test_data.total_tested) AS total_Test,SUM(test_data.positive_case) AS POSITIVE FROM test_data INNER JOIN test_type ON test_type.test_type_code=test_data.test_type_code INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=test_type.disease_sub_category_id WHERE disease_subcatagory.disease_sub_id='$disease_sub_id' AND test_data.test_date between '$start_date1' AND '$end_date1'";

/* SELECT SUM(disease_subcase_code) AS totl_case FROM `diagnosis_tests` INNER JOIN disease_subcatagory ON disease_subcatagory.disease_sub_id=diagnosis_tests.disease_subcase_code WHERE diagnosis_tests.disease_subcase_code = ''  AND test_date between  AND*/ 
$query = $ci->db->query($sql);
$row = $query->result_array();
return $row;

}
?>