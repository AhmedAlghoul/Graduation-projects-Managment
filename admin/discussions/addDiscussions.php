<?php
$page_title = "المناقشات";
require "../../includes/head.php"; 
if((isset($_SESSION['uname']) && isset($_SESSION['token']))){
	if($_SESSION['level'] ==1){
		if(isset($_REQUEST['submit']) && isset($_REQUEST['project'])){
			$pid = $_REQUEST['project'];
			$date = $_REQUEST['date'];
			$time = $_REQUEST['time'];
			$place = $_REQUEST['place'];
			$duration = $_REQUEST['duration'];
			$date = date('Y-m-d H:i:s', strtotime("$date $time"));
			
			$sql = "INSERT INTO discussions(project_id,date,place,duration) VALUES('$pid','$date','$place','$duration')";
			$con->query($sql);
			$sql = "SELECT id FROM discussions WHERE project_id=$pid";
			$res = $con->query($sql);
			$res = $res->fetch_array();
			$sid = $res[0]; 
			$sql = "UPDATE projects SET discussion=$sid,approved=1 WHERE id=$pid";
			$con->query($sql);
		}
		$sql = "SELECT * FROM projects WHERE id NOT IN ( SELECT project_id FROM discussions)";
      $projects = $con->query($sql);
      $projects = $projects->fetch_all(MYSQLI_ASSOC);
?>

    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

    <?php 
  require "../../includes/nav.php";
?>
    <div class="container-fluid">
	  <div class="container">
        <h1 class="mt-4 text-center"> تَحْدِيْدُ مناقشةٍ </h1>
		 <form style="width:70%;" method="post">
		 
			   <div class="form-group">
				<label for="">عنوان المشروع</label>
					<select class="form-control form-control-lg" name="project">
					<?php foreach($projects as $project){?>	
					<option value="<?php echo $project['id'];?>"><?php echo $project['name'];?>	</option>
					<?php }?>
					  
					</select>			 
					</div>
					
					 <div class="form-group">
				<label for=""> تاريخ المناقشات</label>
				<input type="Date" class="form-control"  name="date" >
			  </div>
			  
			  <div class="form-group">
				<label for=""> الوقت</label>
				<input type="time" class="form-control"  name="time">
			  </div>
			  
			  <div class="form-group">
				<label for="">  المكان</label>
				<input type="text" class="form-control" name="place" >
			  </div>  
			  <div class="form-group">
				<label for="">  المدة</label>
				<input type="text" class="form-control" name="duration" onkeypress="return /^\d$/.test(event.key);">
			  </div>  
			  <button type="submit" class="btn btn-primary" name="submit">إضافة</button>
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