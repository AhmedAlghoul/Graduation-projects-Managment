<?php
$page_title = "Projects";
require "../includes/st_head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM students WHERE user_id=$id";
	$stu = $con->query($sql);
	$stu = $stu->fetch_array();
	$sql = "SELECT email,phone FROM users WHERE id=$id";
	$stu2 = $con->query($sql);
	$stu2 = $stu2->fetch_array();
	$stu = array_merge($stu, $stu2);
	$stu['type'] = 'طالب';
	?>
	<!-- Page Content -->
	<div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

		<?php
		require "../includes/st_nav.php";
		?>

		<div class="container-fluid">
			<div class="container">
				<h1 class="mt-4 text-center"> بيانات الطالب</h1>
				<form style="width:70%;">

					<div class="form-group">
						<label> نوع الحساب</label>
						<input type="text" class="form-control" placeholder="Type" value="<?php echo $stu['type']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label> الرقم الجامعي</label>
						<input type="text" class="form-control" placeholder="ID" value="<?php echo $stu['st_id']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label>اسم الطالب</label>
						<input type="text" class="form-control" placeholder="Name" value="<?php echo $stu['name']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label>الايميل</label>
						<input type="text" class="form-control" placeholder="Email" value="<?php echo $stu['email']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label>رقم الهاتف</label>
						<input type="text" class="form-control" placeholder="Phone" value="<?php echo $stu['phone']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label>التخصص</label>
						<input type="text" class="form-control" placeholder="Specialization" value="<?php echo $stu['spec']; ?>" disabled="">
					</div>

					<div class="form-group">
						<label>المستوي</label>
						<input type="text" class="form-control" placeholder="level" value="<?php echo $stu['level']; ?>" disabled="">
					</div>



				</form>


				</head>

				<body>
					<div id="chartContainer" style="height: 300px; width: 100%;"></div>
					<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
				</body>

				</html>


			</div>
		</div>
		<?php
		require "../includes/c_footer.php";
	} else {
		header('Location: ' . "../login.php");
	}
	?>