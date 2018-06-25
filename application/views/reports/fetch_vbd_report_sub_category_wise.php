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

<h2 align="center" class=""> <strong>Vector Borne Disease Report (Sub Category wise)</strong> </h2>
<?php 
  foreach($fetch_block_muni as $a)
    { ?>
      <h3 align="center" class=""> Block : <?php echo $a['blockmuni'];
                                                $blockmuni_code=$a['blockminicd'];
            ?> </h3>
 <?php } ?>     
<br><br>
<div class="row">
<?php

$this->load->helper('report');


?>
<br><br>
<div class="container">
<table class="table" align="center" border="2">
  <?php 
  foreach($fetch_sub_category_name as $y)
    { ?>
  <tr>
    <th colspan="2" class="text-center">Disease Name : <?php echo $y['disease_sub_name'];?> </th>
  </tr>
  <?php } ?>
 
  <tr class="bg-success">
    <th class="text-center">Test Name</th>
    <th class="text-center"> Total Positive Case </th>
  
  </tr>
  <?php
  // echo $institution_code=$x['user_id'];
    foreach($gettestname as $x)
    { 
  ?>

  <tr class="bg-info">
    <th class="text-center">  
    <?php 
       $test_type_code=$x['test_type_code'];
      echo $x['test_type_name'];
      
    ?>
  
  </th>
    <th class="text-center">
    <?php    
      $fetch_positive_case=fetch_positive_case($test_type_code,$blockmuni_code);
      foreach($fetch_positive_case as $sample_tested)
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


  </tr>
 <?php 
 }
//}
 ?>
</table>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>

