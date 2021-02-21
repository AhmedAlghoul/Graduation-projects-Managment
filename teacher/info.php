<?php
$page_title = "المشاريع";
require "../includes/te_head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  $id = $_SESSION['id'];
  $sql = "SELECT te_id,name FROM teachers WHERE user_id=$id";
  $teacher = $con->query($sql);
  $teacher = $teacher->fetch_array();
  $sql = "SELECT email,phone FROM users WHERE id=$id";
  $teacher2 = $con->query($sql);
  $teacher2 = $teacher2->fetch_array();
  $teacher = array_merge($teacher, $teacher2);
  $teacher['type'] = 'Teacher';
  ?>
  <!-- Page Content -->
  <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

    <?php
    require "../includes/te_nav.php";
    ?>

    <div class="container-fluid">
      <div class="container">
        <h1 class="mt-4 text-center"> بياناتي  </h1>
        <form style="width:70%;">

          <div class="form-group">
            <label for="exampleInputEmail1"> نوع الحساب </label>
            <input type="text" class="form-control" placeholder="Type" value="<?php echo $teacher['type']; ?>" disabled="">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">الرقم الجامعي </label>
            <input type="text" class="form-control" placeholder="ID" value="<?php echo $teacher['te_id']; ?>" disabled="">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">الاسم </label>
            <input type="text" class="form-control" placeholder="Name" value="<?php echo $teacher['name']; ?>" disabled="">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">البريد الالكتروني </label>
            <input type="text" class="form-control" placeholder="Email" value="<?php echo $teacher['email']; ?>" disabled="">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">رقم الهاتف </label>
            <input type="text" class="form-control" placeholder="Phone" value="<?php echo $teacher['phone']; ?>" disabled="">
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