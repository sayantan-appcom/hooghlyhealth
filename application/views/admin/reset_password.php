 <?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="container-fluid" id="user_details">
      <h2>
        Password Reset Form
      </h2>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
           <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Admin User Password Reset</h3>
            </div>
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo base_url('Admin/getResetUser');?>" onsubmit="return(validate());">
               <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('reset_user_success');                  
                     ?>
             </h3>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">Select User Type <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_type" name="user_type" required="">
                      <option value="">Select User Type</option>
                      <?php
                          foreach($get_user as $row)
                            { 
                              echo '<option value="'.$row->user_type_cd.'">'.$row->user_type_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Email ID <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_email" name="user_email" required="">
                    <option value="">Select Email ID</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary">Reset Password</button>
              </div>
            </form>
          </div>       

        </div>

        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Institution User Password Reset</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo base_url('Admin/getInstitutionUser');?>" onsubmit="return(validate());">
               <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('reset_institution_success');                  
                     ?>
             </h3>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInput">Select Institution Type <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="institution_type" name="institution_type" required="">
                      <option value="">Select User Type</option>
                      <?php
                          foreach($get_institute as $row)
                            { 
                              echo '<option value="'.$row->inst_type_id.'">'.$row->inst_type_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInput">Select Block <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="institution_block" name="institution_block" required="">
                      <option value="">Select Block</option>
                      <?php
                          foreach($get_block_muni as $row)
                            { 
                              echo '<option value="'.$row->blockminicd.'">'.$row->blockmuni.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Email ID <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="institution_email" name="institution_email" required="">
                    <option value="">Select Email ID</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Reset Password</button>
              </div>
            </form>
          </div>
        </div>

      </div>

    </section>    
  </div>
  
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript">
   
    $('#user_type').change(function(e){
      //alert("nibu");

      var user_type = $('#user_type').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getEmailUser');?>',
        method: 'post',
        data: {
            user_type: user_type
        },
        dataType: 'json',
        success: function(response){
          $('#user_email').empty();
          $('#user_email').append('<option value="">Select Email ID</option>');
          $.each(response,function(index,data){
             $('#user_email').append('<option value="'+data['user_email']+'">'+data['user_email']+'</option>');
          });
        }
     });
   });

   $('#institution_block').change(function(e){
      //alert("nibu");

      var institution_block = $('#institution_block').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getEmailInstitution');?>',
        method: 'post',
        data: {
            institution_block: institution_block
        },
        dataType: 'json',
        success: function(response){
          $('#institution_email').empty();
          $('#institution_email').append('<option value="">Select Email ID</option>');
          $.each(response,function(index,data){
             $('#institution_email').append('<option value="'+data['inst_email']+'">'+data['inst_email']+'</option>');
          });
        }
     });
   }); 
   
   function validate()
      {
        var r=confirm("Do you really Reset Password for this Email ID !")
          if (r==true)
            return true;
          else
            return false;
      }


  </script>