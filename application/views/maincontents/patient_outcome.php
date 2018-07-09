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
        Application Form for Patient Outcome       </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    
    <section class="content">
    <form role="form" method="POST" action="<?php //echo site_url('Health_Home/admission_details_next');?>">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('message');                  
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
                  <label for="exampleInputPassword1">Admission Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="admission_date_time" name="admission_date_time" autocomplete="off" required="" maxlength="10" value="<?php echo set_value('admission_date_time'); ?>">
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
                <button type="submit" class="btn btn-lg btn-success" id="patient_outcome">Submit</button>
                <!--<button type="refrsh" class="btn btn-lg btn-primary" onClick="window.location.href= <?php //echo base_url('Health_Home/admission_search'); ?>">Refresh</button>-->
      </div>
</div> 
<!--
              <div class="row hidden patient">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                
                    <div class="btn btn-primary">
                    
                    <button type="submit" class="btn btn-primary">Add New Patient & Admission Details</button>

              </div>    
              </div>                
            </div>            
          </div>  

   -->

         </form>
       

      
         

          <div class="container show hidden">
            <table class="table" id="show_patient_outcome">
              <thead>
              <tr>
                <th class="text-center">Patient ID</th>
                <th class="text-center">Patient Name</th>
                <th class="text-center">Patient Mobile</th>
				 <th class="text-center">Patient Admission Date</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
               <!-- <th class="text-center patientid"></th>
                <th class="text-center patientname"></th>
                <th class="text-center patientmobile"></th>-->
             
            </tbody>
            </table>
          </div>
          

    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">

  //$('#admission_date_time').datepicker({startDate: new Date() -21,
    //  endDate: new Date(),format: 'dd-mm-yyyy hh:ii'});
  $('#admission_date_time').datepicker({
      autoclose: true,
      endDate: new Date(),
      format: 'yyyy-mm-dd'
    });

    $('#patient_outcome').click(function(e)
     { 
    var admission_date_time=$('#admission_date_time').val();
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
                     
   
      $('#patient_outcome').prop('disabled',true);

        var report;
        var application;

            $.ajax({
                     mimeType: 'text/html; charset=utf-8',       
                     url: '<?php  echo base_url('Health_Home/check_patient_outcome');?>',
                     type:'POST',            
                     data:{
                            admission_date_time : $('#admission_date_time').val(),
                            patient_mobile : $('#patient_mobile').val()
                          },

                    success: function(data) { 
                     //alert("nibu");
                      console.log(data);
                      report=JSON.parse(JSON.stringify(data));
                      if(report.length > 0)
                      {
                       
                        $('.show').removeClass('hidden');
                      
                        $('#show_patient_outcome > tbody').empty();
                        $.each(report,function(index){
                         // alert("nib");
                    $('#show_patient_outcome > tbody').append("<tr><td align='center'>"+report[index].patient_id+"</td><td align='center'>"+report[index].patient_name+"</td><td align='center'>"+report[index].patient_mobile+"</td><td align='center'>"+report[index].admission_date_time+"</td><td align='center'> <div class='btn btn-primary'><a href='<?php echo site_url('Health_Home/patient_outcome_only');?>/"+report[index].patient_id+"/"+report[index].admission_date_time+"'><font color='#FFFFFF'>Add Patient Outcome Details</font></a></div></td></tr>");
                      
                    });


                        /*var href = $('#patient_id').prop('href');
                        $('#patient_id').prop('href',href+'/'+report.Patient_Name+'/'+report.Patient_Mobile);*/
                        $('.patient').removeClass('hidden');
                        //$('.chck').html(report[0].Patient_ID);
                      }
                          else{
                            alert(report.Status);                           
                          $('.msg').removeClass('hidden');
                           var href = $('#p_name').prop('href');
                        $('#p_name').prop('href',href+'/'+report.Patient_Name+'/'+report.Patient_Mobile);
                          }
                           
                    },
                   error: function (data) {
                          
                    },    
                dataType: "json",
                async: false
        });

      // $('#search_admission').prop('disabled',false);
  });

  
 
  </script>