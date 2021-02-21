<?php
$page_title = "Projects";
require "../../includes/st_head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	$projects = 0;
	if (isset($_REQUEST['project'])) {
		$pid = $con->real_escape_string($_REQUEST['project']);
		$projects = 1;
	} else {
		$id = $_SESSION['id'];
		$sql = "SELECT id FROM projects WHERE submitter=$id";
		$project = $con->query($sql);
		$projects = $project->num_rows;
		$pid = $project->fetch_array()['id'];
	}
	if (isset($_REQUEST['accept']) || isset($_REQUEST['deny'])) {

		if (isset($_REQUEST['accept']) && !isset($_REQUEST['deny'])) {
			$id = $_SESSION['id'];
			$sql = "UPDATE invitations SET accepted=1,viewed=1 WHERE friend=$id";
			$con->query($sql);
			$sql = "UPDATE students SET project_id=$pid WHERE user_id=$id";
			$con->query($sql);
			header("Location: accepted.php");
		} else {
			if (isset($_REQUEST['deny']) && !isset($_REQUEST['accept'])) {
				$id = $_SESSION['id'];
				$sql = "UPDATE invitations SET accepted=0,viewed=1 WHERE friend=$id";
				$con->query($sql);
				header("Location: ../index.php");
			}
			header("Location: ../index.php");
		}
	}
	if (isset($_REQUEST['invite'])) {
		$id = $_SESSION['id']; // owner
		$inv = $con->real_escape_string($_REQUEST['friend']);
		$pid = $con->real_escape_string($_REQUEST['project']);
		$sql = "SELECT submitter FROM projects WHERE id=$pid";
		$owner = $con->query($sql);
		$owner = $owner->fetch_array()['submitter'];
		if ($owner == $id) {
			$sql = "INSERT INTO invitations(owner,project_id,friend) VALUES('$id','$pid','$inv')";
			$con->query($sql);
		}
	}
	if (isset($_REQUEST['un_invite'])) { // owner can unfriend BEFORE the admin decides a discussion
		$id = $_SESSION['id']; // owner
		$inv = $con->real_escape_string($_REQUEST['un_friend']);
		$pid = $con->real_escape_string($_REQUEST['project']);
		$sql = "SELECT submitter FROM projects WHERE id=$pid";
		$owner = $con->query($sql);
		$owner = $owner->fetch_array()['submitter'];
		if ($owner == $id) {
			$sql = "SELECT approved FROM projects WHERE id=$pid";
			$ap = $con->query($sql);
			$ap = $ap->fetch_array()['approved'];
			if (!$ap) {
				$sql = "DELETE FROM invitations WHERE owner=$id AND project_id=$pid AND friend=$inv";
				// echo $sql;
				$con->query($sql);
				// $sql = "UPDATE students SET project_id=0 WHERE user_id=$inv";
				// $con->query($sql);
			}
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
				if ($projects > 0) {

					$sql = "SELECT * FROM projects WHERE id=$pid";
					$res = $con->query($sql);
					$project = $res->fetch_array();
					if ($project['submitter'] != $_SESSION['id']) {
						//owner ?
						?>
						<h1 class="mt-4 text-center"> بيانات المشروع</h1>
						<form style="width:70%;">
							<div class="form-group">
								<label for="exampleInputEmail1"> عنوان المشروع:</label>
								<p>
									<?php echo $project['name']; ?> </p>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1"> اسماء المجموعة:</label>
								<p>
									<ul>
										<?php
										$pr_id = $project['id'];
										$sql = "SELECT * FROM students WHERE project_id=$pr_id";
										$res = $con->query($sql);
										$students = $res->fetch_all(MYSQLI_ASSOC);
										foreach ($students as $st) {
											?>
											<li><?php echo $st['name']; ?></li>
										<?php } ?>

									</ul>
								</p>
							</div>

							<div class="form-group">
								<label for="exampleInputPassword1">المناقشين:</label>
								<p>
									<ul>
										<?php
										$teacher = $project['teacher'];
										$t = $project['teacher'];
										$t = json_decode($t);

										if (sizeof($t) == 0) {
											?>
											<li> لم يوافق اي مناقش بعد. </li>
										<?php
									} else {

										foreach ($t as $i) {
											$sql = "SELECT name FROM teachers WHERE user_id=$i";
											$name = $con->query($sql);
											$name = $name->fetch_array()['name'];
											?>
												<li><?php echo $name; ?></li>
											<?php
										}
									} ?>
									</ul>
								</p>

							</div>
							<?php
							$sql = "SELECT * FROM discussions WHERE project_id=$pr_id";
							$res = $con->query($sql);
							if ($res->num_rows > 0) {
								$dis = $res->fetch_array();
								$time = new DateTime($dis['date']);
								$date = $time->format('n/j/Y');
								$hour = $time->format('H:i');
								?>

								<div class="form-group">
									<label for="exampleInputPassword1">تاريخ المناقشة:</label>
									<p> <i class="fa fa-calendar" aria-hidden="true" style="margin-right:5px;"></i><?php echo $date; ?></p>

								</div>

								<div class="form-group">
									<label for="exampleInputPassword1">وقت المناقشة:</label>
									<p> <i class="far fa-clock" style="margin-right:5px;"></i><?php echo $hour; ?></p>

								</div>

								<div class="form-group">
									<label for="exampleInputPassword1"> المدة:</label>
									<p> <i class="far fa-clock" style="margin-right:5px;"></i><?php echo $dis['duration']; ?> دقيقة </p>

								</div>



								<div class="form-group">
									<label for="exampleInputPassword1">مكان المناقشة:</label>
									<p> <i class="fa fa-map-marker" aria-hidden="true" style="margin-right:5px;"></i><?php echo $dis['place']; ?></p>

								</div>
							<?php } else {
							?>
								<div class="form-group">
									<p> الرجاء الانتظار حتى يحدد المشرف موعد المناقشة المناسب .</p>
									<a class="btn btn-primary" href="invite_friends.php?accept&project=<?php echo $pid; ?>">قبول الانضمام</a>
									<a class="btn btn-primary" href="invite_friends.php?deny&project=<?php echo $pid; ?>">رفض الانضمام</a>

								</div>
							<?php } ?>


						</form>
					<?php
				} else {
					//owner
					?>
						<form style="width:70%;" action="invite_friends.php?project=<?php echo $pid; ?>" method="post">
							<div class="form-group mt-4">
								<?php
								$id = $_SESSION['id'];
								$sql = "SELECT * FROM students WHERE students.user_id IN (SELECT friend FROM invitations WHERE accepted=0)";
								$inv = $con->query($sql);
								$inv = $inv->fetch_all(MYSQLI_ASSOC);
								if (sizeof($inv) < 4) {
									if (sizeof($inv) >= 1) {
										?>
										<label for="exampleInputPassword1">دعوة الطلاب للانضمام</label>
										<ul>
											<?php
											foreach ($inv as $t) {
												?>
												<li name="friend"> <?php echo $t['name']; ?></li>
												<a href="<?php echo $_SERVER['PHP_SELF'] . '?un_friend=' . $t['user_id'] . '&project=' . $pid . '&un_invite=1'; ?>" class="btn btn-primary"> الغاء الدعوة </a>

											<?php
										} ?>

											<input type="hidden" name="project" value="<?php echo $pid; ?>" />
										</ul>

									<?php
								} ?>
									<?php
									$sql = "SELECT * FROM students WHERE project_id=0 AND user_id <>$id AND user_id NOT IN(SELECT friend FROM invitations WHERE project_id=$pid)";
									$res = $con->query($sql);
									$students = $res->fetch_all(MYSQLI_ASSOC);
									if ($res->num_rows > 0) {
										?>
										<label for="exampleInputPassword1">الطلاب</label>
										<select class="form-control form-control-lg" name="friend">
											<?php

											foreach ($students as $t) {
												?>
												<option value="<?php echo $t['user_id']; ?>"><?php echo $t['name']; ?></option>
											<?php } ?>
										</select>

									</div>
									<input type="hidden" name="project" value="<?php echo $pid; ?>" />
									<input type="submit" class="btn btn-primary" value="ارسال دعوة" name="invite">

								<?php } else {
								?>
									<h1 class="mt-4"> لا يوجد طلاب متاحين .. </h1>
								<?php
							}
						} ?>
						</form>
					<?php
				}
			} else {
				?>
					<h1 class="mt-4"> ليس لديك مشروع . </h1>
					<a class="btn btn-primary" href="projects/addProject.php">اضافة مشروع جديد</a>
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
	?>