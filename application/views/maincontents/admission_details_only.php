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
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/insert_admission_only');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">
    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $result1['patient_id']; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('admission_error');
                        
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
            <div class="col-md-6">              
                <div class="form-group">
                  <label for="exampleInputPassword1">Disease Category <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_code" name="disease_code" required="">
                      <option value="">Select Disease Category</option>
                      <?php
                          foreach($get_disease as $row)
                            { 
                              echo '<option value="'.$row->disease_category_id.'">'.$row->disease_category_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Disease Assume Syndrome <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_syndrome_code" name="disease_syndrome_code" required="">
                      <option value="">Select Disease Syndrome</option>
                    </select>
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Doctor Name <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter Patient Name" id="doctor_name" name="doctor_name" autocomplete="off" maxlength="30" onKeyPress="return onlyLetters(event)" value="<?php echo set_value('doctor_name'); ?>"> 
                </div> 
                
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Date & Time <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="admission_date_time" name="admission_date_time" autocomplete="off" required="" maxlength="10" value="<?php echo set_value('admission_date_time'); ?>">
              </div>
                           
                            
            </div>
            <div class="col-md-6">
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
                    <input type="text" class="form-control" placeholder="Enter Admission Block" id="admission_block" name="admission_block" autocomplete="off" maxlength="10" value="<?php echo set_value('admission_block'); ?>">
              </div>  
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Floor </label>
                    <input type="text" class="form-control" placeholder="Enter Floor" id="admission_floor" name="admission_floor" autocomplete="off" maxlength="10" value="<?php echo set_value('admission_floor'); ?>">
              </div> 
              <div class="form-group">
                  <label for="exampleInputPassword1">Admission Bed Number </label>
                    <input type="text" class="form-control" placeholder="Enter Bed Number" id="admission_bed_no" name="admission_bed_no" autocomplete="off" maxlength="10" value="<?php echo set_value('admission_bed_no'); ?>">
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
   
    $('#admission_date_time').datetimepicker({startDate: new Date() -21,
      endDate: new Date(),format: 'yyyy-mm-dd hh:ii'});
   

    function validate()
      {       
                   
           var r=confirm("Do you really want to submit the form? Once Submit the information you can not change anything !")
          if (r==true)
            return true;
          else
            return false;
      }

    $('#disease_code').change(function(e){
     // alert("nibu");
      var disease_category = $('#disease_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getsyndrome');?>',
        method: 'post',
        data: {
            disease_category : disease_category
        },
        dataType: 'json',
        success: function(response){
          //alert("nibu");
          $('#disease_syndrome_code').empty();
          $('#disease_syndrome_code').append("<option value=''>Select Disease Syndrome</option>");
          $.each(response,function(index,data){
             $('#disease_syndrome_code').append('<option value="'+data['disease_syndrome_id']+'">'+data['disease_syndrome_name']+'</option>');
          });
        }
     });
   });     
  
  </script>
  