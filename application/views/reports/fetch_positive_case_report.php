<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>District Status Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" />
</head>

<body class="bg-danger disableRightClick">
		<?php
			foreach($fetch_positive_test as $x)
			{
			$disease_sub_name=$x['disease_sub_name'];
		
			}
			?>
	
		<h2 align="center"><span class="label label-success"><b>List of Positive Cases - <?php echo $disease_sub_name; ?> </b></span></h2>
        
        <br>
        <div class="container">
        	<div align="left">
        		<strong> District  : HOOGHLY  </strong>
        	</div>
        	<?php
			foreach($fetch_positive_test as $x)
			{
			$institution_name=$x['inst_name'];
			$institution_mobile=$x['inst_mobile'];
			$institution_Address=$x['inst_addr'];
			}
			?>
		<div align="right">
        	<strong> Institution Name:<?php echo $institution_name;?> </strong>
        </div>
        <div align="left">
        	<strong> Institution Address:<?php echo $institution_Address;?> </strong>
        </div>
        <div align="right">
        	<strong> Institution Mobile:<?php echo $institution_mobile;?> </strong>
        </div>
			
			</div>

        	
        <br>
		<div class="container">
  			<table class="table" align="center" border="2">
  				 <tr class="bg-success">
  					<th class="text-center">Patient ID / Registration ID</th>
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

  			<td class="text-center"> <?php echo $x['patient_id']; ?> </td>
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
            <td class="text-center"> <?php  $age= $x['paient_age']; 
			$year=explode("/",$age);
		
			 $patient_year=$year[0];
			 $patient_month=$year[1];
			 
			//print_r($year);
			if($patient_year!=0)
			{
			$current_year=$patient_year;
			
			
			}
			else
			{
			$current_year=0;
			
			}
			if($patient_month!=0)
			{
			$current_month=$patient_month;
			}
			else
			{
			$current_month=$patient_month;
			}
			 echo $patient_current_age=$current_year. " "."year". " ".$current_month. " month";
			 //echo $patient_year."/". $patient_month;
			
			?> </td>
            <td class="text-center"> <?php  echo $x['patient_address'] . " "."  pin code:". $x['patient_pin'] ; ?> </td>
            <td class="text-center"> <?php echo $x['patient_mobile']; ?> </td>
  			<td class="text-center"> <?php echo $x['test_type_name']; ?> </td>
  			<td class="text-center"> Positive </td>
  				</tr>
  				<?php } ?>
  			</table>
    	</div>

	
<script type="text/javascript">
  $('.disableRightClick').on("contextmenu",function(e){
        alert('You can not Use Right Click');
        return false;
    });
</script>
	
	</body>
</html>
