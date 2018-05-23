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
        Institutional User Creation Form        
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <form role="form" method="POST" action="<?php echo site_url('Admin/inst_user_insert');?>">
          <h3 class="star">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('msg');
                     ?>
             </h3>
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">           <!-- form start -->
             
               <div class="box-body"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">State <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_state" name="inst_state" required="">
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
                    <select class="form-control select2" style="width: 100%;" id="inst_district" name="inst_district" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_subdivision" name="inst_subdivision" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Block / Municipality <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_block" name="inst_block" required="">
                      <option value="">Select Block / Municipality</option>
                    </select>
                </div>   
                 <div class="form-group">
                  <label for="exampleInputPassword1">Institution Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_type" name="inst_type" required="">
                      <option value="">Select Institution Type</option>
                      <?php
                          foreach($get_institute as $row)
                            { 
                              echo '<option value="'.$row->inst_type_id.'">'.$row->inst_type_name.'</option>';
                            }
                      ?>
                    </select>
                </div>               
              </div>
             </div>
             </div> 
              <!-- /.box-body -->
      <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-info">
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Name" id="inst_name" name="inst_name" onKeyPress="return onlyLetters(event)" autocomplete="off" required="" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution License Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution License Number" id="inst_license_no" name="inst_license_no" onKeyPress="return onlyLicense(event)" autocomplete="off" required="" maxlength="30">
                </div>                
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Address <span class="star">*</span></label>
                    <textarea class="form-control" id="inst_addr" name="inst_addr" autocomplete="off" rows="3" placeholder="Enter Institution Address" required="" maxlength="100"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Email Id <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Email Id" id="inst_email" name="inst_email" autocomplete="off" required="" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_mobile" name="inst_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" required="" maxlength="10">
                </div>                
              </div>
              </div>
            </div>    
        

         <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            
              <div class="box-body"> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Phone Number </label>
                    <input type="text" class="form-control" placeholder="Enter Institution Phone Number" id="inst_phone" name="inst_phone" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="12">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Owner Name" id="inst_owner_name" name="inst_owner_name" onKeyPress="return onlyLetters(event)" autocomplete="off" required="" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_mobile" name="inst_owner_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" required="" maxlength="10">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Email Id </label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_email" name="inst_owner_email" autocomplete="off" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Password" id="inst_password" name="inst_password" autocomplete="off" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Re-Password" id="inst_confirm_password" name="inst_confirm_password" autocomplete="off" required="">
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
   
    $('#inst_state').change(function(e){
      //alert("nibu");

      var state = $('#inst_state').val();
  
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
             $('#inst_district').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });        

   $('#inst_district').change(function(e){
      //alert("nibu");

      var district = $('#inst_district').val();
  
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
             $('#inst_subdivision').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });   

   $('#inst_subdivision').change(function(e){
      //alert("nibu");

      var subdivision = $('#inst_subdivision').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getBlockMuni');?>',
        method: 'post',
        data: {
            subdivision: subdivision
        },
        dataType: 'json',
        success: function(response){
          $('#inst_block').empty();
          $('#inst_block').append("<option value=''>Select Block</option>");
          $.each(response,function(index,data){
             $('#inst_block').append('<option value="'+data['blockminicd']+'">'+data['blockmuni']+'</option>');
          });
        }
     });
   });                   
  
  </script>