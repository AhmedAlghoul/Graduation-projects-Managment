<?php
session_start();
require "classes/config.php";
if (!(isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = $con->real_escape_string($_REQUEST['username']);
    // $pass = $con->real_escape_string($_REQUEST['password']);
    $pass = $_REQUEST['password'];
    $pass = md5($pass);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
    $res = $con->query($sql);
    $user = $res->fetch_array();
    // $_SESSION['username']= $user['username'];
    $_SESSION['token'] = $user['token'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['level'] = $user['u_level'];
  }
  if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] == 1) {
      //admin
      $_SESSION['uname'] = "Admin";
      header('Location: ' . "admin/index.php");
    } else if ($_SESSION['level'] == 2) {
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM teachers WHERE user_id='$id'";
      $res = $con->query($sql);
      $name = $res->fetch_array()['name'];
      $_SESSION['uname'] = $name;
      header('Location: ' . "teacher/index.php");
      //teacher
    } else if ($_SESSION['level'] == 3) {
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM students WHERE user_id='$id'";
      $res = $con->query($sql);
      $name = $res->fetch_array()['name'];
      $_SESSION['uname'] = $name;
      header('Location: ' . "student/index.php");
      //student
    }
  }

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title></title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
          <h3>login</h3>

          <form action="login.php" method="post">
            <div class="form-group">User Name : </label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1"> password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="" name="password">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Password reminder
              </label>
            </div>
            <div class="form-group">
              <button type="submit" style="width: 100%;" class="btn btn-primary">Login</button>
            </div>
            <div class="form-group">
              <a href="register.php" style="width: 100%" class="btn btn-primary">Register</a>
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