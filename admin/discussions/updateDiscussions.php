<?php
$page_title = "تحديث المناقشات";
require "../../includes/head.php"; 
if((isset($_SESSION['uname']) && isset($_SESSION['token']))){
	if($_SESSION['level'] ==1){
		$did=0;
		if(isset($_REQUEST['did'])){
			$did = $_REQUEST['did'];
		}
		if(isset($_REQUEST['submit'])){
			echo json_encode($_REQUEST);
			$pid = $_REQUEST['project'];
			$date = $_REQUEST['date'];
			$time = $_REQUEST['time'];
			$place = $_REQUEST['place'];
			$duration = $_REQUEST['duration'];
			$date = date('Y-m-d H:i:s', strtotime("$date $time"));
			$sql = "UPDATE discussions SET date='$date',place='$place',duration='$duration' WHERE project_id=$pid";
			$con->query($sql);
		}
		if($did==0){
		$sql = "SELECT * FROM projects";
		$projects = $con->query($sql);
		$projects = $projects->fetch_all(MYSQLI_ASSOC);	
	}else{
			$sql = "SELECT project_id FROM discussions WHERE id=$did";
			$pid = $con->query($sql);
			$pid = $pid->fetch_array();
			$pid= $pid[0];
			$sql = "SELECT * FROM projects WHERE id=$pid";
			$projects = $con->query($sql);
			$projects = $projects->fetch_all(MYSQLI_ASSOC);	
		}
      
?>

    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

    <?php 
  require "../../includes/nav.php";
?>
    <div class="container-fluid">
	  <div class="container">
        <h1 class="mt-4 text-center"> تحديث المناقشات</h1>
		 <form style="width:70%;" method="post">
		 
			   <div class="form-group">
				<label for="">المشروع</label>
					<select class="form-control form-control-lg" name="project">
					<?php foreach($projects as $project){?>	
					<option value="<?php echo $project['id'];?>"><?php echo $project['name'];?>	</option>
					<?php }?>
					  
					</select>			 
					</div>
					
					 <div class="form-group">
				<label for="">  التاريخ</label>
				<input type="Date" class="form-control"  name="date" >
			  </div>
			  
			  <div class="form-group">
				<label for="">  الوقت</label>
				<input type="time" class="form-control"  name="time">
			  </div>
			  
			  <div class="form-group">
				<label for="">  Place</label>
				<input type="text" class="form-control" name="place" >
			  </div>  
			  <div class="form-group">
				<label for="">  المدة</label>
				<input type="text" class="form-control" name="duration" onkeypress="return /^\d$/.test(event.key);">
			  </div>  
			  <button type="submit" class="btn btn-primary" name="submit">تحديث </button>
			</form>


      </div>
      </div>
      <?php
		require "../../includes/c_footer.php";
		
	}
}else{
	header('Location: '."../login.php");

}
    ?>