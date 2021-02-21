<?php

$page_title = "تحديث المشاريع";
require "../../includes/head.php";
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/projects/";
if ((isset($_SESSION['uname']) && isset($_SESSION['token'])) && isset($_REQUEST['pid'])) {
	$pid = $con->real_escape_string($_REQUEST['pid']);
	if ($_SESSION['level'] == 1) {
		$uname = $_SESSION['uname'];
		$token = $_SESSION['token'];
		$id = $_SESSION['id'];
		if (isset($_REQUEST['p_name'])) {
			$name = $con->real_escape_string($_REQUEST['p_name']);
			$pr_type = $con->real_escape_string($_REQUEST['pr_type']);
			$disc = $con->real_escape_string($_REQUEST['discreption']);
			$file = $con->real_escape_string($_FILES['project_file']['name']);

			$sql = "UPDATE projects SET name='$name',discreption='$disc',pr_type='$pr_type',file_name='$file' WHERE id=$pid";

			$con->query($sql);
			move_uploaded_file($_FILES["project_file"]["tmp_name"], $target_dir . $file);
		}
		$sql = "SELECT * FROM projects WHERE id=$pid";
		$project = $con->query($sql);
		$project = $project->fetch_array();
		?>
		<!-- Page Content -->
		<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


			<?php
			require "../../includes/nav.php";
			?>

			<div class="container-fluid">
				<div class="container">

					<h1 class="mt-4 text-center">تحديث المشاريع</h1>
					<form style="width:70%;" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1"> اسم المشروع</label>
							<input type="text" class="form-control" placeholder="ادخل اسم المشروع" name="p_name" value="<?php echo $project['name']; ?>">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1"> لغة البرمجة المستخدمة</label>
							<input type="text" class="form-control" placeholder="ادخل اسم لغة البرمجة المستخدمة" name="pr_type" value="<?php echo $project['pr_type']; ?>">
						</div>



						<div class="form-group">
							<label for="exampleFormControlTextarea2">وصف المشروع</label>
							<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="discreption"><?php echo $project['discreption']; ?></textarea>
						</div>


						<div class="form-group">
							<label for="exampleFormControlFile1" name="file"> رفع الملف</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="project_file">
						</div>



						<input type="submit" class="btn btn-primary" value="Update" name="submit">
					</form>


				</div>
			</div>
			<?php
			require "../../includes/c_footer.php";
		}
	} else {
		header('Location: ' . "../login.php");
	}
	//else redirect to login page
	?>