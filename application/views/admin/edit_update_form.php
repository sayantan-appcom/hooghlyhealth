 <?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>

 
        <!-- left column -->
        <form role="form" method="POST" action="<?php echo site_url('Admin/admin_user_update');?>">
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
        
          	<?php
			foreach($edit_admin_user as $x)
				{
				?>
      
           <input type="hidden" id="user_id" name="user_id" value="<?php echo $x['user_id'];?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Name" id="user_name" name="user_name" onKeyPress="return onlyLetters(event)" value="<?php echo $x['user_name'];?>">
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">User Designation <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Designation" id="user_desg" name="user_desg" onKeyPress="return onlyLetters(event)" value="<?php echo $x['user_desg'];?>">
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
                  <label for="exampleInputPassword1">User Email Id <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Email Id" id="user_email" name="user_email" value="<?php echo $x['user_email'];?>">
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">User Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter User Mobile Number" id="user_mobile" name="user_mobile" onKeyPress="return onlyNumbers(event)" value="<?php echo $x['user_mobile'];?>">
                </div>
                          
              </div>
             </div>
            </div>    
        <?php
		}
		?>
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="user_admin_update">Update</button>
              </div>   


         </form>

     
 
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
      $('form').submit(function(){

                    alert('ok');      
        $.ajax({
           url:this.action,
           type:this.method,
           data:$(this).serialize(),
           success:function(data){
            var obj = $.parseJSON(data)
             if(obj['applicant_name']!=null)
                 {                               
                                $('#message').text("");
                                $('#message').append(obj['user_name']);
								 $('#message').append(obj['user_desg']);
								$('#message').append(obj['user_email']);
							    $('#message').append(obj['user_mobile']);
								
                      }
             else
                   {                               
                               // $('#message').text("");
                               // alert(obj); 
                                 //window.location.href = "<?php echo site_url('Admin/admin_user_edit'); ?>";
                    }

                    },
                     erro:function(){
                      alert("Please Try Again");
                        }                        
                    });
                    return false;
                });              
  
  
  
   /////for form submit using jquery//
});
                  
  
  </script>