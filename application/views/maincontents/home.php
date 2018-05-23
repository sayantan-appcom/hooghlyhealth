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
        Welcome to &nbsp;&nbsp;
        <b><?php echo $user_name; ?></b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"> Dashboard</a></li>
      </ol>
    </section>

   
  </div>     
   
   