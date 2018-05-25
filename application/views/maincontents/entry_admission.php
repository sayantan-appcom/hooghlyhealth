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
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/entry_admission_next');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>      
       
     
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u> For Admission Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputPassword1">Test Date <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="test_date" name="test_date" required="">
                      <option value="">Select Test Date</option>
                      <?php
                          foreach($test_date as $row)
                            { 
                              echo '<option value="'.$row->test_date.'">'.$row->test_date.'</option>';
                            }
                      ?>
                    </select>
                </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Registration ID <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="registration_id" name="registration_id" required="">
                      <option value="">Select Registration ID</option>                      
                    </select>
                </div> 
              
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Next</button>
              </div> 
         </form>
    </section>
    <div id="admission_next"></div>
  </div>

  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script type="text/javascript">
    $('#test_date').change(function(e){
     // alert("nibu");
      var test_date = $('#test_date').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/get_registrationId');?>',
        method: 'post',
        data: {
            test_date: test_date
        },
        dataType: 'json',
        success: function(response){
          //alert("nibu");
          $('#registration_id').empty();
          $('#registration_id').append("<option value=''>Select Registration ID</option>");
          $.each(response,function(index,data){
             $('#registration_id').append('<option value="'+data['registration_id']+'">'+data['registration_id']+'</option>');
          });
        }
     });
   });  
  </script>
