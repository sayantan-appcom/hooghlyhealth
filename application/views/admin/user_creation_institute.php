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
                    <select class="form-control select2" style="width: 100%;" id="inst_state" name="inst_state" >
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
                    <select class="form-control select2" style="width: 100%;" id="inst_district" name="inst_district" >
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_subdivision" name="inst_subdivision" >
                      <option value="">Select Sub-division</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Block / Municipality <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_block" name="inst_block" >
                      <option value="">Select Block / Municipality</option>
                    </select>
                </div>   
                 <div class="form-group">
                  <label for="exampleInputPassword1">Institution Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_type" name="inst_type" >
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
                  <label for="exampleInputPassword1">Laboratory Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="labo_type" name="labo_type" >
                      <option value="">Select Laboratory Type </option>
                      <option value="01"> Pathology </option>
                      <option value="02"> Radiology </option>
					  <option value="03"> Both </option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Pathology Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="patho_type" name="patho_type" >
                      <option value="">Select Pathology Type </option>
                      <option value="01"> Large </option>
                      <option value="02"> Medium </option>
                      <option value="03"> Small </option>
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
                <div class="form-group" id="">
                  <label for="exampleInputPassword1">Radiology Type <span class="star">*</span></label><br/>
                
       
			   	<?php
	foreach($fetch_radiology_type as $row)
	{
	
	?>
	<input type="checkbox" name="radio_type[]" disabled="disabled"  class="chk1" value="<?php echo $row['process_id'];?>"><?php echo $row['process_name'];?><br/>
	<?php
	}
	?>
	
	<input type="checkbox" name="radio_type1[]" disabled="disabled" id="checkall"/>CheckAll
	
       </div> 
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Name" id="inst_name" name="inst_name" onKeyPress="return onlyLetters(event)" autocomplete="off"  maxlength="50" value="<?php echo set_value('inst_name'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution License Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution License Number" id="inst_license_no" name="inst_license_no" onKeyPress="return onlyLicense(event)" autocomplete="off"  maxlength="30" value="<?php echo set_value('inst_license_no'); ?>">
                </div>                
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Address <span class="star">*</span></label>
                    <textarea class="form-control" id="inst_addr" name="inst_addr" autocomplete="off" rows="3" placeholder="Enter Institution Address"  maxlength="100" value="<?php echo set_value('inst_addr'); ?>"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Email Id <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Email Id" id="inst_email" name="inst_email" autocomplete="off" maxlength="50" value="<?php echo set_value('inst_email'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_mobile" name="inst_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="10" value="<?php echo set_value('inst_mobile'); ?>">
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
                    <input type="text" class="form-control" placeholder="Enter Institution Phone Number" id="inst_phone" name="inst_phone" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="12" value="<?php echo set_value('inst_phone'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Owner Name" id="inst_owner_name" name="inst_owner_name" onKeyPress="return onlyLetters(event)" autocomplete="off"  maxlength="50" value="<?php echo set_value('inst_owner_name'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_mobile" name="inst_owner_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off"  maxlength="10" value="<?php echo set_value('inst_owner_mobile'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Email Id </label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_email" name="inst_owner_email" autocomplete="off" maxlength="50" value="<?php echo set_value('inst_owner_email'); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Password" id="inst_password" name="inst_password" autocomplete="off" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password <span class="star">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Re-Password" id="inst_confirm_password" name="inst_confirm_password" autocomplete="off" >
                </div>               
              </div>
             </div>
            </div>    
        
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="submit"  >Submit</button>
              </div>   


         </form>

      </div>   
    </section>    
  </div>
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript">
$(document).ready(function (){
    $('#inst_type').change(function () {
      //alert("nibu");
             if ($(this).val() == "07") {                
                  $("#inst_license_no").prop("disabled", false);
                  $("#inst_owner_name").prop("disabled", false);
                  $("#inst_owner_mobile").prop("disabled", false);
                  $("#inst_owner_email").prop("disabled", false);
				  $("#labo_type").prop("disabled",true);
				  $("#chk1").prop("disabled", true);
                  $("#patho_type").prop("disabled", true);
               
                }
              
           else if ($(this).val() == "08") {
                  $("#inst_license_no").prop("disabled", false);
                  $("#inst_owner_name").prop("disabled", false);
                  $("#inst_owner_mobile").prop("disabled", false);
                  $("#inst_owner_email").prop("disabled", false);
                  $("#labo_type").prop("disabled", false);
                  $("#patho_type").prop("disabled", false);
                  $("#chk1").prop("disabled", false);              
                }
			   
			   
/////////////////////////////////for govt Hospital///////////////////////////////////////////			                
            else {
                  $("#inst_license_no").prop("disabled", true);
                  $("#inst_owner_name").prop("disabled", true);
                  $("#inst_owner_mobile").prop("disabled", true);
                  $("#inst_owner_email").prop("disabled", true);
                  $("#labo_type").prop("disabled", true);
                  $("#patho_type").prop("disabled", true);
                  $("#chk1").prop("disabled", true); 
            }
        });
/////////////////////////////for pathlogy and radio logy/////////////////////////////////////////////////////////////////////
 $('#labo_type').change(function () {
     // alert("sayantan");
            if ($(this).val() == "01") {                
                  //$("#chk1").prop("disabled", true);
				   $(".chk1").prop("disabled", true);
                  $("#patho_type").prop("disabled", false);
				  $("#checkall").prop("disabled", true);
               
                }
              
            else if ($(this).val() == "02") {
                  $("#patho_type").prop("disabled", true);
                  /*$("#radio_type").prop("disabled", false);
				   $("#radio_type2").prop("disabled", false);*/
				    $(':checkbox').each(function () {
                    $(this).prop('disabled', false);
                   
                });
                              
                }
			  else if ($(this).val() == "03") {
                  
                  $("#patho_type").prop("disabled", false);
				  
				    $(':checkbox').each(function () {
                    $(this).prop('disabled', false);
                   
                });
                              
                }
				else
				{
				    $(':checkbox').each(function () {
                    $(this).prop('disabled', true);
                    //$(this).prop('checked', false);
    
                });
				}
		                
        
		
        });
		//////////////////////check all checkbox////////////////////////
		$("#checkall").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

/////////////////////////////for pathlogy and radio logy/////////////////////////////////////////////////////////////////////

   
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
   
  

  $('#submit').on('click',function(e){
  
       //e.preventDefault();
	  

    valid = false;
    var mobile=$('#inst_mobile').val();
    var user_email=$('#inst_email').val();
    var type_labo=$('#labo_type').val();
	var patho_type=$('#patho_type').val();
	var mobile_no=$('#inst_mobile').val();
    var password=$('#inst_password').val();
	var cpassword=$('#inst_password').val();
   if($('#inst_state').val()=="")
    {
      alert('please select state');
      return false;
   }
    else if($('#inst_district').val()=="")
    {
      alert('please select district');
      return false;
   }
  else if($('#inst_subdivision').val()=="")
    {
      alert('please select subdivision');
      return false;
   }
   else if($('#inst_block').val()=="")
    {
      alert('please select block');
      return false;
   }
   else if($('#inst_block').val()=="")
    {
      alert('please select block');
      return false;
   }
   
   else if($('#inst_block').val()=="")
    {
      alert('please select block');
      return false;
   }
   
   else if($('#inst_type').val()=="")
    {
      alert('please select institution type');
      return false;
    }
	 else if($('#labo_type').val()=="")
    {
      alert('please select labaratory type');
      return false;
    }
	
  else if(type_labo==01  && patho_type =="")
    {
      alert('please select pathology type');
      return false;
    }
	 else if($('#inst_name').val()=="")
    {
      alert('please select institution name');
      return false;
    }
 
	   else if($('#inst_license_no').val()=="")
    {
      alert('please select institute license no');
      return false;
    }
     else if($('#inst_addr').val()=="")
   {
      alert('please enter institute address');
      return false;
    
   } 
	
    else if($('#inst_email').val()=="")
   {
      alert('please enter institute email id');
      return false;
    
   }
   	else if (!IsValidEmail(user_email))
    {
     alert("please enter valid institute email");
	 return false;
    }
	else if($('#inst_mobile').val()=="")
   {
      alert('please enter institute mobile no');
      return false;
    } 
	else if($('#inst_owner_name').val()=="")
   {
      alert('please enter institute owner name');
      return false;
    } 
	
	else if($('#inst_owner_mobile').val()=="")
   {
      alert('please enter institute owner mobile no');
      return false;
    }
	else if(mobile_no.length!=10)
   {
      alert('please enter valid institute mobile no');
      return false;
    }

 	/*else if($('#inst_email').val()=="")
   {
      alert('please enter institute email id');
      return false;
    }*/
	 else  if(type_labo == 02)
      {

      if ($("input[type=checkbox]:checked").length === 0) {
          e.preventDefault();
          alert('Select atlest one Radiology Type');
          return false;
      }
	
    }
	

	else
	{
	return true;
	}

  
  });
  });//document ready
  
  
    /*function validate(e) {
      var type_labo=$('#labo_type').val();
      if(type_labo == 02)
      {

      if ($("input[type=checkbox]:checked").length === 0) {
          e.preventDefault();
          alert('Select atlest one Radiology Type');
          return false;
      }
	
    }
}*/
    function IsValidEmail(email) 
	{ //alert('sss');
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }

                     
  
  </script>