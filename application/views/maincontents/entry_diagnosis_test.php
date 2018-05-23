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
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/insert_diagnosis_test');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Test Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              
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
                  <label for="exampleInputPassword1">Disease Sub Category <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_subcase_code" name="disease_subcase_code" required="">
                      <option value="">Select Disease Sub Category</option>
                    </select>
                </div> 
            </div>

            <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Test Name <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="test_type_code" name="test_type_code" required="">
                      <option value="">Select Test Name</option>
                    </select>
                </div>  
                <div class="form-group">
                  <label for="exampleInputPassword1">Test Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Date" id="test_date" name="test_date" autocomplete="off" required="" maxlength="10">
                </div> 
            </div>

           <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Test Status <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="test_status" name="test_status" required="">
                      <option value="">Select Test Status</option>
                      <option value="01">Positive</option>
                      <option value="02">Negative</option>
                      <option value="03">Further Adviced</option>
                    </select>
                </div>
            </div>

          </div>
        </div>      
   </div>

       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Patient Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="exampleInputPassword1">Patient Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Patient Gurdain Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Gurdain Name" id="patient_gurdain_name" name="patient_gurdain_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Relationship with Gurdain <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient relationship with gurdain" id="relation_gurdain" name="relation_gurdain" autocomplete="off" required="" maxlength="15" onKeyPress="return onlyLetters(event)">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Age <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Age" id="paient_age" name="paient_age" onKeyPress="return onlyNumbers(event)" autocomplete="off" required="" maxlength="3">
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Gender <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="patient_gender" name="patient_gender" required="">
                      <option value="">Select Patient Gender</option>
                      <option value="01">Male</option>
                      <option value="02">Female</option>
                      <option value="03">Transgender</option>
                    </select>
                </div>
               
              
            </div>
           
            <div class="col-md-4">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Patient District <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="patient_district" name="patient_district" required="">
                      <option value="">Select Patient District</option>
                      <option value="06">Hooghly</option>
                    </select>
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Patient village / town <span class="star">*</span> </label>
                    <input type="text" class="form-control" placeholder="Enter Patient village / town" id="patient_village_town" name="patient_village_town" onKeyPress="return onlyLetters(event)" autocomplete="off" maxlength="15" required="">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Postal PIN <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient PIN" id="patient_pin" name="patient_pin" onKeyPress="return onlyNumbers(event)" autocomplete="off" required="" minlength="6" maxlength="6">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Address <span class="star">*</span></label>
                    <textarea class="form-control" id="patient_address" name="patient_address" autocomplete="off" rows="4" placeholder="Enter Patient Address" required="" maxlength="100"></textarea>
                </div> 
                
            </div>
           
            <div class="col-md-4">
               <div class="form-group">
                  <label for="exampleInputEmail1">Patient Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Mobile Number" id="patient_mobile" name="patient_mobile" autocomplete="off" minlength="10" maxlength="10" onKeyPress="return onlyNumbers(event)">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Patient Phone Number </label>
                    <input type="text" class="form-control" placeholder="Enter Patient Phone Number Number" id="patient_phone_no" name="patient_phone_no" autocomplete="off" maxlength="12" onKeyPress="return onlyNumbers(event)">
                </div>               
                <div class="form-group">
                  <label for="exampleInputPassword1">Patient Email Id </label>
                    <input type="text" class="form-control" placeholder="Enter Patient Email Id Number" id="patient_email" name="patient_email" autocomplete="off" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Patient Aadhar Number </label>
                    <input type="text" class="form-control" placeholder="Enter Patient Aadhar Number" id="patient_aadhar" name="patient_aadhar" autocomplete="off" onKeyPress="return onlyNumbers(event)" minlength="16" maxlength="16">
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Patient EPIC </label>
                    <input type="text" class="form-control" placeholder="Enter Patient EPIC Number" id="patient_epic" name="patient_epic" autocomplete="off" maxlength="15">
                </div>
                 
            </div>            
          </div>
        </div>
      
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="lab_submit">Submit</button>
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
 
   
    $('#state_code').change(function(e){
     // alert("nibu");

      var state = $('#state_code').val();
      var user_id = $('#user_id').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getDistrict');?>',
        method: 'post',
        data: {
            state : state,
            user_id : user_id
        },
        dataType: 'json',

        success: function(response){
          $('#district_code').empty();
          $('#district_code').append("<option value=''>Select District</option>");
          $.each(response,function(index,data){
             $('#district_code').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });     

   $('#district_code').change(function(e){
     // alert("nibu");

      var district = $('#district_code').val();
      var user_id = $('#user_id').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getSubdivision');?>',
        method: 'post',
        data: {
            district : district,
            user_id : user_id
        },
        dataType: 'json',

        success: function(response){
          $('#subdiv_code').empty();
          $('#subdiv_code').append("<option value=''>Select Sub-division</option>");
          $.each(response,function(index,data){
             $('#subdiv_code').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });   


   $('#subdiv_code').change(function(e){
     // alert("nibu");

      var subdivision = $('#subdiv_code').val();
      var user_id = $('#user_id').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getBlockmuni');?>',
        method: 'post',
        data: {
            subdivision : subdivision,
            user_id : user_id
        },
        dataType: 'json',

        success: function(response){
          $('#block_muni').empty();
          $('#block_muni').append("<option value=''>Select Block / Municipality</option>");
          $.each(response,function(index,data){
             $('#block_muni').append('<option value="'+data['blockminicd']+'">'+data['blockmuni']+'</option>');
          });
        }
     });
   });     

     

   $('#disease_code').change(function(e){
     // alert("nibu");
      var disease_category = $('#disease_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getsubdisease');?>',
        method: 'post',
        data: {
            disease_category: disease_category
        },
        dataType: 'json',
        success: function(response){
          //alert("nibu");
          $('#disease_subcase_code').empty();
          $('#disease_subcase_code').append("<option value=''>Select Disease Sub Category</option>");
          $.each(response,function(index,data){
             $('#disease_subcase_code').append('<option value="'+data['disease_sub_id']+'">'+data['disease_sub_name']+'</option>');
          });
        }
     });
   });   

   $('#disease_subcase_code').change(function(e){
      //alert("nibu");

      var disease_sub_category = $('#disease_subcase_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/gettestname');?>',
        method: 'post',
        data: {
            disease_sub_category: disease_sub_category
        },
        dataType: 'json',
        success: function(response){
          $('#test_type_code').empty();
          $('#test_type_code').append("<option value=''>Select Test Name</option>");
          $.each(response,function(index,data){
             $('#test_type_code').append('<option value="'+data['test_type_code']+'">'+data['test_type_name']+'</option>');
          });
        }
     });
   }); 

    
   $('#test_done').change(function () {
            if ($(this).val() == "01") {
                $('#test_status').each(function () {
                    $(this).prop('disabled', false);
                });
            }
            else if ($(this).val() == "00") {
                $('#test_status').each(function () {
                    $(this).prop('disabled', false);
                });
            }
            else {
                $('#test_status').each(function () {
                    $(this).prop('disabled', true);
                    $(this).prop('checked', false);
                });
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