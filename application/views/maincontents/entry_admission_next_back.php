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
        Application Form Entry
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>-->
    </section>
<?php
           foreach($patient as $row)
                 { ?>
    <!-- Main content -->
    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/insert_admission');?>" onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="registration_id" id="registration_id" value="<?php echo $row['registration_id']; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>      
       
     
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Patient Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Patient Name <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)" value="<?php echo $row['patient_name']; ?>" readonly> 
              </div>               
              <div class="form-group">
                  <label for="exampleInputEmail1">Patient Mobile Number <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)" value="<?php echo $row['patient_mobile']; ?>" readonly> 
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Patient Age <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)" value="<?php echo $row['paient_age']; ?>" readonly> 
              </div>               
              <div class="form-group">
                  <label for="exampleInputEmail1">Patient Gender <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)" value="<?php 
                   if($row['patient_gender'] == "01")
                   {
                    echo "Male";
                   } 
                   else if($row['patient_gender'] == "02")
                   {
                    echo "Female";
                   }
                   else
                   {
                    echo "Transgender";
                   }  
                  ?>" readonly> 
              </div> 
            </div>
            <div class="col-md-4">
            <div class="form-group">
                  <label for="exampleInputEmail1">Patient Address <span class="star">*</span></label>
                  <textarea class="form-control" id="patient_address" name="patient_address" autocomplete="off" rows="4" placeholder="Enter Patient Address" required="" maxlength="100" readonly><?php echo $row['patient_address']; ?></textarea>
              </div> 
            </div>
          </div>
        </div>
        <?php } ?>
         <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Admission Details</u></strong></h3>
        </div>
       <?php
           foreach($patient as $row)
                 { ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Doctor Name <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="doctor_name" name="doctor_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)">                

                </div> 
                <?php } ?>
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="admission_date_time" name="admission_date_time" autocomplete="off" required="" maxlength="10">
              </div>
                           
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Ward <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="admission_ward" name="admission_ward" required="">
                      <option value="">Select Admission Ward</option>
                      <?php
                          foreach($get_admission_ward as $ward)
                            { 
                              echo '<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Block </label>
                    <input type="text" class="form-control" placeholder="Enter Admission Block" id="admission_block" name="admission_block" autocomplete="off" maxlength="10">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Floor </label>
                    <input type="text" class="form-control" placeholder="Enter Floor" id="admission_floor" name="admission_floor" autocomplete="off" maxlength="10">
              </div>   
              
            </div>
            
            <div class="col-md-4">
              
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Bed Number </label>
                    <input type="text" class="form-control" placeholder="Enter Bed Number" id="admission_bed_no" name="admission_bed_no" autocomplete="off" maxlength="10">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Patient Status <sub> (at the time of discharge) </sub> <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="patient_status" name="patient_status" required="">
                      <option value="">Select Patient Status</option>
                      <?php
                          foreach($patient_status as $row)
                            { 
                              echo '<option value="'.$row->patient_status_cd.'">'.$row->patient_status_name.'</option>';
                            }
                      ?>
                    </select> 
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Discharge Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Discharge Date & Time" id="dischrg_date_time" name="dischrg_date_time" autocomplete="off" required="" maxlength="10" disabled="" required="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Transfer Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Transfer Date & Time" id="transfer_date_time" name="transfer_date_time" autocomplete="off" maxlength="10" disabled="" required="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1"> Cause of Transfer <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Cause of Transfer" id="cause_of_transfer" name="cause_of_transfer" autocomplete="off" maxlength="10" disabled="" required="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputPassword1">Transfer to Whom <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Transfer to whom" id="transfer_to_whom" name="transfer_to_whom" autocomplete="off" maxlength="10" disabled="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1"> Force Transfer Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Force Transfer Date & Time" id="force_transfer_datetime" name="force_transfer_datetime" autocomplete="off" maxlength="10" disabled="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Cause of Force Transfer <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Cause of force Transfer" id="force_transfer_cause" name="force_transfer_cause" autocomplete="off" maxlength="10" disabled="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Death Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Death Date & Time" id="death_date_time" name="death_date_time" autocomplete="off" maxlength="10" disabled="">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Cause of Death <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Cause of Death" id="cause_of_death" name="cause_of_death" autocomplete="off" maxlength="10" disabled="">
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Submit</button>
              </div> 
         </form>
    </section>
  </div>

  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
  
   
    $('#admission_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
    $('#dischrg_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
    $('#transfer_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
    $('#force_transfer_datetime').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
    $('#death_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
    
   

   $('#patient_status').change(function () {
            if ($(this).val() == "01") {                
                  $("#dischrg_date_time").prop("disabled", false);
                  $("#transfer_date_time").prop("disabled", true);
                  $("#cause_of_transfer").prop("disabled", true);
                  $("#transfer_to_whom").prop("disabled", true);
                  $("#force_transfer_datetime").prop("disabled", true);
                  $("#force_transfer_cause").prop("disabled", true);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
                }
              
            else if ($(this).val() == "02") {
                  $("#transfer_date_time").prop("disabled", false);
                  $("#cause_of_transfer").prop("disabled", false);
                  $("#transfer_to_whom").prop("disabled", false);
                  $("#dischrg_date_time").prop("disabled", true);                  
                  $("#force_transfer_datetime").prop("disabled", true);
                  $("#force_transfer_cause").prop("disabled", true);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);               
                }

            else if ($(this).val() == "03") {
                  $("#force_transfer_datetime").prop("disabled", false);
                  $("#force_transfer_cause").prop("disabled", false);
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#transfer_date_time").prop("disabled", true);
                  $("#cause_of_transfer").prop("disabled", true);
                  $("#transfer_to_whom").prop("disabled", true);                  
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);            
                }
                
            else if ($(this).val() == "05") {
                  $("#death_date_time").prop("disabled", false);
                  $("#cause_of_death").prop("disabled", false);
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#transfer_date_time").prop("disabled", true);
                  $("#cause_of_transfer").prop("disabled", true);
                  $("#transfer_to_whom").prop("disabled", true);
                  $("#force_transfer_datetime").prop("disabled", true);
                  $("#force_transfer_cause").prop("disabled", true);       
                }
                            
            else {
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#transfer_date_time").prop("disabled", true);
                  $("#cause_of_transfer").prop("disabled", true);
                  $("#transfer_to_whom").prop("disabled", true);
                  $("#force_transfer_datetime").prop("disabled", true);
                  $("#force_transfer_cause").prop("disabled", true);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
            }
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