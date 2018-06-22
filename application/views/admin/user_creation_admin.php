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
      <h1>
        Admin User Creation Form
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <form role="form" method="POST" action="<?php echo site_url('Admin/admin_user_insert');?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">State <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="user_state" name="user_state" required="">
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
                    <select class="form-control select2" style="width: 100%;" id="user_district" name="user_district" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">User Type <span class="star">*</span></label>
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
                  <label for="exampleInputEmail1">Sub-division</label>
                    <select class="form-control select2" style="width: 100%;" id="user_subdivision" name="user_subdivision" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Block</label>
                    <select class="form-control select2" style="width: 100%;" id="user_block" name="user_block" required="">
                      <option value="">Select Block</option>
                    </select>
                </div>                
                          
              </div>
             </div>
            </div> 
              <!-- /.box-body -->
      
         <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Name" id="user_name" name="user_name" onKeyPress="return onlyLetters(event)" autocomplete="off">
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">User Designation <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Designation" id="user_desg" name="user_desg" onKeyPress="return onlyLetters(event)" autocomplete="off">
                </div>  
                <div class="form-group">
                  <label for="exampleInputPassword1">User Email Id <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Email Id" id="user_email" name="user_email" autocomplete="off">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">User Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Mobile Number" id="user_mobile" name="user_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="10">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Password" id="user_password" name="user_password" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Re-Password" id="user_confirm_password" name="user_confirm_password" autocomplete="off">
                </div>               
              </div>
             </div>
            </div>    
        
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success">Submit</button>
              </div>   


         </form>

      </div>   
    </section>    
  </div>
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript">
   
    $('#user_state').change(function(e){
      //alert("nibu");

      var state = $('#user_state').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getDistrict');?>',
        method: 'post',
        data: {
            state: state
        },
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             $('#user_district').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });        

   $('#user_district').change(function(e){
      //alert("nibu");

      var district = $('#user_district').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getSubdivision');?>',
        method: 'post',
        data: {
            district: district
        },
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             $('#user_subdivision').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });   

   $('#user_subdivision').change(function(e){
      //alert("nibu");

      var subdivision = $('#user_subdivision').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getBlockMuni');?>',
        method: 'post',
        data: {
            subdivision: subdivision
        },
        dataType: 'json',
        success: function(response){
          $('#user_block').empty();
          $('#user_block').append("<option value=''>Select Block</option>");
          $.each(response,function(index,data){
             $('#user_block').append('<option value="'+data['blockminicd']+'">'+data['blockmuni']+'</option>');
          });
        }
     });
   }); 

   $('#user_type').change(function () {
            if ($(this).val() == "06") {                
                  $("#user_subdivision").prop("disabled", false);
                  $("#user_block").prop("disabled", true);
                }  
                            
            else {
                  $("#user_subdivision").prop("disabled", true);
                  $("#user_block").prop("disabled", true);
            }
        });                  
  
  </script>