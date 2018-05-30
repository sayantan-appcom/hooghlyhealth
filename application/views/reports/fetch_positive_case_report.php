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
		<?php
			foreach($fetch_positive_test as $x)
			{
			$disease_sub_name=$x['disease_sub_name'];
		
			}
			?>
	
		<h2 align="center"><span class="label label-success"><b>List Of Positive Cases-<?php echo $disease_sub_name;?> </b></span></h2>
        
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
			$institution_mobile=$x['inst_mobile'];
			$institution_Address=$x['inst_addr'];
			}
			?>
			<strong> Institution Name:<?php echo $institution_name;?>
			</strong>
			<strong> Institution Mobile:<?php echo $institution_mobile;?>
			</strong>
			<strong> Institution Address:<?php echo $institution_Address;?>
			</strong>
			
		</div>
			
			</div>

        	</div>

        </div>
        <br>
		<div class="container">
  			<table class="table" align="center" border="2">
  				 <tr class="bg-success">
  					<th class="text-center">Registration ID</th>
  					<th class="text-center">Patient Name</th>
  					<th class="text-center">Patient Gurdain Name</th>
  					<th class="text-center">Patient Gender</th>
                    <th class="text-center">Patient Age</th>
                    <th class="text-center">Patient Address details</th>
                    <th class="text-center">Patient Mobile</th>
  					<th class="text-center">Name of the Test</th>
  					<th class="text-center">Diagnosis (Lab Confirmed)</th>
  				</tr>
  				 <?php foreach($fetch_positive_test as $x)
				{
				?>
  			<tr class="bg-warning">

  			<td class="text-center"> <?php echo $x['registration_id']; ?> </td>
  			<td class="text-center"> <?php echo $x['patient_name']; ?> </td>
  			<td class="text-center"> <?php echo $x['patient_gurdain_name']; ?> </td>
  			<td class="text-center"> 
  				<?php 
  				if( $x['patient_gender']== '01') 
  					{ 
  						echo "Male";
  					}
  				else if( $x['patient_gender']== '02') 
  					{ 
  						echo "Female";
  					}
  				else
  				{
  					echo "Transgender";

  				}	 
  				?> 
  			</td>
            <td class="text-center"> <?php echo $x['paient_age']; ?> </td>
            <td class="text-center"> <?php  echo $x['patient_address'] . " "."  pin code:". $x['patient_pin'] ; ?> </td>
            <td class="text-center"> <?php echo $x['patient_mobile']; ?> </td>
  			<td class="text-center"> <?php echo $x['test_type_name']; ?> </td>
  			<td class="text-center"> Positive </td>
  				</tr>
  				<?php } ?>
  			</table>
    	</div>

	

	
	</body>
</html>
