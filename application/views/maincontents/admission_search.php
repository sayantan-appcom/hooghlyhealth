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
        Application Form of search patient for Admission
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    
    <section class="content">
    <form role="form" method="POST" action="">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('admission_msg');                  
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
                <button type="submit" class="btn btn-lg btn-success" id="search_admission">Submit</button>
              </div> 
         </form>
      </div>  

      
          <div class="row hidden msg">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                  <div class="btn btn-lg btn-primary">
                    <a href="<?php echo site_url('Health_Home/admission_details');?>"><font color="#FFFFFF">Add Patient & Admission Details</font></a>
                  </div>
              </div>                
            </div>            
          </div>

          <div class="row hidden patient">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                
                    <div class="btn btn-lg btn-primary">
                    <a href="<?php echo site_url('Health_Home/admission_details_only');?>" id="patient_id" name="patient_id"><font color="#FFFFFF">Add Admission Details</font></a>
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

    $('#search_admission').click(function(e)
     { 
     // alert("NIBU");
          e.preventDefault();
           valid = true; 
          
             if($('#patient_name').val()=='')
              {
                alert('Enter Patient Name');
                return false;        
              }
              if($('#patient_mobile').val()=='')
              {
                alert('Enter Patient Mobile');
                return false;        
              }  
                     
   
      $('#search_admission').prop('disabled',true);

        var report;
        var application;

            $.ajax({
                     mimeType: 'text/html; charset=utf-8',       
                     url: '<?php  echo base_url('Health_Home/check_patient');?>',
                     type:'POST',            
                     data:{
                            patient_name : $('#patient_name').val(),
                            patient_mobile : $('#patient_mobile').val()
                          },

                    success: function(data) { 

                      report=JSON.parse(JSON.stringify(data));
                      if(report.Patient_ID != undefined)
                      {
                        Patient_ID=report.Patient_ID;  
                        alert(report.Status+" Your Patient ID : "+report.Patient_ID + $(".patient").val());
                        var href = $('#patient_id').prop('href');
                        $('#patient_id').prop('href',href+'/'+report.Patient_ID);
                        $('.patient').removeClass('hidden');
                        //$('.chck').html(report[0].Patient_ID);
                      }
                          else{
                            alert(report.Status);
                          
                          $('.msg').removeClass('hidden');
                          }
                           
                    },
                   error: function (data) {
                          
                    },    
                dataType: "json",
                async: false
        });

       $('#search_admission').prop('disabled',false);
  }); 
 
  </script>