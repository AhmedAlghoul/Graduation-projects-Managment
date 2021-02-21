<?php
$page_title = "Advertising";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	if ($_SESSION['level'] == 1 && isset($_REQUEST['aid'])) {
		if (isset($_REQUEST['title']) && isset($_FILES['file'])) {
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/advertising/";
			$title = $_REQUEST['title'];
			$disc = $_REQUEST['discreption'];
			$file = $_FILES['file']['name'];
			$aid = $_REQUEST['aid'];
			$sql = "UPDATE advertising SET title='$title',discreption='$disc',file='$file' WHERE id=$aid";
			$con->query($sql);
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $file);
		}
		$ad = "";
		if (isset($_REQUEST['aid'])) {
			$aid = $_REQUEST['aid'];
			$sql = "SELECT * FROM advertisisng WHERE id=$aid";
			$res = $con->query($sql);
			$ad = $res->fetch_array();
		}
		?>

		<!-- Page Content -->
		<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

			<?php
			require "../../includes/nav.php";
			?>
			<div class="container-fluid">
				<div class="container">
					<h1 class="mt-4 text-center">Update Advertising</h1>
					<form style="width:70%;">
						<div class="form-group">
							<label for="exampleInputEmail1"> Title</label>
							<input type="text" class="form-control" value="<?php echo $ad['title']; ?>" placeholder="Enter  Name">
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea2">Description</label>
							<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"><?php echo $ad['discreption']; ?></textarea>
						</div>

						<div class="form-group">
							<label for="exampleFormControlFile1"> file input</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div>

						<button type="submit" class="btn btn-primary">Update</button>
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