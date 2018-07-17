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
        Institutional User Update Form        
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid" id="user_edit">
        <!-- left column -->
        <form role="form" method="POST">
          <h3 class="star">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
                  <!-- general form elements -->
          <div class="box box-primary"> 
            <div class="box-body"> 
              <div class="col-md-6">
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
				      </div>

              <div class="col-md-6">                
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
             <div class="form-group">
                  <label for="exampleInputEmail1">Institution Name <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_name" name="inst_name" required="">
                      <option value="">Select institution</option>
                    </select>
                </div>
              </div>

             </div>
             </div>
         

      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="inst_edit">Go</button>
        </div>              
     
  </form>
   
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
                    
////////////////////////////////////////////fetch Institution Name///////////////////////////////////////////
   $('#inst_type').change(function(e){
   

      var inst_district = $('#inst_district').val();
	  var inst_subdivision= $('#inst_subdivision').val();
	  var inst_block=$('#inst_block').val();
	  var inst_type=$('#inst_type').val();
	     /*alert(inst_district);
		   alert(inst_subdivision);
		   
	  alert(inst_block);*/
	 // alert(inst_type);
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/get_institution_name');?>',
        method: 'post',
        data: {
            inst_district: inst_district,
			inst_subdivision:inst_subdivision,
			inst_block:inst_block,
			inst_type:inst_type
        },
        dataType: 'json',
        success: function(response){
		//console.log(response);
		 $('#inst_name').empty();
          $('#inst_name').append("<option value=''>Select Institution</option>");
          $.each(response,function(index,data){
             $('#inst_name').append('<option value="'+data['user_id']+'">'+data['inst_name']+'</option>');
          });
        }
     });
   });  
   ////////////////////////////////////Admin institute user/////////////////////////////////////////////
    $('#inst_edit').click(function(e)   { 
  
    //  alert("sayantan");
	var inst_name=$('#inst_name').val();
	//var user_type=$('#user_type').val();
	//alert(inst_name);
        
           $('#inst_edit').prop('disabled',true);
     var report;

        $.ajax({
            mimeType: 'text/html; charset=utf-8', 
  
      url:'<?php echo base_url('Admin/institution_details_edit');?>',
      type:'POST',
            
      data:{
       
        inst_name:inst_name
       
      
      },
            success: function(data) { console.log(data);
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

   ////////////////////////////////////Admin institute user/////////////////////////////////////////////
  </script>