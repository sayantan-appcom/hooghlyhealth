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

<h2 align="center" class=""> <strong>Vector Borne Disease Report - IDSP (FORM - P) Datewise</strong> </h2>
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
  <div class="col-md-4"><strong><mark>District: <?php echo $x['district_name'];?></mark></strong></div>
  <div class="col-md-4"><strong><mark>Block:  <?php echo $x['blockmuni'];?></mark></strong></div>
</div>
<?php
	date_default_timezone_set('Asia/Kolkata');
    $date=date("d-m-Y");
?>
<div class="container">
  <div class="col-md-4"><strong><mark>Reporting Date: <?php echo $date;?></mark></strong></div>
  <div class="col-md-4"><strong><mark>Start Date: <?php echo $start_date;?></mark></strong></div>
  <div class="col-md-4"><strong><mark>End Date:  <?php echo $end_date;?></mark></strong></div>
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
<table class="table" align="center"  border="2">
  <tr class="bg-success">
    <th class="text-center">Sl.No</th>
    <th class="text-center">Disease </th>
    <th class="text-center">No. of Cases </th>

  </tr>
  <?php
    $institution_code=$x['user_id'];
	$count=1;
  	foreach($fetch_all_disease_admission as $x)
		{ 
	?>

  <tr class="bg-info">
  <th class="text-center">
  <?php echo $count;?>
  </th>
  	<th class="text-center">	
		<?php 
	 $disease_syndrome_id=$x['disease_syndrome_id'];
			
			echo $x['disease_syndrome_name'];
	
		?>
	
	</th>
    <th class="text-center">
		<?php	
		// echo $disease_syndrome_id;
			$fetch_no_case=fetch_no_case($disease_syndrome_id,$start_date,$end_date,$institution_code);

			foreach($fetch_no_case as $fetch_case)
               {
				 if($fetch_case['CASES']!=0)
					{
				 ?>
<a class="star" target="_blank" href="<?php echo site_url('Reports/fetch_admission_patient_details'); ?>/<?php echo $disease_syndrome_id;?>/<?php echo $institution_code;?>"><?php echo $fetch_case['CASES'];?></a>	
					<?php
					}
				  else
					{
						echo 0;
					}
			   }
			   
			   
	    ?>	
	</th>


  </tr>
 <?php 
 $count++;
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
