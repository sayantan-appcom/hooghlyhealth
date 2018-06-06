<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Health Care</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<style type="text/css">
      .star { 
          color:red;
            }
  </style>
</head>
<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>

<body>
    <div class="content py-5  bg-secondary">
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
                    <span class="anchor" id="formChangePassword"></span>
                    <hr class="mb-5">

                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" role="form" action="<?php echo site_url('Login/change_password');?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                       // echo $this->session->flashdata('resp');
                        if (isset($resp ) ) {

                  echo $resp;
                  }
                     ?>
             </h3>
                                <div class="form-group">
                                    <label for="inputPasswordOld"><strong>Current Password</strong></label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew"><strong>New Password</strong></label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" minlength="8" maxlength="20">
                                    <span class="form-text small text-muted">
                                            The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify"><strong>Verify Password</strong></label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
                                    <span class="form-text small text-muted">
                                            To confirm, type the new password again.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-outline-secondary">
                    </div>
                    <!-- /form card change password -->
                    <hr class="mb-5">
                </div>
    </div>
</div>
</div>
</body>
</html>
