<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
} else {
header("location: index");
}
?>
<div class="container">
  
<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <!-- form start -->
            
              <div class="box-body">
			  <form role="form" method="POST" action="<?php echo site_url('Health_Home/test_data_update');?>">
     <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                       echo $this->session->flashdata('message');
                     ?>
             </h3>
			  <?php
	
			  foreach($edit_test_details as $x)
			  {
			  ?>
          
                <div class="form-group">
				        <input type="hidden" class="form-control" name="user_id" value="<?php echo $x['institution_code'];?>">
                  <label for="exampleInputPassword1">Institution Test date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Institution License Number" id="inst_license_no" name="inst_license_no" onKeyPress="return onlyLicense(event)" autocomplete="off" readonly  maxlength="30" value="<?php echo $x['test_date'];?>">
                </div>                
                <div class="form-group">
                  <label for="exampleInputPassword1">Institution Address <span class="star">*</span></label>
                     <input type="text" class="form-control" placeholder="Enter Total Test Detail" id="total_tested" name="total_tested" onKeyPress="return onlyLicense(event)" autocomplete="off"  maxlength="30" value="<?php echo $x['total_tested'];?>">
                </div> 
        <?php
		}
		?>

         
           
				 <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="inst_edit">Update</button>             
          </div>
		  </form>
		  </div>
		  </div>
		  </div>
		  </div> 