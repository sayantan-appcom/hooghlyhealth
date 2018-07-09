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
        Vector Borne Disease Report Institution wise
      </h1>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <section class="content">
    <form role="form" method="POST" action="<?php echo site_url('Reports/Date_wise_report_FORM_P');?>"  onsubmit="return(validate());" target="_blank">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
          <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $this->session->flashdata('response');
                     ?>
             </h3>
      

       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title text-danger"><strong><u>Report for Admission </u></strong></h3>
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
            
                <div class="form-group">
                  <label for="exampleInputPassword1">Block / Municipality <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="block_muni" name="block_muni" required="">
                      <option value="">Select Block / Municipality</option>
                    </select>
                </div> 
            </div>
			
           
            <div class="col-md-6">
			         <div class="form-group">
                  <label for="exampleInputPassword1">Institution Type <span class="star">*</span></label>
                    <select class="form-control select2" style="width: 100%;" id="inst_type" name="inst_type" required="">
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
                  <label for="exampleInputPassword1">Institution Name <span class="star">*</span></label>
                     <select class="form-control select2" style="width: 100%;" id="inst_name" name="inst_name" required="">
                      <option value="">Select Institute Name</option>
                     
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">From Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="from_date" name="from_date" autocomplete="off" required="" maxlength="10">
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">To Date <span class="star">*</span></label>
                    <input type="text" class="form-control" placeholder="Choose Admission Date" id="to_date" name="to_date" autocomplete="off" required="" maxlength="10">
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
	////////////////////////////////////////////fetch Institution Name///////////////////////////////////////////
   $('#inst_type').change(function(e){
   

      var inst_district = $('#district_code').val();
	  var inst_subdivision= $('#subdiv_code').val();
	  var inst_block=$('#block_muni').val();
	  var inst_type=$('#inst_type').val();
	     /*alert(inst_district);
		   alert(inst_subdivision);
		   
	  alert(inst_block);
	  alert(inst_type);*/
  
      // AJAX request
      $.ajax({
        url:'<?php  echo base_url('Reports/get_institution_name');?>',
        method: 'post',
        data: {
            inst_district: inst_district,
			inst_subdivision:inst_subdivision,
			inst_block:inst_block,
			inst_type:inst_type
        },
        dataType: 'json',
        success: function(response){
		//console.log(response);
		 $('#inst_name').empty();
          $('#inst_name').append("<option value=''>Select Institution</option>");
          $.each(response,function(index,data){
             $('#inst_name').append('<option value="'+data['user_id']+'">'+data['inst_name']+'</option>');
          });
        }
     });
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