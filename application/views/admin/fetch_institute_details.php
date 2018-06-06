
<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>
<html>
<body>
<div>
    <section class="content-header">
      <h1>
        Institution Details       
      </h1>
    
    </section>
	<table align="center" border="2">
	<tr>
	<th class="text-center"> INSTITUTE NAME:</th>
	<th class="text-center"> INSTITUTE LICENSE NO:</th>
	<th class="text-center"> INSTITUTE ADDRESS:</th>
	<th class="text-center"> INSTITUTE MOBILE NO:</th>
	<th class="text-center"> INSTITUTE EMAIL:</th>
	<th class="text-center"> INSTITUTE OWNER NAME:</th>
	<th class="text-center"> INSTITUTE OWNER MOBILE NO:</th>
	</tr>
	<tr>
	<?php foreach($fetch_institute_details as $institute)
	{
	?>
	<th><?php echo  $institute['inst_name']; ?></th>
	<th><?php echo  $institute['inst_license_no']; ?></th>
	<th><?php echo  $institute['inst_addr']; ?></th>
	<th><?php echo  $institute['inst_mobile']; ?></th>
	<th><?php echo  $institute['inst_email']; ?></th>
	<th><?php echo  $institute['inst_owner_name']; ?></th>
	<th><?php echo  $institute['inst_owner_mobile']; ?></th>
	</tr>
	<?php
	}?>
	</table>
	
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
