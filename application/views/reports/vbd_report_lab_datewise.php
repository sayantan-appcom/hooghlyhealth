 <?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vector Bone Disease Report
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <section class="content">
    <form role="form" method="POST" action="<?php //echo site_url('Health_Home/insert_diagnosis_test');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
      

       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Report for Diagnosis Test</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="exampleInputEmail1">State <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="state_code" name="state_code" required="">
                      <option value="">Select State</option>
                      <?php
                          foreach($get_state as $row)
                            { 
                              echo '<option value="'.$row->state_code.'">'.$row->state_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">District <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="district_code" name="district_code" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="subdiv_code" name="subdiv_code" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
            
                <div class="form-group">
                  <label for="exampleInputPassword1">Block / Municipality <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="block_muni" name="block_muni" required="">
                      <option value="">Select Block / Municipality</option>
                    </select>
                </div> 
            </div>
           
            <div class="col-md-4">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Institution Name <span class="star">*</span></label>
                     <select class="form-control select2" style="width: 100%;" id="institution_code" name="institution_code" required="">
                      <option value="">Select Institute Name</option>
                      <option value="<?php echo $user_id; ?>"><?php echo $user_name; ?></option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">From Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="from_date" name="from_date" autocomplete="off" required="" maxlength="10">
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">To Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="to_date" name="to_date" autocomplete="off" required="" maxlength="10">
                </div>                 
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
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('#from_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yy'
    });
  $('#to_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yy'
    });
</script> 