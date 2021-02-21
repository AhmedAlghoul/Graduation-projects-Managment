<?php
$page_title = "الاعلانات";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    if (isset($_REQUEST['title']) && isset($_FILES['file'])) {
      $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $base_folder . '/' . "uploads/advertising/";
      $title = $_REQUEST['title'];
      $disc = $_REQUEST['discreption'];
      $file = $_FILES['file']['name'];
      $sql = "INSERT INTO advertising(title,discreption,file) VALUES('$title','$disc','$file')";
      $con->query($sql);
      move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $file);
    }
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">
      <?php
      require "../../includes/nav.php";
      ?>
      <div class="container-fluid">
        <div class="container">
          <h1 class="mt-4 text-center">اضافة اعلان جديد</h1>
          <form style="width:70%;" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleInputEmail1"> العنوان</label>
              <input type="text" class="form-control" placeholder="العنوان" name="title">
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea2">المحتوى</label>
              <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="discreption"></textarea>
            </div>


            <div class="form-group">
              <label for="exampleFormControlFile1"> الملف</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
            </div>



            <button type="submit" class="btn btn-primary">اضافة</button>
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