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
<body class="bg-danger">

<h2 align="center"> Date wise Report Form </h2>
<div class="row">
<?php
$start_date=$start_date;
$end_date=$end_date;
$this->load->helper('report');
foreach($institution_details as $x)
{
?>
<div class="container-fluid">
<div class="container">
  <div class="col-md-4"><strong>State:  <?php echo "WEST BENGAL";?></strong></div>
  <div class="col-md-4"><strong>District:  <?php echo $x['district_name'];?></strong></div>
  <div class="col-md-4"><strong>Block:  <?php echo $x['blockmuni'];?></strong></div>
</div>
<?php
	date_default_timezone_set('Asia/Kolkata');
    $date=date("d-m-Y");
?>
<div class="container">
  <div class="col-md-4"><strong>Reporting Date:  <?php echo $date;?></strong></div>
  <div class="col-md-4"><strong>Start Date:  <?php echo $start_date;?></strong></div>
  <div class="col-md-4"><strong>End Date:<?php echo $end_date;?></strong></div>
</div>

<div class="container">
  <div class="col-md-4"><strong>Institute Name:  <?php echo $x['inst_name'];?></strong></div>
  <div class="col-md-4"><strong>Institute Mobile:  <?php echo $x['inst_mobile'];?></strong></div>
</div>

</div>
<?php
}
?>
<br><br>
<div class="container">
<table class="table" align="center" border="2">
  <tr class="bg-success">
    <th class="text-center">Diseases</th>
    <th class="text-center">No. Samples Tested </th>
    <th class="text-center">No. found Positive </th>
	<th class="text-center">No. found Negative </th>
  </tr>
  <?php
  	foreach($fetch_all_disease_subcategory as $x)
		{ 
	?>

  <tr class="bg-warning">
  	<th class="text-center">	
		<?php 
			$disease_sub_id=$x['disease_sub_id'];
			echo $x['disease_sub_name'];
			$positive=0;
			$negative;
		?>
	
	</th>
    <td class="text-center">
		<?php		 
			$no_sample_tested=fetch_no_sample_tested($disease_sub_id,$start_date,$end_date);
			foreach($no_sample_tested as $sample_tested)
               {
				 if($sample_tested['total_Test']!=0)
					{
				 echo $sample_tested['total_Test'];
					}
				  else
					{
						echo 0;
					}
			   }
	    ?>	
	</td>
    <td class="text-center">
    <?php 
    if($sample_tested['POSITIVE']!=0)
    {
	
	echo $sample_tested['POSITIVE'];
	
	}
	else
	{
	echo 0;

	}
	?>
	</td>
	<td class="text-center">
	<?php
	 $negative=$sample_tested['total_Test']-$sample_tested['POSITIVE'];
	 echo $negative;
	 ?>
	</td>
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
