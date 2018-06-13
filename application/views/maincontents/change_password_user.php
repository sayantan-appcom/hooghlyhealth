 <?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title  text-danger"><strong>Change Password Here<br><sub>(Read password change mandatory before change password)</sub></strong></h3>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form" method="POST" role="form" action="<?php echo site_url('Health_Home/password_change');?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('change_success');
                     ?>
             </h3>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Password</label>
                  <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="inputPasswordNewVerify"><strong>Verify Password</strong></label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter New Password">
                                    <span class="form-text small text-muted">
                                            To confirm, type the new password again.
                                        </span>
                </div>                        
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
      </form>
  </div>
</div>

        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title  text-danger"><strong>Password Change Mandatory</strong></h3>
            </div>

              <div class="box-body">
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password field must be at least one lowercase letter.</strong></label>                 
                </div>
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password field must be at least one uppercase letter.</strong></label>
                </div>
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password field must have at least one number.</strong></label>
                </div>
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password field must have at least one special character (Accept only '@' , '#' , '$').</strong></label>
                </div>
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password field must be at least 5 characters in length.</strong></label>
                </div>
                <div class="form-group">
                  <label for="" class="text-warning"><strong>*** New Password  field cannot exceed 30 characters in length.</strong></label>
                </div>
              </div>     
          </div>
        </div>

</div>
</section>
</div>


         