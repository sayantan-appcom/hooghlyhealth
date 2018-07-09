<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
 
  <div class="content-wrapper">
   
    <section class="content-header">
      <h1>
        Application Form Entry for <b><?php echo $user_name; ?> </b>
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    
    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Health_Home/insert_test_data');?>"  onsubmit="return(validate());">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();                          
                        echo $this->session->flashdata('test_suc_msg');                                       
                     ?>
             </h3>
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Test Details</u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputPassword1">Test Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Date" id="test_date" name="test_date" autocomplete="off" required="" maxlength="10">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Disease Category <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_code" name="disease_code" required="">
                      <option value="">Select Disease Category</option>
                      <?php
                          foreach($get_disease as $row)
                            { 
                              echo '<option value="'.$row->disease_category_id.'">'.$row->disease_category_name.'</option>';
                            }
                      ?>
                    </select>
                </div>   
                <div class="form-group">
                  <label for="exampleInputPassword1">Disease Sub Category <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_subcase_code" name="disease_subcase_code" required="">
                      <option value="">Select Disease Sub Category</option>
                    </select>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                  <label for="exampleInputPassword1">Test Name <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="test_id" name="test_id" required="">
                      <option value="">Select Test Name</option>
                    </select>
                </div>  
            </div>
            <div class="col-md-6">
                <div class="form-group">                  
                    <label for="exampleInputPassword1">Total Number of Sample Test <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Total number of sample test" id="total_tested" name="total_tested" autocomplete="off" required="" maxlength="4">
                </div> 
            </div>
            </div>

        </div>  

      
      <div class="box-footer" align="center">
                <button type="submit" class="btn btn-lg btn-success" id="">Submit</button>
              </div>   


         </form>

      </div>   
    </section>    
  </div>
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/user_form.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
  
   $('#test_date').datepicker({
      autoclose: true,
      startDate: '-21d',
      endDate: new Date(),
      format: 'yyyy-mm-dd'
    });
     
    $('#disease_code').change(function(e){
     // alert("nibu");
      var disease_category = $('#disease_code').val();
      var user_type = $('#user_type').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/getsubdisease');?>',
        method: 'post',
        data: {
            disease_category: disease_category,
            user_type : user_type
        },
        dataType: 'json',
        success: function(response){
          //alert("nibu");
          $('#disease_subcase_code').empty();
          $('#disease_subcase_code').append("<option value=''>Select Disease Sub Category</option>");
          $.each(response,function(index,data){
             $('#disease_subcase_code').append('<option value="'+data['disease_sub_id']+'">'+data['disease_sub_name']+'</option>');
          });
        }
     });
   });   

   $('#disease_subcase_code').change(function(e){
      //alert("nibu");

      var disease_sub_category = $('#disease_subcase_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Health_Home/gettestname');?>',
        method: 'post',
        data: {
            disease_sub_category: disease_sub_category
        },
        dataType: 'json',
        success: function(response){
          $('#test_id').empty();
          $('#test_id').append("<option value=''>Select Test Name</option>");
          $.each(response,function(index,data){
             $('#test_id').append('<option value="'+data['test_type_code']+'">'+data['test_type_name']+'</option>');
          });
        }
     });
   });    

     function validate()
      {
           var r=confirm("Do you really want to submit the form? Once Submit the information you can not change anything !")
          if (r==true)
            return true;
          else
            return false;
      }               
  
  </script>