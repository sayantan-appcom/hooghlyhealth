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

<h2 align="center" class=""> <strong>Vector Borne Disease Report -Sub Category WISE</strong> </h2>
<br><br>
<div class="row">
<?php

$this->load->helper('report');


?>
<br><br>
<div class="container">
<div>Disease Name:<?php echo $disease_category_name;?>
</div>
<table class="table" align="center" border="2">
  <tr class="bg-success">
    
    <th class="text-center"> Total Positive Case </th>
  
  </tr>

</table>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>
</html>

