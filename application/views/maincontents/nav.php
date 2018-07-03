<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = ($this->session->userdata['logged_in']['user_id']);
echo $user_type = ($this->session->userdata['logged_in']['user_type']);
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
      <i class="fa fa-star"></i> <span>Application Form Entry</span>
        <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
    <ul class="treeview-menu">
      <li> 
        <a href="<?php echo site_url('Health_Home/test_data_entry'); ?>">          
          <i class="fa fa-plus"></i> Total Test Entry            
        </a>       
      </li>  

      <li> 
        <a href="<?php echo site_url('Health_Home/patient_search'); ?>">          
          <i class="fa fa-plus"></i> Diagnosis Test cum Registration            
        </a>       
      </li>  

      <li>        
        <?php if($user_type=='07'){ ?>
        <a href="<?php echo site_url('Health_Home/admission_search'); ?>">
          
          <i class="fa fa-plus"></i> Admission cum Registration           
        </a> 
         <?php } ?>       
      </li>      
    </ul>
    
  </li>

<li class="treeview">
    <a href="#">
      <i class="fa fa-star"></i> <span>Application Form Edit</span>
        <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
        </span> 
    </a>
    <ul class="treeview-menu">
      <li> 
        <a href="<?php echo site_url('Health_Home/test_data_edit'); ?>">          
          <i class="fa fa-plus"></i> Total Test Edit            
        </a>       
      </li>  

      <li> 
        <a href="<?php //echo site_url('Health_Home/patient_search'); ?>">          
          <i class="fa fa-plus"></i> Diagnosis Test Edit            
        </a>       
      </li>  

      <li>        
        <?php if($user_type=='07'){ ?>
        <a href="<?php //echo site_url('Health_Home/admission_search'); ?>">
          
          <i class="fa fa-plus"></i> Admission Edit          
        </a> 
         <?php } ?>       
      </li>      
    </ul>
    
  </li>
  </ul>
 </section>
</aside>   
