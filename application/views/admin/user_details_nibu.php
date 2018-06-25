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
      <h1>
        View User Details
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <form role="form" method="POST">
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
                    <select class="form-control select2" style="width: 100%;" id="inst_district" name="inst_district" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                     
              </div>
             </div>
            </div> 

            <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            
              <div class="box-body">                
  
               <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_subdivision" name="inst_subdivision" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Instituion Type <span class="star">*</span></label>
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
   
        
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="inst_edit">Submit</button>
              </div>   


         </form>

      </div>  
      <div class="show_details"> </div> 
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
    $('#inst_edit').click(function(e)   
	{ 
  
        var inst_district = $('#inst_district').val();
	    var inst_subdivision = $('#inst_subdivision').val();
	    var inst_type = $('#inst_type').val();
        
           //$('#inst_edit').prop('disabled',true);
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
                $('.show_details').html(data);
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