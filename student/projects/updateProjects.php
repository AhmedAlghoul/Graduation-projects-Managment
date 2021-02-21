<?php
$page_title = "Projects";
require "../../includes/st_head.php"; 
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/'.$base_folder.'/'."uploads/projects/";
if((isset($_SESSION['uname']) && isset($_SESSION['token']) )){

	$uname = $_SESSION['uname'];
	$token = $_SESSION['token'];
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM projects WHERE submitter=$id";
	$project = $con->query($sql);
	if($project->num_rows !=0){
	$project = $project->fetch_array();
	}else{
		$project = 0;
	}
	if(isset($_REQUEST['p_name']) && $project !=0 && !isset($_REQUEST['delete'])){
		$name = $con->real_escape_string($_REQUEST['p_name']);
		$pr_type = $con->real_escape_string($_REQUEST['pr_type']);
		$pr_id = $project['id'];
		$disc = $con->real_escape_string($_REQUEST['discreption']);
		 $file = $con->real_escape_string($_FILES['project_file']['name']);
		$sql = "UPDATE projects SET name='$name',discreption='$disc',pr_type='$pr_type',file_name='$file' WHERE id=$pr_id";
		$con->query($sql);
		move_uploaded_file($_FILES["project_file"]["tmp_name"], $target_dir.$file);
		
}else{
	if(isset($_REQUEST['delete'])){
		$pr_id = $project['id'];
		$sql = "DELETE FROM projects WHERE id=$pr_id";
		$con->query($sql);
		$sql = "UPDATE students SET project_id=0 WHERE project_id=$pr_id";
		$con->query($sql);
		header("Refresh:0");
	}
}


?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


    <?php 
  require "../../includes/st_nav.php";
?>

      <div class="container-fluid">
	  <div class="container">
        <h1 class="mt-4 text-center">تحديث المشروع</h1>
			<?php 
			if($project !=0){?>
				<form style="width:70%;" method="post" enctype="multipart/form-data">
			  <div class="form-group">
				<label for="exampleInputEmail1">  عنوان المشروع </label>
				<input type="text" class="form-control" name="p_name"  value="<?php echo $project['name'];?>" placeholder="Enter  Name">
			  </div>
			  
			   <div class="form-group">
				<label for="exampleInputEmail1">  لغة البرمجة المستخدمة</label>
				<input type="text" class="form-control" name="pr_type" value="<?php echo $project['pr_type'];?>" placeholder="Enter Project Type">
			  </div>
			  
			  <!-- <div class="form-group">
				<label for="exampleInputPassword1">Teachers</label>
					<select class="form-control form-control-lg">
					  <option>Ahmed</option>
					  <option>Ali</option>
					</select>			 
					</div>-->
					
			
			<div class="form-group">
			  <label for="exampleFormControlTextarea2">الوصف</label>
			  <textarea class="form-control rounded-0" name="discreption" id="exampleFormControlTextarea2" rows="3"><?php echo $project['discreption'];?></textarea>
			</div>
			  
				  
				<div class="form-group">
			<label for="exampleFormControlFile1"> رفع الملفات</label>
			<input type="file" class="form-control-file" id="exampleFormControlFile1" name="project_file">
			</div>
			  
			   
			  
			  <button type="submit" class="btn btn-primary" name="update">تحديث المشروع</button>
				<button type="submit" class="btn btn-primary" name="delete" id="delete" >حذف المشروع</button>
				<script>
				
					</script>
			</form>
			<?php }
			else{ ?>
	<h1 class="mt-4">ليس لديك مشاريع لتعديلها </h1>
			<?php }?>			
</div>
      </div>
			<?php
}else{
	//not logged in
}
    require "../../includes/c_footer.php";
    ?>