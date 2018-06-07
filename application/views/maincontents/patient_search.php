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
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/search_patient');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();      
						     if (isset($success_message ) ) {
                          echo $success_message;
                          }                  
                     ?>
             </h3>
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Search Patient</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputPassword1">Patient Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Name" id="patient_name" name="patient_name" autocomplete="off" required="" maxlength="50" onKeyPress="return onlyLetters(event)">
                </div>
                
            </div>
            <div class="col-md-6">
            <div class="form-group">
                  <label for="exampleInputPassword1"> Patient Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Patient Mobile" id="patient_mobile" name="patient_mobile" autocomplete="off" required="" maxlength="10" onKeyPress="return onlyNumbers(event)">
                </div>  
            </div>
            </div>

        </div>  

      
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Submit</button>
              </div> 
         </form>
      </div>  

      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <div class="btn btn-lg btn-primary"><a href="<?php echo site_url('Health_Home/patient_details');?>"><font color="#FFFFFF">Add Patient & Patient Test Details</font></a></div>
              </div>                
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  
              </div>                
            </div>
          </div>
        </div>  
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

     function validate()
      {
           var r=confirm("Do you really want to submit the form? Once Submit the information you can not change anything !")
          if (r==true)
            return true;
          else
            return false;
      }               
  
  </script>