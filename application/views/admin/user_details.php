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
           <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Admin User Details</h3>
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
                  <label for="exampleInputName">Select Type <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_type" name="user_type" required="">
                      <option value="">Select Type</option>
                      <option value="01">District level user</option>
                      <option value="02">Sub-division level user</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select District <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_email" name="user_email" required="">
                    <option value="">Select District</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Sub-division <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="user_email" name="user_email" required="">
                    <option value="">Select Sub-division</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary">View</button>
              </div>
            </form>
          </div>       

        </div>

        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Institution User Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST">
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
                <button type="submit" class="btn btn-primary" id="inst_view">View</button>
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
             $('#inst_district').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });        

   $('#inst_district').change(function(e){
     
    var inst_district = $('#inst_district').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getSubdivision');?>',
        method: 'post',
        data: {
            district: inst_district
        },
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             $('#inst_subdivision').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });   

 
    ////////////////////////////////////Admin institute user/////////////////////////////////////////////
    $('#inst_view').click(function(e)   
  { 
  
        var inst_district = $('#inst_district').val();
      var inst_subdivision = $('#inst_subdivision').val();
      var inst_type = $('#inst_type').val();
        
           $('#inst_view').prop('disabled',true);
     var report;

        $.ajax({
            mimeType: 'text/html; charset=utf-8', 
  
      url:'<?php echo base_url('Admin/use_details');?>',
      type:'POST',
            
      data:{
       
        inst_district:inst_district,
    inst_subdivision:inst_subdivision,
    inst_type:inst_type
       
      
      },
            success: function(data) { console.log(data);
                $('.content-wrapper').html(data);
                //window.location.href = "llms_update_form.php";
               },
            error: function (jqXHR, textStatus, errorThrown) {
                 alert(errorThrown);
          },    
                    dataType: "html",
                    async: false
        });
    
    
      }); 

   ////////////////////////////////////Admin institute user/////////////////////////////////////////////
  </script>