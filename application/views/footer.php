

  <footer>
    <div class="container">
      <div class="row"> 
        <div class="col-md-12">
          <img src="<?php echo base_url();?>assets/img/body.png">
          <div class="col-md-12 text-center">
           <strong> © Copyright 2018 All Rights Reserved.</strong>
          </div>
        </div>
      </div>
    </div>
  </footer>

  

  
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
 
           $('.captcha-refresh').on('click', function(){
              //alert("nnn");
 
               $.ajax({
                url:'<?php  echo base_url('Login/refresh_captcha');?>',
                type: 'post',

        success: function(res){
          //alert("nibu");
          if(res){
            $('.image').html(res);
          }
        }
     }); 
  });
});

    $('.disableRightClick').on("contextmenu",function(e){
        //alert('You can not Use Right Click');
        return false;
    });             
  </script>
</body>

</html>