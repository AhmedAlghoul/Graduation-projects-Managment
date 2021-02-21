<?php

$page_title = "إضافة مشروع جديد";
require "../../includes/head.php";
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/projects/";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	if ($_SESSION['level'] == 1) {
		$uname = $_SESSION['uname'];
		$token = $_SESSION['token'];
		$id = $_SESSION['id'];
		if (isset($_REQUEST['p_name'])) {
			$sql = "SELECT id FROM projects WHERE submitter=$id";
			$res = $con->query($sql);
			if ($res->num_rows == 0) {
				$sid = $_REQUEST['student'];
				$name = $con->real_escape_string($_REQUEST['p_name']);
				$pr_type = $con->real_escape_string($_REQUEST['pr_type']);
				// $teacher = $con->real_escape_string($_REQUEST['teachers']);
				$disc = $con->real_escape_string($_REQUEST['discreption']);
				$file = $con->real_escape_string($_FILES['project_file']['name']);
				$sql = "INSERT INTO projects(name,discreption,pr_type,submitter,file_name) VALUES('$name','$disc','$pr_type','$sid','$file')";
				$con->query($sql);
				move_uploaded_file($_FILES["project_file"]["tmp_name"], $target_dir . $file);
				$sql = "SELECT id FROM projects WHERE submitter=$sid";
				$res = $con->query($sql);
				$res = $res->fetch_array()[0];
				$sql = "UPDATE students SET project_id=$res WHERE user_id=$sid";
				$con->query($sql);
			} else {
				// already submitted 
			}
		}


		?>
		<!-- Page Content -->
		<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


			<?php
			require "../../includes/nav.php";
			?>

			<div class="container-fluid">
				<div class="container">

					<h1 class="mt-4 text-center">إضافة مشروع جديدة</h1>
					<form style="width:70%;" action="addProject.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1"> اسم المشروع</label>
							<input type="text" class="form-control" placeholder="ادخل اسم المشروع " name="p_name">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1"> لغة البرمجة المستخدمة</label>
							<input type="text" class="form-control" placeholder="ادخل لغة البرمجةالمستخدمة " name="pr_type">
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">الطالب </label>
							<select class="form-control form-control-lg" name="student">
								<?php
								$sql = "SELECT * FROM students WHERE project_id=0";
								$res = $con->query($sql);
								$teachers = $res->fetch_all(MYSQLI_ASSOC);
								foreach ($teachers as $t) {
									?>
									<option value="<?php echo $t['user_id']; ?>"><?php echo $t['name']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea2">الوصف </label>
							<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="discreption"></textarea>
						</div>

						<div class="form-group">
							<label for="exampleFormControlFile1" name="file"> رفع الملف</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="project_file">
						</div>

						<input type="submit" class="btn btn-primary mb-4" value="إضافة" name="submit">
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