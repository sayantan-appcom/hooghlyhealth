<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
$user_type = ($this->session->userdata['logged_in']['user_type']);
$user_name = ($this->session->userdata['logged_in']['user_name']);
} else {
header("location: index");
}
?>
<ul class="sidebar-menu">
  <li class="treeview">
    <a href="<?php echo site_url('Health_Home/home');?>">
      <i class="fa fa-home"></i> <span>Home</span>         
    </a>        
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-star"></i> <span>Application Form</span>
        <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
    <ul class="treeview-menu">
      
      <li> 
        <a href="<?php echo site_url('Health_Home/entry_diagnosis_test'); ?>">          
          <i class="fa fa-plus"></i> For Diagnosis Test            
        </a>       
      </li>  

      <li>        
        <?php if($user_type=='6'){ ?>
        <a href="<?php echo site_url('Health_Home/entry_admission'); ?>">
          
          <i class="fa fa-plus"></i> For Admission            
        </a> 
         <?php } ?>       
      </li>  
                 
    </ul>
    
  </li>

<!--<li class="treeview">
    <a href="#">
      <i class="fa fa-star"></i> <span>Reports</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
    <ul class="treeview-menu">      
      <li> 
        <a href="<?php //echo site_url('Reports/vbd_report_lab_datewise'); ?>">          
          <i class="fa fa-plus"></i> Vector Bone Disease Report
        </a> 
        
      </li> 
                 
    </ul>
    
  </li>-->

  </ul>
 </section>
</aside>   
