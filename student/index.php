<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
require "../includes/st_head.php";

if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  $level = $_SESSION['level'];
  if ($level != 3) {
    //wrong direction
    echo "NOT Authorized";
    header('Location: ' . "../index.php");
  }
  $sql = "SELECT * FROM advertising";
  $ads = $con->query($sql);
  $ads = $ads->fetch_all(MYSQLI_ASSOC);
  ?>
  <!-- Page Content -->
  <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

    <?php

    require "../includes/st_nav.php";
    ?>

    <div class="container-fluid">
      <div class="container">
        <h1 class="mt-4 text-center"> الاعلانات</h1>
        <div id="accordion">
          <?php
          foreach ($ads as $ad) { ?>
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link buttonCollapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $ad['title']; ?>
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <?php echo $ad['discreption']; ?>
                  <br>
                  <button type="submit" class="btn btn-primary" style="margin-top:7px;"><i class="fas fa-download" style="color:#fff!important;margin-right:2px;"></i>تحميل التفاصيل</button>

                </div>
              </div>
            </div>
          <?php
        }
        ?>
        </div>


      </div>
    </div>
    <?php
    require "../includes/c_footer.php";
  } else {
    header('Location: ' . "../index.php");
  }
  ?>