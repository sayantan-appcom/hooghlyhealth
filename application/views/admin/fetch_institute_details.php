
<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report of Hooghly Health</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
  <body class="bg-warning disableRightClick">
   
    <section class="content">
    	<div class="row">
    		<div class="container-fluid">
    			
    			<div class="col-md-12">
    				<h2 align="center" class="bg-primary"> Institution Details  </h2>
    				<br>
				<div > <strong>Subdivision Name: </strong>
				<strong>
					
					<?php 
			       foreach($fetch_subdiviosn as $subdivision)
			    {
				
				echo $subdivision['subdivision_name'];
				
			     } 
				 
				?>
				</strong>
				</div><br />
			
    				<table align="center" class="table table-bordered table-striped">
		
					
				
						<?php
					$count=1;
					
					?>
    				<tr class="success">
					   <th class="text-center"> Sl No.</th>
						<th class="text-center"> Institution Name</th>
						<th class="text-center"> Institution License No</th>
						<th class="text-center"> Institution Address</th>
						<th class="text-center"> Institution Mobile No</th>
						<th class="text-center"> Institution Phone No</th>
						<th class="text-center"> Institution Email  ID</th>
						<th class="text-center"> Institution Owner Name</th>
						<th class="text-center"> Institution Owner Mobile No</th>
						<th class="text-center"> Institution Owner Email ID</th>
					</tr>

					<?php foreach($fetch_institute_details as $institute)
					{
						
					?>
					<tr class="danger">	
				
				      <td class="text-center"><?php echo  $count; ?></td>			
						<td class="text-center"><?php echo  $institute['inst_name']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_license_no']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_addr']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_mobile']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_phone']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_email']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_owner_name']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_owner_mobile']; ?></td>
						<td class="text-center"><?php echo  $institute['inst_owner_email']; ?></td>
					</tr>
					<?php
						$count++;
									
							}
						
							
						?>
					
					</table>
					<h3><?php echo $this->session->flashdata('response_user');  ?></h3>
    			</div>

    		</div> 
    		<br>  		
    		<div class="container text-right">    			
    			<?php 
    				date_default_timezone_set('Asia/Kolkata');
    			echo date("Y-m-d h:i:sa"); ?> 
    		</div>
    	</div>
	
	</section>
	<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
   $('.disableRightClick').on("contextmenu",function(e){
        //alert('You can not Use Right Click');
        return false;
    });
</script>

</body>
</html>
	

