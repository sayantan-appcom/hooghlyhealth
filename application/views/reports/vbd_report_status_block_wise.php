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

<h2 align="center" class=""> <strong>Vector Borne Disease Status  Report-Block/Municipality Wise</strong> </h2>
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
    <th class="text-center" colspan="<?php echo count($fetch_block); ?>"> Total Positive Case </th>
	<input type="hidden" value="<?php echo $category_id;?> " name="category_id" id="category_id"/>  
  </tr>
  <tr class="bg-success">
  
  <?php 
  

  foreach($fetch_block as $block)
    { 
	$blockmunicd= $block['blockminicd'];

	?>

      <th class="text-center">  <a class="star" target="_blank" href="<?php echo site_url('Reports/fetch_vbd_report_status_institute_wise');?>/<?php echo $blockmunicd;?>/<?php echo $category_id;?> "><?php echo $block['blockmuni']; ?> </a></th>
<?php 
} 

?>	  
  </tr>
  <?php
  	
  	foreach($fetch_subcategory_name as $x)
		{ 

?>
  <tr class="bg-info">
  	<th class="text-center">
	<?php   $disease_sub_id=$x['disease_sub_id']; 
			 ?>

	
	<?php echo $x['disease_sub_name'];?>
	</a>
	</th>
	
	
	<?php
  foreach($fetch_block as $block)
    { 
	?>
    <th class="text-center">
<?php 		
$blockmunicd=$block['blockminicd'];
$varible=0;
	
			$fetch_all_positive_case=fetch_all_positive_case_blockwise($disease_sub_id,$blockmunicd);
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
