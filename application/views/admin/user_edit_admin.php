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
        Admin User Update Form
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
	 
      <div class="col-md-8 col-md-offset-2" id="user_edit">
        <!-- left column -->
        <form role="form"  >
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('message');
                     ?>
             </h3>
        <div class="col-md-8">
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
                
                         
              </div>
             
        
      <div class="box-footer" align="center"  >
                <button type="submit" class="btn btn-lg btn-success" id="admin_edit_submit">Go</button>
              </div>   


         </form>
         </div>
      </div>   
    </section>    
  </div>
  <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
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
	   //////////////////////////////////////////////// Admin Edit Form/////////////////////////////////////////////////////////////
	  	 $('#admin_edit_submit').click(function(e)   { 
  
    //  alert("sayantan");
	var user_state=$('#user_state').val();
	var user_type=$('#user_type').val();
        
           $('#admin_edit_submit').prop('disabled',true);
     var report;

        $.ajax({
            mimeType: 'text/html; charset=utf-8', 
  
      url:'<?php echo base_url('Admin/admin_user_edit');?>',
      type:'POST',
            
      data:{
       
        
        user_state:$('#user_state').val(),
        user_district:$('#user_district').val(),
		user_type:$('#user_type').val()
      
      },
            success: function(data) { //alert(data);
                $('#user_edit').html(data);
                //window.location.href = "llms_update_form.php";
               },
            error: function (jqXHR, textStatus, errorThrown) {
                 alert(errorThrown);
          },    
                    dataType: "html",
                    async: false
        });
    
    
      }); 

/////////////////////////////////////////////// Admin Edit Form////////////////////////////////////////////////// 

              
  
  </script>