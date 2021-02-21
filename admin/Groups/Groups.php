<?php
$page_title = "المجموعات";
require "../../includes/head.php";
if ((isset($_SESSION['uname']) && isset($_SESSION['token']))) {
  if ($_SESSION['level'] == 1) {
    $sql = "SELECT * FROM projects";
    $projects = $con->query($sql);
    $projects = $projects->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

      <?php
      require "../../includes/nav.php";
      ?>
      <div class="container-fluid">
        <div class="container">
          <h1 class="mt-4 text-center"> المجموعات</h1>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم المشروع</th>
                <th scope="col">أسماء المناقشين</th>
                <th scope="col"> عدد الطلاب</th>
                <th scope="col">أسماء الطلاب </th>


              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($projects as $project) {
                $pid = $project['id'];
                $sql = "SELECT * FROM students WHERE project_id=$pid";
                $stu = $con->query($sql);
                $students = $stu->fetch_all(MYSQLI_ASSOC);

                ?>
                <tr>
                  <th scope="row"><?php echo $project['id']; ?></th>
                  <td> <?php echo $project['name']; ?> </td>
                  <td> <?php
                        $t = $project['teacher'];
                        $t = json_decode($t);
                        foreach($t as $i){
                          $sql = "SELECT name FROM teachers WHERE user_id=$i";
                          $name = $con->query($sql);
                          $name= $name->fetch_array()['name'];
                          echo $name.'<br>';
                        }
                        
                        // $t = $con->query($sql);
                        // $result = mysqli_query($con, $sql);
                        // while ($name = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        //   echo $name;
                        // }
                        // if ($t->num_rows > 0) {
                        //   $teacher = $t->fetch_array();
                        //   echo $teacher;
                        // } else {
                        //   echo "Not yet";
                        // }
                        ?> </td>
                  <td> <?php echo $stu->num_rows; ?> </td>
                  <td>
                    <ul>
                      <?php foreach ($students as $st) { ?>
                        <li><?php echo $st['name']; ?></li>
                      <?php } ?>
                    </ul>
                  </td>

                </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
<!--          <a class="btn btn-primary" href="addGroups.html">إضافة مجموعة جديدة </a>
          -->

        </div>
      </div>
      <?php
      require "../../includes/c_footer.php";
    }
  } else {
    header('Location: ' . "../login.php");
  }
  ?>