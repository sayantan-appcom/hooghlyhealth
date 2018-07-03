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

<h2 align="center" class=""> <strong>Vector Borne Disease Report - IDSP (FORM - L) Datewise</strong> </h2>
<br><br>
<div class="row">
<?php
$start_date=$start_date;
$end_date=$end_date;
$this->load->helper('report');
foreach($institution_details as $x)
{
?>
<div class="row">
<div class="container">
  <div class="col-md-4"><strong><mark>State:  <?php echo "WEST BENGAL";?></mark></strong></div>
  <div class="col-md-4"><strong><mark>District:  <?php echo $x['district_name'];?></mark></strong></div>
  <div class="col-md-4"><strong><mark>Block:  <?php echo $x['blockmuni'];?></mark></strong></div>
</div>
<?php
	date_default_timezone_set('Asia/Kolkata');
    $date=date("d-m-Y");
?>
<div class="container">
  <div class="col-md-4"><strong><mark>Reporting Date:  <?php echo $date;?></mark></strong></div>
  <div class="col-md-4"><strong><mark>Start Date:  <?php echo $start_date;?></mark></strong></div>
  <div class="col-md-4"><strong><mark>End Date:   <?php echo $end_date;?></mark></strong></div>
</div>

<div class="container">
  <div class="col-md-4"><strong><mark>Institute Name:  <?php echo $x['inst_name'];?></mark></strong></div>
  <div class="col-md-4"><strong><mark>Institute Mobile:  <?php echo $x['inst_mobile'];?></mark></strong></div>
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
    $institution_code=$x['user_id'];
  	foreach($fetch_all_disease_subcategory as $x)
		{ 
	?>

  <tr class="bg-info">
  	<th class="text-center">	
		<?php 
			$disease_sub_id=$x['disease_sub_id'];
			echo $x['disease_sub_name'];
			$positive=0;
			$negative;
		?>	</th>
    <th class="text-center">
		<?php		 
			$no_sample_tested=fetch_no_sample_tested($disease_sub_id,$start_date,$end_date,$institution_code);
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
			   
	    ?>	</th>
    <th class="text-center star">
    <?php
	
	}
	else
	{
	echo 0;

	}
	}
	?>
    <?php 
		$no_sample_tested=fetch_no_positive_tested($disease_sub_id,$start_date,$end_date,$institution_code);
			foreach($no_sample_tested as $sample_tested1)
               {
    if($sample_tested1['POSITIVE']!=0)
    {
	
	?>
	
	<a class="star" target="_blank" href="<?php echo site_url('Reports/fetch_positive_test'); ?>/<?php echo $disease_sub_id;?>/<?php echo $institution_code;?>  "><?php echo $sample_tested1['POSITIVE'];?></a></th>
	<th class="text-center">
	<?php
	 $negative=$sample_tested['total_Test']-$sample_tested1['POSITIVE'];
	 echo $negative;
	 ?>	</th>
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
