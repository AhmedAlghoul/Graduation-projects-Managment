<?php
$page_title = "النماذج";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    $sql = "SELECT * FROM forms";
    $forms = $con->query($sql);
    $forms = $forms->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">


      <?php
      require "../../includes/nav.php";
      ?>


      <div class="container-fluid">
        <div class="container">
          <?php
          if (sizeof($forms) > 0) {
            ?>
            <h1 class="mt-4 text-center"> النماذج</h1>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">الاسم</th>

                  <th scope="col">الاعدادات</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($forms as $form) {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $form['id']; ?></th>
                    <td> <?php echo $form['name']; ?> </td>

                    <td> <a href="delete_form.php?form=<?php echo $form['id']; ?>" class="delete-post-link"> <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <a href="updateForms.php?form=<?php echo $form['id']; ?>">
                        <i class="fa fa-edit" aria-hidden="true"></i></a>
                      <a href="<?php echo $uploads . 'forms/' . $form['file']; ?>" download>
                        <i class="fa fa-download" aria-hidden="true"></i></a>
                    </td>


                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <a class="btn btn-primary" href="addForms.php">إضافة نموذج جديد</a>


          </div>
        <?php } else { ?>
          <h1 class="mt-4 text-center"> لا يوجد نماذج</h1>
          <a class="btn btn-primary" href="addForms.php">إضافة نموذج جديد</a>
        <?php } ?>
      </div>
      <?php
      require "../../includes/c_footer.php";
    }
  } else {
    header('Location: ' . "../login.php");
  }
  ?>