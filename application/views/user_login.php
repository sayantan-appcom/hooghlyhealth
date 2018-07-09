<section>
   <div class="wrapper">
          <form class="form-signin" method="POST" action="<?php echo site_url('Login/user_login_process');?>"> 
            <div class="error"><?php echo validation_errors();  
                                 echo $this->session->flashdata('login_msg'); 
                           ?>
        </div>
        <div class="form-group">
            <label>User Email Id</label>
              <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Enter user email address" required="" autocomplete="off" autofocus="" />
        </div>
        <div class="form-group">      
            <label> User Password</label>
              <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter user password" autocomplete="off" required="" />
        </div>
        <div class="form-group">       
              <label>Captcha</label><br>
                <div class="image col-md-5"><?php echo $captcha; ?> </div>
                <div class="col-md-5">
                 <a href="javascript:;" class="captcha-refresh"> <img src="<?php echo base_url();?>assets/img/refresh.png"></a>
                </div>
                </div>                
        <div class="form-group">
                <input type="text" name="user_captcha" id="user_captcha" onKeyPress="return onlyNumbers(event)" required="" class="form-control" placeholder="Enter Captcha" maxlength="6">  
        </div> 
                <br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
          </form>
      </div>
 </section>     
     
