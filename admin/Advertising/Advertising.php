<?php
$page_title = "Advertising";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    $sql = "SELECT * FROM advertising";
    $ads = $con->query($sql);
    $ads = $ads->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">
      <?php
      require "../../includes/nav.php";
      ?>
      <div class="container-fluid">
        <div class="container">
          <?php 
            if(sizeof($ads)>0){
          ?>
          <h1 class="mt-4 text-center"> الاعلانات</h1>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">العنوان</th>
                <th scope="col">الاعدادات</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ads as $ad) { ?>
                <tr>
                  <th scope="row"><?php echo $ad['id']; ?></th>
                  <td> <?php echo $ad['title']; ?> </td>
                  <td> <a href="delete_advertising.php?aid=<?php echo $ad['id']; ?>" class="delete-post-link"> <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    <a href="updateAdvertising.php?aid=<?php echo $ad['id']; ?>">
                      <i class="fa fa-edit" aria-hidden="true"></i></a>
                      <a href="<?php echo $base_folder.'/uploads/advertising/'.$ad['file']; ?>" download>
                      <i class="fa fa-download" aria-hidden="true"></i></a>
                    </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <a class="btn btn-primary" href="addAdvertising.php">اضافة اعلان جديد</a>
        </div>
              <?php }else{?>
                
          <h1 class="mt-4 text-center"> لا يوجد إعلانات</h1>
              <?php }?>
      </div>
      <?php
      require "../../includes/c_footer.php";
    }
  } else {
    header('Location: ' . "../login.php");
  }
  ?>