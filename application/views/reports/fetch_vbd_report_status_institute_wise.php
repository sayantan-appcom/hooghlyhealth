<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report of Hooghly Health</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <!-- jQuery 2.2.3 -->
	<style type="text/css">
      .star { 
          color:red;
            }
  	</style>
</head>
<body class="bg-danger">

<h2 align="center" class=""> <strong>Vector Borne Disease Status Tracking Report-Institution  Wise</strong> </h2>
<br><br>
<div class="row">
<?php

$this->load->helper('report');


?>
<br><br>
<div class="container">
<table class="table" align="center" border="2">
  <tr class="bg-success">
    <th class="text-center" rowspan="2">Institution Name</th>
    <th class="text-center" colspan="<?php echo count($fetch_subcategory_name); ?>"> Total Positive Case </th>
	
  </tr>
  <tr class="bg-success">
  
  <?php 
  

	foreach($fetch_subcategory_name as $x)
		{  
	 $disease_sub_id=$x['disease_sub_id']; 

	?>

      <th class="text-center">  <?php echo $x['disease_sub_name'];?> </th>
<?php 
} 

?>	  
  </tr>
  <?php
  	
  	foreach($fetch_institution_report as $x)
		{ 

?>
  <tr class="bg-info">
  	<th class="text-center">
	<?php   
	$user_id=$x['user_id']; 
	
	 ?>

	<?php echo $x['inst_name'];?>
	
	</th>
	
	
	<?php
	
	foreach($fetch_subcategory_name as $category)
		{  
	
	?>
    <th class="text-center">
<?php 
 $disease_sub_id=$category['disease_sub_id']; 		
$user_id=$x['user_id']; 
$varible=0;
	
			$fetch_all_positive_case_institution_wise=fetch_all_positive_case_institution_wise($disease_sub_id,$user_id);
			foreach($fetch_all_positive_case_institution_wise as $sample_tested)
               {
				 if($sample_tested['positive_flag']!=0)
					{
				 echo $sample_tested['positive_flag'];
					}
				  else
					{
						echo 0;
					}
				
				}
	    ?>	
	</th>
<?php
}

?>
  </tr>
 <?php 
 }
 
 ?>
</table>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>
