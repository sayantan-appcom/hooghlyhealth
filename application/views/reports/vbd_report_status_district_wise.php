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

<h2 align="center" class=""> <strong>Vector Borne Disease Status Report-(Subdivision Wise)</strong> </h2>
<br><br>
<div class="row">
<?php

$this->load->helper('report');


?>
<br><br>
<div class="container">
<table class="table" align="center" border="2">
  <tr class="bg-success">
    <th class="text-center" rowspan="2">Diseases</th>
    <th class="text-center" colspan="4"> Total Positive Case </th>  
	<input type="hidden" value="<?php echo $category_name;?> " name="category_name" id="category_name"/>
   </tr>
  
  <tr class="bg-success">
  <?php 
  foreach($fetch_subdivision as $subdiv)
    { 
	$subdivision_code= $subdiv['subdivision_code'];;
	
	?>

    <th class="text-center"><a class="star" target="_blank" href="<?php echo site_url('Reports/fetch_vbd_report_status_block_wise');?>/<?php echo $subdivision_code;?>/<?php echo $category_name;?> "> <?php echo $subdiv['subdivision_name']; 
	 $subdiv['subdivision_code'];
	?> </a></th>
<?php } ?>	  
  </tr>
  <?php
  
  	foreach($fetch_subcategory_name as $x)
		{ 

?>
  <tr class="bg-info">
  	<th class="text-center">	
		<?php 
			  $disease_sub_id=$x['disease_sub_id'];
			echo $x['disease_sub_name'];
			
		?>
	
	</th>
	<?php
		 foreach($fetch_subdivision as $subdiv)
    { 
	?>
    <th class="text-center">
<?php 		
  $subdivision_code=$subdiv['subdivision_code'];

	
			$fetch_all_positive_case=fetch_all_positive_case_districtwise($disease_sub_id,$subdivision_code);
			foreach($fetch_all_positive_case as $sample_tested)
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
