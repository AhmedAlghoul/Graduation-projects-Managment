<?php
$page_title = "المشاريع";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    $sql = "SELECT * FROM projects";
    $res = $con->query($sql);
    $projects = $res->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

      <?php
      require "../../includes/nav.php";
      ?>

      <div class="container-fluid">
        <div class="container">
          <?php
          if (sizeof($projects) > 0) {
            ?>
            <h1 class="mt-4 text-center"> المشاريع</h1>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">العنوان</th>
                  <th scope="col">اللغة المستخدمة</th>

                  <th scope="col">الاعدادات</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($projects as $project) { ?>
                  <tr>
                    <th scope="row"><?php echo $project['id']; ?></th>
                    <td> <?php echo $project['name']; ?> </td>
                    <td> <?php echo $project['pr_type']; ?></td>

                    <td> <a href="delete_project.php?pid=<?php echo $project['id']; ?>" id="delete" class="delete-post-link"> <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <a href="updateProjects.php?pid=<?php echo $project['id']; ?>">
                        <i class="fa fa-edit" aria-hidden="true"></i></a>
                      <a href="<?php echo $_SERVER['HTTP_HOST'] . '/uploads/projects/' . $project['file_name']; ?>" download>
                    <i class="fa fa-download" aria-hidden="true"></i></a>
                      </td>
                        

                  </tr>
                <?php } ?>

              </tbody>
            </table>
            <a class="btn btn-primary" href="addProject.php">اضافة مشروع جديد</a>


          </div>
        <?php } else { ?>

          <h1 class="mt-4 text-center"> لا يوجد مشاريع</h1>
        <?php } ?>
      </div>
      <?php
      require "../../includes/c_footer.php";
    }
  } else {
    header('Location: ' . "../login.php");
  }
  ?>