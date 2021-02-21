<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom  Sidebar_r">
  
  <button class="btn btn-primary" id="menu-toggle" style="margin-left:15px;">القائمة</button>
  مرحبا : <?php echo $_SESSION['uname']; ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo $path; ?>/logout.php" style="color:#fff;"><i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>

</nav>