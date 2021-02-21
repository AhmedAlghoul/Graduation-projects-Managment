<?php

$hostName = $_SERVER['HTTP_HOST'];
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
$path = $protocol . '://' . $hostName . "/" . $base_folder;
require $_SERVER['DOCUMENT_ROOT'] . "/" . $base_folder . "/classes/config.php";
session_start();
?>
<!DOCTYPE html>
<html dir="rtl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> بوابة المشرف <?php echo $page_title; ?></title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="<?php echo $path; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="<?php echo $path; ?>/css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <style>
    .Sidebar_r {
      background-color: #563d7c !important;
      color: #fff;
      font-size: 20px;
    }

    h1 {
      color: #563d7c !important;

    }

    i {
      color: #563d7c !important;

    }

    .icon {
      color: #fff !important;
      /* margin-right: 5px; */
      margin-left: 10px;
    }

    #notifications {
      position: absolute;
      left: -263px;
    }

    .nt_un_read {
      background: #9c9c9c;
    }

    .nt_read {
      background: #f5f5f5;
    }
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right Sidebar_r" id="sidebar-wrapper">
      <div class="sidebar-heading">قائمة الموقع </div>
      <div class="list-group list-group-flush  Sidebar_r">
        <a href="<?php echo $path; ?>/admin/index.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fas fa-home icon"></i>الرئيسية</a>
        <a href="<?php echo $path; ?>/admin/Advertising/Advertising.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fas fa-ad icon"></i>الاعلانات</a>
        <a href="<?php echo $path; ?>/admin/forms/forms.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fab fa-wpforms icon"></i>النماذج</a>
        <a href="<?php echo $path; ?>/admin/projects/projects.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fas fa-project-diagram icon"></i>المشاريع</a>
        <a href="<?php echo $path; ?>/admin/Groups/Groups.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fas fa-user-friends icon"></i>المجموعات </a>
        <a href="<?php echo $path; ?>/admin/discussions/discussions.php" class="list-group-item list-group-item-action bg-light  Sidebar_r"><i class="fas fa-project-diagram icon"></i>المناقشات</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->