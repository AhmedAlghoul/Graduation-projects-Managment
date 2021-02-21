<?php
$hostName = $_SERVER['HTTP_HOST'];
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
$path = $protocol . '://' . $hostName . "/" . $base_folder;
$page_title = "المشاريع";
$dir = $_SERVER['DOCUMENT_ROOT'] . "/" . $base_folder;
require $dir . "/includes/te_head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 2) {
    $sql = "SELECT * FROM projects";
    $res = $con->query($sql);
    $projects = $res->fetch_all(MYSQLI_ASSOC);
    $id = $_SESSION['id'];
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


      <?php
      require $dir . "/includes/te_nav.php";
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
                  <th scope="col">لغة البرمجة المستخدمة</th>

                  <th scope="col">الاعدادات</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($projects as $project) {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $project['id']; ?></th>
                    <td> <?php echo $project['name']; ?> </td>
                    <td> <?php echo $project['pr_type']; ?></td>

                    <td>
                    <a href="<?php echo $base_folder . '/uploads/projects/' . $project['file_name']; ?>" download>
                    <i class="fa fa-download" aria-hidden="true"></i></a>
                      <?php
                      $teacher = json_decode($project['teacher']);

                      if (sizeof($teacher) < 2 && array_search($id, $teacher) === FALSE) {

                        ?>
                        <a href="add_teacher.php?p_id=<?php echo $project['id']; ?>" style="color:#222;"> <i class="fa fa-plus-circle"></i></i></a>
                      <?php } else {
                      ?>

                        <a href="delete_teacher.php?p_id=<?php echo $project['id']; ?>">
                          <i class="fa fa-minus-circle"></i></i></a></td>
                    <?php  }
                  ?>

                  </tr>
                <?php
              }
              ?>

              </tbody>
            </table>



          </div>
        <?php } else { ?>
          <h1 class="mt-4 text-center"> لا يوجد مشاريع</h1>

        <?php } ?>
      </div>
    <?php
  } else {
    //cant do this
  }
  require $dir . "/includes/c_footer.php";
} else {
  header('Location: ' . "../login.php");
}
?>