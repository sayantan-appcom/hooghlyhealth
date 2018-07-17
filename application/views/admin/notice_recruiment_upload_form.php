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
     <div class="container-fluid">
      <h2>
        <u>Notice / Recruiment upload form </u>
      </h2>
      <h5 align="right" class="star">(*) fields are mandatory</h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
           <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Select Your File (Maximum 20 MB. Only PDF format is allowed)</h3>
            </div>
            <!-- form start -->
            <?php echo form_open_multipart('Admin/upload_document/');?>
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
               <h3 class="star" align="center">
                    <?php 
                        echo validation_errors();
                        echo $error;
                        echo $this->session->flashdata('upload_success');                  
                     ?>
             </h3>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName"> Notification Type <span class="star">*</span></label>
                  <select class="form-control select2" style="width: 100%;" id="document_type" name="document_type" required="">
                      <option value="">Select User Type</option>
                      <?php
             foreach($upload_type as $row)
             { 
              echo '<option value="'.$row['upload_type_id'].'">'.$row['upload_type_name'].'</option>';
        
             }
           ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"> Upload Date <span class="star">*</span></label>
                  <input type="text" class="form-control" placeholder="Choose Upload Date" id="from_date" name="from_date" autocomplete="off" required="" maxlength="10">
                </div>
                <div class="form-group">
                  <label for="exampleInputName"> Message <span class="star">*</span></label>
                  <div>
                    <textarea maxlength="150" rows="3" cols="70" name="msg" id="msg"></textarea>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputName"> Choose File  <span class="star">*</span></label>
                    <input type='file' name='userfile' id='file'/>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary">Upload</button>
              </div>
            </form>
          </div>       

        </div>

        

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
  </script>
    
  