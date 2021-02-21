<?php
$page_title = "Projects";
require "../includes/st_head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  $sql = "SELECT * FROM forms";
  $forms = $con->query($sql);
  $forms = $forms->fetch_all(MYSQLI_ASSOC);
  ?>
  <!-- Page Content -->
  <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


    <?php
    require "../includes/st_nav.php";
    ?>

    <div class="container-fluid">
      <div class="container">
        <h1 class="mt-4 text-center"> النماذج</h1>
        <div id="accordion">
          <?php
          foreach ($forms as $form) {
            ?>
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link buttonCollapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo $form['name']; ?>
                  <a href="<?php echo $uploads . 'forms/' . $form['file']; ?>" download>
                    <i class="fa fa-download" aria-hidden="true"></i></a>
                  <button type="submit" class="btn btn-primary" style="margin-top:7px;"><i class="fas fa-download" style="color:#fff!important;margin-right:2px;"></i>Download</button>

                </button>
              </h5>
            </div>
          <?php } ?>

          <!-- <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link buttonCollapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  application form
                  <button type="submit" class="btn btn-primary" style="margin-top:7px;"><i class="fas fa-download" style="color:#fff!important;margin-right:2px;"></i>Download</button>

                </button>
              </h5>
            </div>

            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link buttonCollapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  application form
                  <button type="submit" class="btn btn-primary" style="margin-top:7px;"><i class="fas fa-download" style="color:#fff!important;margin-right:2px;"></i>Download</button>
                </button>
              </h5>
            </div> -->




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
      header('Location: ' . "../index.php");
    }
    ?>