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
<!--<table class="table table-striped" border="3">
 <thead>
 <tr>
        <th scope="col" rowspan="2">Institute Name:</th>
         <th scope="col">Institute Mobile:</th>
                  
 </tr>
 <tr>
  <th scope="col">Institute Name:</th>
   <th scope="col">Institute Mobile:</th>
 </tr>
 <tr>
 
 </tr>
 
 </thead>
</table>-->
<h2 align="center"> Date wise Report Form </h2>
<div class="row">

<div class="container">
<?php
$start_date=$start_date;
$end_date=$end_date;

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


<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>
