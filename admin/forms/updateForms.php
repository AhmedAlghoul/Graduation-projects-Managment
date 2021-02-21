<?php
$page_title = "النماذج";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	if ($_SESSION['level'] == 1) {
		$form = "";
		if (isset($_REQUEST['form'])) {
			$form_id = $_REQUEST['form'];
			$sql = "SELECT * FROM forms WHERE id=$form_id";
			$form = $con->query($sql);
			$form = $form->fetch_array();
		} else {
			$form_id = 1;
			$sql = "SELECT * FROM forms WHERE id=$form_id";
			$form = $con->query($sql);
			$form = $form->fetch_array();
		}
		if (isset($_REQUEST['form_name']) && isset($_FILES['form_file'])) {
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/forms/";
			$form = $_REQUEST['form_name'];
			$file = $_FILES['form_file']['name'];
			$sql = "INSERT INTO forms(name,file) VALUES('$form','$file')";
			$con->query($sql);
			move_uploaded_file($_FILES["form_file"]["tmp_name"], $target_dir . $file);
		}
		?>


		<!-- Page Content -->
		<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">
			<?php
			require "../../includes/nav.php";
			?>

			<div class="container-fluid">
				<div class="container">
					<h1 class="mt-4 text-center">تحديث النماذج</h1>
					
					<form style="width:70%;">
						<div class="form-group">
							<label for="exampleInputEmail1"> الاسم</label>
							<input type="text" class="form-control" value="<?php echo $form['name']; ?>" placeholder="Enter  Name">
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1"> رفع ملف النموذج</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div>
						<button type="submit" class="btn btn-primary">تحديث</button>
					</form>

				</div>
			</div>
			<?php
			require "../../includes/c_footer.php";
		}
	} else {
		header('Location: ' . "../login.php");
	}
	?>