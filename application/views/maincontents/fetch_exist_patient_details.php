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
    <section class="content">
      <h3 align="center" class="text-danger"><strong><u>Patient Details with the same mobile number</u></strong></h3>
      <table class="table table-bordered">
         <tr>
           <th class="text-center"> Patient ID</th>
           <th class="text-center"> Patient Name</th>
           <th class="text-center"> Mobile No</th>
           <th class="text-center"> Action</th>
         </tr>

         <tr>
            <?php 

            foreach($fetch_exist_patient_details as $fetch_details)
            {
            ?>
          <th scope="row" class="text-center">
            <?php echo $fetch_details['patient_id'];?>
          </th>
          <th class="text-center">
            <?php echo $fetch_details['patient_name'];?>
          </th>
          <th class="text-center">
            <?php echo $fetch_details['patient_mobile'];?>
          </th>
          <th class="text-center">
            <a class="text-primary" href="<?php echo site_url('Health_Home/fetch_patient_details'); ?>/<?php echo $fetch_details['patient_id'];?>">Add Test Details</a>  
          </th>
         </tr>
       <?php
       }
       ?>
      </table>

   <br><br>
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/patient_details');?>"  >
    <input type="hidden" name="patient_name" id="patient_name" value="<?php echo $patient_name; ?>">
    <input type="hidden" name="patient_mobile" id="patient_mobile" value="<?php echo $patient_mobile; ?>">
        
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary" id="">Add New Patient & Test Details</button>
              </div>      
            </div>
        </div>  
    </form>


    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  