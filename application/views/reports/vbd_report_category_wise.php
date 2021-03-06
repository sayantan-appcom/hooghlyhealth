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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vector Bone Disease Report Block wise 
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Reports/fetch_vbd_report_category_wise');?>"  onsubmit="return(validate());" target="_blank">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
      

       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u> Disease Category wise Report </u></strong></h3>
        </div>
       
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="exampleInputEmail1">State <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="state_code" name="state_code" required="">
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
                    <select class="form-control select2" style="width: 100%;" id="district_code" name="district_code" required="">
                      <option value="">Select District</option>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub-division <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="subdiv_code" name="subdiv_code" required="">
                      <option value="">Select Sub-division</option>
                    </select>
                </div>            
                
            </div>
			
           
            <div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputPassword1">Block / Municipality <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="block_muni" name="block_muni" required="">
                      <option value="">Select Block / Municipality</option>
                    </select>
                </div> 
			         <div class="form-group">
                  <label for="exampleInputPassword1">Disease Category<span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="category_name" name="category_name" required="">
                      <option value="">Select Disease category</option>
                      <?php
                          foreach($get_disease_category as $row)
                            { 
                              echo '<option value="'.$row->disease_category_id.'">'.$row->disease_category_name.'</option>';
                            }
                      ?>
                    </select>
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
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $('#from_date').datepicker({
      autoclose: true,
      endDate: new Date(),
      format: 'yyyy-mm-dd'
    });
  $('#to_date').datepicker({
      autoclose: true,
      endDate: new Date(),
      format: 'yyyy-mm-dd'
    });
	
   //////////////////////////////////fetch district////////////////////////////////////////////////////////
   $('#state_code').change(function(e){
      //alert("nibu");

      var state = $('#state_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Reports/getDistrict_reports');?>',
        method: 'post',
        data: {
            state: state
        },
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             $('#district_code').append('<option value="'+data['district_code']+'">'+data['district_name']+'</option>');
          });
        }
     });
   });   
///////////////////////////////////////////////////////fetch subdivision//////////////////////////////////////////////

 $('#district_code').change(function(e){
      //alert("nibu");

      var district = $('#district_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Reports/getSubdivision_reports');?>',
        method: 'post',
        data: {
            district: district
        },
        dataType: 'json',
        success: function(response){
          $.each(response,function(index,data){
             $('#subdiv_code').append('<option value="'+data['subdivision_code']+'">'+data['subdivision_name']+'</option>');
          });
        }
     });
   });   
   
 ///////////////////////////////////////////////////////fetch block/////////////////////////////////////////////////////////////
 
 $('#subdiv_code').change(function(e){
      //alert("nibu");

      var subdivision = $('#subdiv_code').val();
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Reports/getBlockMuni_reports');?>',
        method: 'post',
        data: {
            subdivision: subdivision
        },
        dataType: 'json',
        success: function(response){
          $('#block_muni').empty();
          $('#block_muni').append("<option value=''>Select Block</option>");
          $.each(response,function(index,data){
             $('#block_muni').append('<option value="'+data['blockminicd']+'">'+data['blockmuni']+'</option>');
          });
        }
     });
   });  
                      

</script> 