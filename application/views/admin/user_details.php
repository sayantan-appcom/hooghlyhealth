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
     <div class="container-fluid">
     
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <!--  <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Admin User Details</h3>
            </div>
            
            <form role="form" method="POST" >
               <h3 class="star" align="center">
                    <?php 
                       // echo validation_errors();
                       // echo $this->session->flashdata('reset_user_success');                  
                     ?>
             </h3>
              <div class="box-body">
                 <div class="form-group">
                  <label for="exampleInputEmail1">State <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="user_state" name="user_state" required="">
                      <option value="">Select State</option>
                      <?php
                         // foreach($get_state as $row)
                            { 
                             // echo '<option value="'.$row->state_code.'">'.$row->state_name.'</option>';
                            }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Select Type <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_type" name="user_type" required="">
                      <option value="">Select Type</option>
                      <option value="01">District level user</option>
                      <option value="02">Sub-division level user</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select District <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="district" name="district" required="">
                    <option value="">Select District</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Sub-division <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="subdivision" name="subdivision" required="">
                    <option value="">Select Sub-division</option>
                  </select>
                </div>
              </div>
              

              <div class="box-footer">
                <button class="btn btn-primary">View</button>
              </div>
            </form>
          </div>       

        </div>-->

        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Institution User Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" target="_blank" action="<?php  echo base_url('Admin/use_details');?>">
               <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('reset_institution_success');                  
                     ?>
             </h3>
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
                    <select class="form-control select2" style="width: 100%;" id="district" name="district" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
  
               <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="subdivision" name="subdivision" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Instituion Name <span class="star">*</span></label>
                       <select class="form-control select2" style="width: 100%;" id="inst_type" name="inst_type" required="">
                      <option value="">Select State</option>
                      <?php
                          foreach($get_institute as $row)
                            { 
                              echo '<option value="'.$row->inst_type_id.'">'.$row->inst_type_name.'</option>';
                            }
                      ?>
                    </select>
                </div>  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">View</button>
              </div>
            </form>
          </div>
        </div>

      </div>

    </section>    
  </div>
  
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript">
   
    $('#user_state').change(function(e){
      var state = $('#user_state').val();
      alert(state);
  
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
             $('#district').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });        

   $('#district').change(function(e){
     
    var district = $('#district').val();
    alert("nibu");
    alert(district);
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
             $('#subdivision').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });

   $('#user_type').change(function () {
    
            if ($(this).val() == "01") {                
                  $("#subdivision").prop("disabled", true);
                }
           else{
                 $("#subdivision").prop("disabled", false);
            }     
  });


 
    

   ////////////////////////////////////Admin institute user/////////////////////////////////////////////
  </script>