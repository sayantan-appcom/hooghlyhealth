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
  
    </section>

    
    <section class="content"> 
	
	   <div class="box-body">
	   <div class="row">
	   <form role="form" method="POST" action="">
		
			<h1>
         <?php echo " NO records Found";?>
		 </h1>
	 </form>
	 </div>
	 </section>
	 </div>
	 
	
	
	
