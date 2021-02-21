<?php
$page_title = "Discussion";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    // $projects = $projects->fetch_all(MYSQLI_ASSOC);
    $sql = "SELECT * from discussions";
    $discussions = $con->query($sql);
    $discussions = $discussions->fetch_all(MYSQLI_ASSOC);

    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

      <?php
      require "../../includes/nav.php";
      ?>
      <div class="container-fluid">
        <div class="container">
          <?php 
            if(sizeof($discussions)>0){
          ?>
          <h1 class="mt-4 text-center"> المناقشات</h1>
          <a class="btn btn-primary" href="#" style="margin-bottom:5px;"> تصدير ملف اكسل</a>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم المشروع</th>
                <th scope="col"> المناقش</th>
                <th scope="col"> التاريخ</th>
                <th scope="col"> الوقت</th>
                <th scope="col"> المكان</th>
                <th scope="col"> المدة</th>

                <th scope="col">إعدادات</th>

              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($discussions as $dis) {
                $did = $dis['id'];
                $sql = "SELECT * FROM projects WHERE discussion=$did";
                $project = $con->query($sql);
                $project = $project->fetch_array();
                ?>
                <tr>
                  <th scope="row"><?php echo $dis['id']; ?></th>
                  <td> <?php echo $project['name']; ?></td>
                  <td> 
                  <?php
                  $tid = $project['teacher'];
                  $t = $project['teacher'];
                  $t = json_decode($t);
                  if(sizeof($t)>0){
                  foreach ($t as $i) {
                    $sql = "SELECT name FROM teachers WHERE user_id=$i";
                    $name = $con->query($sql);
                    $name = $name->fetch_array()['name'];
                    echo $name . '<br>';
                  }
                }else{
                  echo 'لم يحدد أي مناقش بعد';
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
                  <td> <?php echo $dis['duration']; ?> </td>

                  <td> <a href="delete_discussion.php?did=<?php echo $dis['id']; ?>" class="delete-post-link"> <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>

                    <a href="updateDiscussions.php?did=<?php echo $dis['id']; ?>">
                      <i class="fa fa-edit" aria-hidden="true"></i></a></td>


                </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
          <a class="btn btn-primary" href="addDiscussions.php">إضافة</a>
         <!-- <a class="btn btn-primary" href="#"> استيراد ملف اكسل </a>-->


        </div>
          <?php }else{ ?>
            <h1 class="mt-4 text-center"> لا توجد مناقشات</h1>
          
          <?php }?>
      </div>
      <?php


      require "../../includes/c_footer.php";
    }
  } else {
    header('Location: ' . "../login.php");
  }
  ?>