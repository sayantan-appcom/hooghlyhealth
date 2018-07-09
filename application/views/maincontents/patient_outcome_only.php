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
        Application Form for Admission
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    
    <section class="content">
      <?php
         foreach($fetch_patient_details as $result1)
         {
         ?>
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/patient_outcome_insert');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">
    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $result1['patient_id']; ?>">
	<input type="hidden" name="admission_date_time" id="admission_date_time" value="<?php echo $result1['admission_date_time']; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        
                     ?>
             </h3>
      
      

       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Patient Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
               <div class="form-group">
                  <label for="exampleInputPassword1">Patient Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" readonly="" maxlength="30" value="<?php echo $result1['patient_name'];?>">
                </div>
                <?php } ?>
                <div class="form-group">
                  <label for="exampleInputPassword1">Patient Gurdain Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Gurdain Name" id="patient_gurdain_name" name="patient_gurdain_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)" readonly=""  value="<?php echo $result1['patient_gurdain_name'];?>">
                </div>
                
            </div>
           
            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Age <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Age" id="paient_age" name="paient_age" onKeyPress="return onlyNumbers(event)" autocomplete="off" required="" maxlength="3" readonly="" value="<?php echo $result1['paient_age'];?>">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Mobile Number" id="patient_mobile" name="patient_mobile" autocomplete="off" minlength="10" maxlength="10" onKeyPress="return onlyNumbers(event)" readonly="" value="<?php echo $result1['patient_mobile'];?>">
                </div>
                
            </div>
           
                             
          </div>

        </div>
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Admission Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">              
                
                 <div class="form-group">
                  <label for="exampleInputPassword1">Patient Status  <span class="star">*</span></label>
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
                  <label for="exampleInputPassword1">Discharge Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Discharge Date & Time" id="dischrg_date_time" name="dischrg_date_time" autocomplete="off" required="" maxlength="10" disabled="" required="" value="<?php echo set_value('dischrg_date_time'); ?>"/>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Refer Out Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="referout_type" name="referout_type" required="" disabled="">
                      <option value="">Select Refer out type</option>
                      <option value="01">Normal</option>
                      <option value="02">LAMA</option>
                    </select>
                </div>
             
              
                           
              
                              
            </div>
            <div class="col-md-4">
              
              
              <div class="form-group">
                  <label for="exampleInputPassword1">ReferOut Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Transfer Date & Time" id="referout_date_time" name="referout_date_time" autocomplete="off" maxlength="10" disabled="" required="" value="<?php echo set_value('referout_date_time'); ?>">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1"> Cause of ReferOut <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Cause of Transfer" id="cause_of_referout" name="cause_of_referout" autocomplete="off" maxlength="20" disabled="" required="" value="<?php echo set_value('cause_of_referout'); ?>">
              </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Referring Hospital <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Transfer to whom" id="referout_to_whom" name="referout_to_whom" autocomplete="off" maxlength="20" disabled="" value="<?php echo set_value('referout_to_whom'); ?>">
              </div>                 
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputPassword1">Absconded Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Death Date & Time" id="absconded_datetime" name="absconded_datetime" autocomplete="off" maxlength="10" disabled="" value="<?php echo set_value('absconded_datetime'); ?>">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Death Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Death Date & Time" id="death_date_time" name="death_date_time" autocomplete="off" maxlength="10" disabled="" value="<?php echo set_value('death_date_time'); ?>">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Cause of Death <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Cause of Death" id="cause_of_death" name="cause_of_death" autocomplete="off" maxlength="10" disabled="" value="<?php echo set_value('cause_of_death'); ?>">
              </div> 
            </div>
            
        </div> 
      </div>
    </div>

      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Submit</button>
              </div>   
            </div>

         </form>
      </div>   
    </section> 
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
    $('#dischrg_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
    $('#referout_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
    $('#lama_datetime').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
    $('#death_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
    $('#absconded_datetime').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
    
   

   $('#patient_status').change(function () {
            if ($(this).val() == "01") {                
                  $("#dischrg_date_time").prop("disabled", false);
                  $("#referout_date_time").prop("disabled", true);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
                  $("#absconded_datetime").prop("disabled", true);
                  $("#referout_type").prop("disabled", true);
                }
              
            else if ($(this).val() == "02") {
                  $("#referout_type").prop("disabled", false);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
                  $("#absconded_datetime").prop("disabled", true);
                  $("#dischrg_date_time").prop("disabled", true);               
                }

            else if ($(this).val() == "03") {
                  $("#absconded_datetime").prop("disabled", false);
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#referout_date_time").prop("disabled", true);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);                  
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
                  $("#referout_type").prop("disabled", true);            
                }    
                
            else if ($(this).val() == "04") {
                  $("#death_date_time").prop("disabled", false);
                  $("#cause_of_death").prop("disabled", false);
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#referout_date_time").prop("disabled", true);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);
                  $("#absconded_datetime").prop("disabled", true); 
                  $("#referout_type").prop("disabled", true);      
                }
                            
            else {
                  $("#dischrg_date_time").prop("disabled", true);
                  $("#referout_date_time").prop("disabled", true);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);
                  $("#death_date_time").prop("disabled", true);
                  $("#cause_of_death").prop("disabled", true);
                  $("#absconded_datetime").prop("disabled", true);
                  $("#referout_type").prop("disabled", true);
            }
        });

   $('#referout_type').change(function () {
            if ($(this).val() == "01") {               
                 
                  $("#referout_date_time").prop("disabled", false);
                  $("#cause_of_referout").prop("disabled", false);
                  $("#referout_to_whom").prop("disabled", false);                 
                }
              
            else if ($(this).val() == "02") {
                  $("#referout_date_time").prop("disabled", false);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);               
                }
                            
            else {
                  $("#referout_date_time").prop("disabled", true);
                  $("#cause_of_referout").prop("disabled", true);
                  $("#referout_to_whom").prop("disabled", true);
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
  