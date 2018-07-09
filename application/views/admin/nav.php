<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/img/icon.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
 <ul class="sidebar-menu">
  <li class="treeview">
    <a href="<?php echo site_url('Admin/admin_home');?>">
      <i class="fa fa-home"></i> <span>Home</span>         
    </a>        
  </li>
  <?php if($user_type=='01' || $user_type=='04' || $user_type=='05' || $user_type=='06'){ ?>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-user-plus"></i> <span>User Creation</span>        
    </a>
     <ul class="treeview-menu">
      <?php if($user_type=='01'){ ?>
        <li class="active">          
          <a href="<?php echo site_url('Admin/user_creation_admin');?>">
          <i class="fa fa-plus"></i> Admin User Creation</a>          
        </li>
        <?php } ?>
        <?php if($user_type=='01' || $user_type=='04' || $user_type=='05' || $user_type=='06'){ ?>
        <li class="active">          
          <a href="<?php echo site_url('Admin/user_creation_institute');?>">
          <i class="fa fa-plus"></i> Institutional User Creation</a>          
        </li>
        <?php } ?>
     </ul>
  </li>

  <li class="treeview">
    <a href="<?php //echo site_url('Admin/admin_home');?>">
      <i class="fa fa-home"></i> <span>User Details Edit</span>         
    </a>   
    <ul class="treeview-menu">
      <?php if($user_type=='01'){ ?>
        <li class="active">          
          <a href="<?php echo site_url('Admin/user_edit_admin');?>">
          <i class="fa fa-plus"></i> Admin User Edit</a>           
        </li>
        <?php } ?>
        <?php if($user_type=='01' || $user_type=='04' || $user_type=='05' || $user_type=='06'){ ?>
        <li class="active">           
          <a href="<?php echo site_url('Admin/user_edit_institute');?>">
          <i class="fa fa-plus"></i> Institutional User Edit</a>          
        </li>
        <?php } ?>
     </ul>     
  </li>
  <?php } ?>
  <?php if($user_type=='01' || $user_type=='04'){ ?>

  <li class="treeview">
    <a href="<?php echo site_url('Admin/reset_password');?>">
      <i class="fa fa-home"></i> <span>Reset Password</span>         
    </a>        
  </li>
  
  <li class="treeview">
    <a href="<?php echo site_url('Admin/subcategory_test');?>">
      <i class="fa fa-star"></i><span>Addition Sub-category /<br>     Test name</span>         
    </a>        
  </li>

  <?php } ?>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-star"></i> <span>Reports</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
    <ul class="treeview-menu">      
       <li> 
        <a href="<?php echo site_url('Reports/vbd_report_lab_datewise'); ?>">          
          <i class="fa fa-plus"></i>Institute wise Diagnosis<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Test Report (VBD)<br> 
        </a>         
      </li>
        <li> 
        <a href="<?php echo site_url('Reports/vbd_report_other_datewise'); ?>">          
          <i class="fa fa-plus"></i> Institute wise Admission <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Report (VBD)<br> 
        </a>         
      </li>
    
    
      <li> 
        <a href="<?php echo site_url('Reports/vbd_report_category_wise'); ?>">          
          <i class="fa fa-plus"></i> Category wise Report (VBD) <br> 
        </a>         
      </li>
      <li> 
        <a href="<?php echo site_url('Reports/vbd_report_subcategory_wise'); ?>">          
          <i class="fa fa-plus"></i> Sub Category wise Report (VBD) <br> 
        </a>         
      </li> 
      <li> 
		<a href="#">
      <i class="fa fa-star"></i> <span>Status Report (VBD)</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
		<ul class="treeview-menu">      
       <li> 
        <a href="<?php echo site_url('Reports/fetch_vbd_report_district_status_wise'); ?>">          
          <i class="fa fa-plus"></i> District Status Report
        </a>         
      </li>
	  <!--<li> 
       <a href="<?php //echo site_url('Reports/vbd_report_category_wise'); ?>">         
          <i class="fa fa-plus"></i> VBD Status Report
        </a>         
      </li>-->
	 </ul>          
      </li>
	  
                 
    </ul>
	  <li class="treeview">
    <a href="<?php echo site_url('Admin/user_details');?>">
      <i class="fa fa-star"></i><span>View User Details <br></span>         
    </a>
	
	
	        
  </li>
  
    
  </li>
 </ul>
     </section>

  </aside>
