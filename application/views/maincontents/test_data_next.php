<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
 
  <div class="content-wrapper">
   
    <section class="content-header">
      <h1>
         Welcome to <b><?php echo $user_name; ?> </b>
      </h1>
      
    </section>

    
    <section class="content">
       <br><br><br>
      <div class="container_fluid">
        <div class="col-md-3 col-md-offset-2">
          <button class="btn btn-lg btn-primary"><a href="<?php echo site_url('Health_Home/entry_diagnosis_test');?>/<?php echo $user_id; ?>"><font color="#FFFFFF">Add Patient Details</font></a></button>
        </div>
        <div class="col-md-3 col-md-offset-2">
          <button class="btn btn-lg btn-info"><a href="<?php echo site_url('Health_Home/entry_test_data');?>"><font color="#FFFFFF">Add Test Details</font></a></button>
        </div>
      </div>
  
    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  