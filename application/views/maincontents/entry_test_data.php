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
        Application Form Entry for <b><?php echo $user_name; ?> </b>
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    
    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/insert_test_data');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();                        
                     ?>
             </h3>
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Test Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputPassword1">Test Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Date" id="test_date" name="test_date" autocomplete="off" required="" maxlength="10">
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Total Number of Sample Test <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Total number of sample test" id="total_tested" name="total_tested" autocomplete="off" required="" maxlength="4">
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Positive Test <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter number of Positive Test" id="positive_case" name="positive_case" autocomplete="off" required="" maxlength="4">
                </div>  
               <!-- <div class="form-group">
                  <label for="exampleInputPassword1">Negative Test <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Number of Negative Test" id="negative_case" name="negative_case" autocomplete="off" required="" maxlength="4">
                </div> -->
            </div>

          </div>
        </div>  

      
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Submit</button>
              </div>   


         </form>

      </div>   
    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
  <script type="text/javascript">
  
    $('#test_date').datepicker({
     // autoclose: true,
      minDate: '-21',
      maxDate: '0',
      dateFormat: 'dd-mm-yy'
    });
       

     function validate()
      {
           var r=confirm("Do you really want to submit the form? Once Submit the information you can not change anything !")
          if (r==true)
            return true;
          else
            return false;
      }               
  
  </script>