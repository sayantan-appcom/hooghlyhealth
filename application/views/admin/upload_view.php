<html>

<body>
 <?php
if (isset($this->session->userdata['logged_in'])) {
 echo $user_id = ($this->session->userdata['logged_in']['user_id']);
 $user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
<div id="content">

<h1>HIMS Dcuments Upload</h1>
<h4 id="loading" style="display: none;">Loading...</h4>
<div id="message"><?php echo "<font color='red'>$error</font>";?> <!-- Error Message will show up here --></div>

<hr><hr id="line"> 
	<div id="selectImage" style="background:#3F9; width:40%;">
		<label>Select Your File (<font color="#990055"><strong>Maximum 1 MB. Only PDF format is allowed</strong></font>)</label><br /><br />
		<?php echo form_open_multipart('Admin/upload_document/');?> 
		  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
              Notification Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="form-control" data-toggle="tooltip" data-placement="left" title="document_type " name="document_type" id="document_type">
			      
			
            <?php
             foreach($upload_type as $row)
             { 
             	echo '<option value="'.$row['upload_type_id'].'">'.$row['upload_type_name'].'</option>';
				
             }
           ?>
        </select><br /><br />
		     <label for="exampleInputPassword1">From Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="from_date" name="from_date" autocomplete="off" required="" maxlength="10"><br/>
        Message:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<input type='text' name='msg' id='msg' placeholder='Message to be displayed (Maximum 255 characters)' size='20' class='form-control' data-toggle='tooltip' data-placement='left' align='left' title='Notification Type' style='width:350px;' maxlength='255' />"; ?><br /><br />
		<?php echo "<input type='file' name='userfile' size='20' id='file'/>"; ?>
		<?php echo "<input type='submit' name='submit' value='Upload' class='submit'/> ";?><br><br>
	</div>
<?php echo "</form>"?>
</div>
</body>
</html>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('#from_date').datepicker({
      autoclose: true,
      endDate: new Date(),
      format: 'yyyy-mm-dd'
    });
	</script>



