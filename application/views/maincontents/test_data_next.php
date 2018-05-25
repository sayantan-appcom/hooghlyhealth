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
      <h3 class="star success_message" align="center">
          <?php                       

              if (isset($success_message ) ) {

                  echo $success_message;
                  }


?>
      
             </h3>
      <br><br><br>
      <div class="container_fluid">
        <div class="col-md-2 col-md-offset-1">
          <div class="btn btn-lg btn-primary"><a href="<?php echo site_url('Health_Home/entry_test_data');?>"><font color="#FFFFFF">Add total number of Test Details</font></a></div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="btn btn-lg btn-primary"><a href="<?php echo site_url('Health_Home/entry_diagnosis_test');?>/<?php echo $user_id; ?>"><font color="#FFFFFF">Add Positive Patient Case Details</font></a></div>
        </div>        
        <div class="col-md-2 col-md-offset-1">
          <div class="btn btn-lg btn-primary"><a href="<?php echo site_url('Health_Home/home');?>"><font color="#FFFFFF">Back to Home</font></a></div>
        </div>
      </div>      
  
    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>