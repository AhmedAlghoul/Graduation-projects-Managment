<?php
$page_title = "المشروع";
require "../includes/st_head.php";
// if no projects --> Add one
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	$id = $_SESSION['id'];
	$sql = "SELECT project_id FROM students WHERE user_id=$id AND project_id<>0 UNION SELECT project_id FROM invitations WHERE friend = $id AND accepted=1";
	$res = $con->query($sql);
	$projects = $res->num_rows;
	?>
	<!-- Page Content -->
	<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

		<?php
		require "../includes/st_nav.php";
		?>

		<div class="container-fluid">
			<div class="container">
				<?php
				if ($projects > 0) {

					$pid = $res->fetch_array();
					$pid = $pid["project_id"];

					$sql = "SELECT * FROM projects WHERE id=$pid";
					$res = $con->query($sql);
					$project = $res->fetch_array();
					?>
					<h1 class="mt-4 text-center"> مشروع الطالب</h1>
					<form style="width:70%;">
						<div class="form-group">
							<label for="exampleInputEmail1"> اسم المشروع:</label>
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
									$teacher = json_decode($teacher);

									if (sizeof($teacher) == 0) {
										?>
										<li> .لم يوافق اي مناقش بعد </li>
									<?php
								} else {
									foreach ($teacher as $t) {
										$sql = "SELECT name FROM teachers WHERE user_id=$t";
										$name = $con->query($sql);
										$name = $name->fetch_array()['name'];
										?>
											<li><?php echo $name; ?></li>
										<?php }
								}
								?>
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
								<p> <i class="far fa-clock" style="margin-right:5px;"></i><?php echo $dis['duration']; ?> minutes</p>

							</div>



							<div class="form-group">
								<label for="exampleInputPassword1">مكان المناقشة:</label>
								<p> <i class="fa fa-map-marker" aria-hidden="true" style="margin-right:5px;"></i><?php echo $dis['place']; ?></p>

							</div>
						<?php } else {
						?>
							<div class="form-group">
								<p> الرجاء الانتظار حتى يحدد المشرف موعد المناقشة المناسب .</p>
								<a class="btn btn-primary" href="projects/updateProjects.php">تعديل المشروع</a>
								<a class="btn btn-primary" href="projects/invite_friends.php?project=<?php echo $pr_id; ?>">دعوة انضمام</a>

							</div>
						<?php } ?>


					</form>
				<?php
			} else {
				?>
					<h1 class="mt-4 text-center"> دعوات الانضمام </h1>
					<?php
					// display invitations
					$sql = "SELECT * FROM projects WHERE id IN(SELECT project_id FROM invitations WHERE friend =$id AND viewed=0 )";
					$proj = $con->query($sql);
					$p = $proj->num_rows;
					if ($p > 0) {
						$proj = $proj->fetch_all(MYSQLI_ASSOC);

						?>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">اسم المشروع</th>
									<th scope="col"> المشاركين</th>
									<th scope="col"> المناقش</th>
									<th scope="col"> التاريخ</th>
									<th scope="col"> الوقت</th>
									<th scope="col"> المكان</th>

									<th scope="col">قبول/رفض</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($proj as $project) {
									$pid = $project['id'];
									$sql = "SELECT * from discussions WHERE project_id=$pid";
									$dis = $con->query($sql);
									$dis = $dis->fetch_array();
									?>
									<tr>
										<th scope="row"><?php echo $i++; ?></th>
										<td> <?php echo $project['name']; ?></td>
										<td> <?php
												$pid = $project['id'];
												$sql = "SELECT name FROM students WHERE project_id=$pid";
												$stu = $con->query($sql);
												$stu = $stu->fetch_all(MYSQLI_ASSOC);
												?>
											<ul>
												<?php
												foreach ($stu as $s) {
													?>
													<li>
														<?php echo $s['name']; ?>
													</li>
												<?php
											}
											?>
											</ul>
										</td>
										<td>
											<?php
											$tid = $project['teacher'];
											$t = json_decode($tid);
											if (sizeof($t) > 0) {
												foreach ($t as $i) {
													$sql = "SELECT name FROM teachers WHERE user_id=$i";
													$name = $con->query($sql);
													$name = $name->fetch_array()['name'];

													echo $name . '<br>';
												}
											} else {
												echo "لم يتم تحديد أي مناقش بعد";
											}
											?>
										</td>
										<?php

										$time = new DateTime($dis['date']);
										$date = $time->format('n/j/Y');
										$hour = $time->format('H:i');
										?>

										<td> <?php echo $date; ?> </td>
										<td> <?php echo $hour; ?> </td>
										<td> <?php echo $dis['place']; ?> </td>

										<td> <a href="projects/invite_friends.php?project=<?php echo $project['id'] . '&accept=1'; ?>" class="delete-post-link"> <i class="fas fa-check-circle"></i>
											</a>

											<a href="projects/invite_friends.php?project=<?php echo $project['id'] . '&deny=1'; ?>">
												<i class="fas fa-minus-circle"></i></a></td>


									</tr>
								<?php
							}
							?>
							</tbody>
						</table>

					<?php

				}
				$sql = "SELECT COUNT(id) FROM invitations WHERE friend=$id AND accepted=1";
				$u = $con->query($sql);
				$num = $u->fetch_array()[0];
				if ($num == 0) {
					?>
						<a class="btn btn-primary" href="projects/addProject.php">إنشاء مشروع جديد</a>
					<?php
				}
			}
			?>

			</div>
		</div>
		<?php
		require "../includes/c_footer.php";
	} else {
		header('Location: ' . "../login.php");
	}
	?>