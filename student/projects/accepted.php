<?php

$page_title = "Projects";
require "../../includes/st_head.php"; 
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/'.$base_folder.'/'."uploads/";
if((isset($_SESSION['uname']) && isset($_SESSION['token']))){
	$uname = $_SESSION['uname'];
	$token = $_SESSION['token'];
	$id = $_SESSION['id'];



?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


    <?php 
  require "../../includes/st_nav.php";
?>

      <div class="container-fluid">
	  <div class="container">
        <h1 class="mt-4 text-center">Thank you for accepting the invitation</h1>

      </div>
      </div>
      <?php
    require "../../includes/c_footer.php";
					 }else{
						 //NOT LOGGED IN
					 }
					 //else redirect to login page
		?>