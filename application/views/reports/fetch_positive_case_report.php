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
<html lang="en">
 <head>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 	<title>District Status Report</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
 </head>	
	<body class="bg-danger disableRightClick">
		<h2 align="center"><span class="label label-success"><b>VECTOR BONE DISEASE POSITIVE REPORT INSTITUION WISE </b></span></h2>
        
        <br>
        <div class="container">
        	<div class="col-md-2 col-md-offset-3" align="left">
        		<strong> District  : HOOGHLY  </strong>
        	</div>
        	<div class="col-md-3 col-md-offset-2" align="right">
			<?php
			foreach($fetch_positive_test as $x)
			{
			$institution_name=$x['inst_name'];
			}
			?>
			<strong> Institution Name:<?php echo $institution_name;?>
			</strong>

        	</div>

        </div>
        <br>
		<div class="container">
  			<table class="table" align="center" border="2">
  				 <tr class="bg-success">
  					<th class="text-center">Registration ID</th>
  					<th class="text-center">Paintent Name</th>
                    <th class="text-center">Paintent Adress</th>
                    <th class="text-center">Paintent MObile</th>
  					<th class="text-center">Paintent Pin</th>
  				</tr>
  				 <?php foreach($fetch_positive_test as $x)
				{
				?>
  			<tr class="bg-warning">

  			<td class="text-center"> <?php echo $x['registration_id']; ?> </td>
  			<td class="text-center"> <?php echo $x['patient_name']; ?> </td>
            <td class="text-center"> <?php echo $x['patient_address']; ?> </td>
            <td class="text-center"> <?php  echo $x['patient_mobile']; ?> </td>
  			<td class="text-center"> <?php echo $x['patient_pin']; ?> </td>
  				</tr>
  				<?php } ?>
  			</table>
    	</div>

	

	
	</body>
</html>
