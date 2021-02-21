<?php

$page_title = "Projects";
require "../../includes/st_head.php";
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/projects/";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {

	$uname = $_SESSION['uname'];
	$token = $_SESSION['token'];
	$id = $_SESSION['id'];

	if (isset($_REQUEST['p_name'])) {
		$sql = "SELECT id FROM projects WHERE submitter=$id";
		$res = $con->query($sql);
		if ($res->num_rows == 0) {
			$name = $con->real_escape_string($_REQUEST['p_name']);
			$pr_type = $con->real_escape_string($_REQUEST['pr_type']);
			// $teacher = $con->real_escape_string($_REQUEST['teachers']);
			$disc = $con->real_escape_string($_REQUEST['discreption']);
			$file = $con->real_escape_string($_FILES['project_file']['name']);
			$sql = "INSERT INTO projects(name,discreption,pr_type,submitter,file_name) VALUES('$name','$disc','$pr_type','$id','$file')";
			$con->query($sql);
			move_uploaded_file($_FILES["project_file"]["tmp_name"], $target_dir . $file);
			$sql = "SELECT id FROM projects WHERE submitter=$id";
			$res = $con->query($sql);
			$res = $res->fetch_array()[0];
			$sql = "UPDATE students SET project_id=$res WHERE user_id=$id";
			$con->query($sql);
		} else {
			// already submitted 
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
				<?php
				$id = $_SESSION['id'];
				$sql = "SELECT project_id FROM students WHERE user_id=$id AND project_id <> 0";
				$res = $con->query($sql);
				$projects = $res->num_rows;
				if ($projects == 0) {
					?>
					<h1 class="mt-4 text-center">اضافة مشروع جديد</h1>
					<form style="width:70%;" action="addProject.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1"> عنوان المشروع</label>
							<input type="text" class="form-control" placeholder="عنوان المشروع" name="p_name">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1"> اللغة البرمجية</label>
							<input type="text" class="form-control" placeholder="اللغة البرمجية المستخدمة" name="pr_type">
						</div>

			 <!-- <div class="form-group">
				<label for="exampleInputPassword1">Teachers</label>
					<select class="form-control form-control-lg" name="teachers">
					<?php
					//  $sql = "SELECT * FROM teachers";
					//  $res = $con->query($sql);
					//  $teachers = $res->fetch_all(MYSQLI_ASSOC);
					//  foreach($teachers as $t){
					 ?> 
					 <option value="<?php //echo $t['id'];?>"><?php //echo $t['name']; ?></option>
					  <?php //} ?>
					</select>			 
					</div>-->


						<div class="form-group">
							<label for="exampleFormControlTextarea2">نبذة مختصرة</label>
							<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="discreption"></textarea>
						</div>


						<div class="form-group">
							<label for="exampleFormControlFile1" name="file"> رفع ملف</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="project_file">
						</div>



						<input type="submit" class="btn btn-primary" value="اضافة" name="submit">
					</form>
				<?php
			} else {
				?>
					<h1 class="mt-4">لديك مشروع مسبقا .</h1>
					<a class="btn btn-primary" href="updateProjects.php">تعديل المشروع ؟</a>
				<?php
			}
			?>

			</div>
		</div>
		<?php
		require "../../includes/c_footer.php";
	} else {
		header('Location: ' . "../login.php");
	}
	//else redirect to login page
	?>