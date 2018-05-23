
 <?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>
  <form role="form" method="POST" action="<?php echo site_url('Admin/institution_user_update');?>">
     <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('message');
                     ?>
             </h3>
<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <!-- form start -->
            
              <div class="box-body">
			  <?php
			  foreach($edit_institute_details as $x)
			  {
			  ?>
          
                <div class="form-group">
				        <input type="hidden" class="form-control" name="user_id" value="<?php echo $x['user_id'];?>">
                  <label for="exampleInputPassword1">Institution License Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution License Number" id="inst_license_no" name="inst_license_no" onKeyPress="return onlyLicense(event)" autocomplete="off"  maxlength="30" value="<?php echo $x['inst_license_no'];?>">
                </div>                
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Address <span class="star">*</span></label>
                    <textarea class="form-control" id="inst_addr" name="inst_addr" autocomplete="off" rows="3" placeholder="Enter Institution Address" required="" maxlength="100"><?php echo $x['inst_addr'];?> </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Email Id <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Email Id" id="inst_email" name="inst_email" autocomplete="off"  maxlength="50" required=""  value="<?php echo $x['inst_email'];?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_mobile" name="inst_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="10" required=""  value="<?php echo $x['inst_mobile'];?>">
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
                  <label for="exampleInputPassword1">Institution Phone Number </label>
                    <input type="text" class="form-control" placeholder="Enter Institution Phone Number" id="inst_phone" name="inst_phone" onKeyPress="return onlyNumbers(event)" autocomplete="off" maxlength="12"  value="<?php echo $x['inst_phone'];?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Owner Name" id="inst_owner_name" name="inst_owner_name" onKeyPress="return onlyLetters(event)" autocomplete="off" maxlength="50" required=""  value="<?php echo $x['inst_owner_name'];?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Mobile Number <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_mobile" name="inst_owner_mobile" onKeyPress="return onlyNumbers(event)" autocomplete="off" required=""  maxlength="10"  value="<?php echo $x['inst_owner_mobile'];?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Institution Owner Email Id </label>
                    <input type="text" class="form-control" placeholder="Enter Institution Mobile Number" id="inst_owner_email" name="inst_owner_email" autocomplete="off" maxlength="50"  value="<?php echo $x['inst_owner_email'];?>">
                </div>
            
               	<?php
			}
			?>
      </div>
      </div>
           
				 <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="inst_edit">Update</button>             
          </div>     
           </div>  
       
			  </form>
		