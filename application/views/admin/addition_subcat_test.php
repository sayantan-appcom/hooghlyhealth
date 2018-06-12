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
        Addition Form
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
		  
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Sub-category</h3>
            </div>
         
            <form role="form" method="POST" action="<?php echo site_url('Admin/add_subcategory');?>">
              <h4 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h4>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Select Institution Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="institution_flag" name="institution_flag" required="">
                      <option value="">Select Institution Type</option>
                      <?php
                          foreach($get_institute as $row)
                            { 
                              echo '<option value="'.$row->sub_disease_flag.'">'.$row->inst_type_name.'</option>';
                            }
                      ?>
                    </select>
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
                    <input type="text" class="form-control" placeholder="Enter Disease Sub Category" id="disease_subcase_code" name="disease_subcase_code" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)">
                </div>               
              </div>           

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
		
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Test Name</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo site_url('Admin/add_test_name');?>">
              <h4 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('message');
                     ?>
             </h4>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Disease Category <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="disease_id" name="disease_id" required="">
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
                    <select class="form-control select2" style="width: 100%;" id="disease_subcat_id" name="disease_subcat_id" required="">
                      <option value="">Select Disease Sub Category</option>
                    </select>
                </div>     
                <div class="form-group">
                  <label for="exampleInputPassword1">Test Name <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter sub disease Test name" id="test_name" name="test_name" autocomplete="off" required="" maxlength="30" onKeyPress="return onlyLetters(event)">
                </div> 
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>        
       </div> 
    </section>    
  </div>


  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript">
    $('#disease_id').change(function(e){
     // alert("nibu");
      var disease_category = $('#disease_id').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Admin/getsubdisease');?>',
        method: 'post',
        data: {
            disease_category: disease_category
        },
        dataType: 'json',
        success: function(response){
          //alert("nibu");
          $('#disease_subcat_id').empty();
          $('#disease_subcat_id').append("<option value=''>Select Disease Sub Category</option>");
          $.each(response,function(index,data){
             $('#disease_subcat_id').append('<option value="'+data['disease_sub_id']+'">'+data['disease_sub_name']+'</option>');
          });
        }
     });
   });
  </script>