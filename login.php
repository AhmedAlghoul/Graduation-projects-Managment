<?php
session_start();
// require "classes/config.php";
if (!(isset($_SESSION['uname']) && isset($_SESSION['token']))) {

  ?>
  <!DOCTYPE html>
  <html dir="rtl">

  <head>
    <title></title>
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <style type="text/css">
      h3 {
        margin-bottom: 4%
      }

      .classForm {
        margin-top: 30%;
        margin-left: 10%
      }

      .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
      }

      .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }

      .closebtn:hover {
        color: black;
      }

      @media only screen and (max-width: 600px) {
        .classImg {
          display: none;
        }

        .classForm {
          margin-right: 30%;
        }

        h3 {
          margin-bottom: 10%;
        }
      }
    </style>
  </head>

  <body>
    <div class="row">
      <div class="col-md-6 classImg" style="height: 650px">
        <img src="img/3.jpg" class="img-fluid" alt="Responsive image" style="height: 100%">
      </div>



      <div class=" col-md-4  col-sm-12">
        <div class="classForm">
          <h3>تسجيل الدخول</h3>

          <form action="loginDB.php" method="post">

            <?php
            if (isset($_SESSION['pro'])) {
              echo '<div class="alert">';
              echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
              echo '' . $_SESSION['pro'] . '';
              echo '</div>';
              unset($_SESSION['pro']);
            }
            ?>

            <div class="form-group">
              <label for="exampleInputEmail1">اسم المستخدم </label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="اسم المستخدم" name="username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1"> كلمة المرور</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور" name="password">
            </div>
            <div class="form-check mb-4">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">تذكر كلمة المرور
              </label>
            </div>
            <div class="form-group">
              <button type="submit" style="width: 100%;" class="btn btn-primary">تسجيل الدخول</button>
            </div>
            <div class="form-group">
              <a href="register.php" style="width: 100%" class="btn btn-primary">انشاء حساب جديد</a>
            </div>
          </form>
        </div>

      </div>

    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  </body>

  </html>
<?php
} else {

  if ($_SESSION['level'] == 1) {
    //admin
    header('Location: ' . "admin/index.php");
  } else if ($_SESSION['level'] == 2) {
    header('Location: ' . "teacher/index.php");
    //teacher
  } else if ($_SESSION['level'] == 3) {
    header('Location: ' . "student/index.php");
    //student
  }
}
?>