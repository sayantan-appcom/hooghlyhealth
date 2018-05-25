<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report of Hopghly Health</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <!-- jQuery 2.2.3 -->

</head>
<body>

<h2 align="center"> Date wise Report Form </h2>
<div class="row">

<div class="container">
<?php
$start_date=$start_date;
$end_date=$end_date;
$this->load->helper('report');
foreach($institution_details as $x)
{
?>
  <div class="col-md-6">Institute Name:<?php echo $x['inst_name'];?></div>
  <!--<div class="col-md-6">Institute Mobile:</div>-->
</div>

<div class="container">
  <div class="col-md-4">State:<?php echo "WEST BENGAL";?></div>
  <div class="col-md-4">District:<?php echo $x['district_name'];?></div>
  <div class="col-md-4">Block:<?php echo $x['blockmuni'];?></div>
</div>

<div class="container">
  <div class="col-md-4">Reporting Date:</div>
  <div class="col-md-4">Start Date:<?php echo $start_date;?></div>
  <div class="col-md-4">End Date:<?php echo $end_date;?></div>
</div>

</div>
<?php
}
?>
<table width="100%" border="1">
  <tr>
    <td>Diseases</td>
    <td align="center">No. Samples Tested </td>
    <td align="center">No. found Positive </td>
	<td align="center">No. found Negative </td>
  </tr>
  <?php
	foreach($fetch_all_disease_subcategory as $x)
{ ?>

  <tr>
    <td>
	
<?php $disease_sub_id=$x['disease_sub_id'];
echo $x['disease_sub_name'];
$positive=0;
$negative;

	?>
	
	</td>
    <td class="text-center">
					  <?php
				 $no_sample_tested=fetch_no_sample_tested($disease_sub_id,$start_date,$end_date);
				  foreach($no_sample_tested as $sample_tested)
               {
                
			
					
		
				 echo $sample_tested['totl_case'];
				 $total_case=$sample_tested['totl_case'];
					
            
			  
			    }
	?>
	
	</td>
    <td>
	<?php echo $positive;?>
	
	</td>
	<td>
	<?php
	 $negative=$sample_tested['totl_case']-$positive;
	 echo $negative;
	 ?>
	</td>
  </tr>
 <?php 
 }
 ?>
</table>



<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>
