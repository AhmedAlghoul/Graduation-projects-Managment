<?php
session_start();
require "classes/config.php";

if (
    isset($_POST['username']) &&
    isset($_POST['password'])
) {
    $username = $con->real_escape_string($_REQUEST['username']);
    // $pass = $con->real_escape_string($_REQUEST['password']);
    $pass = $_REQUEST['password'];
    $pass = md5($pass);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
    $res = $con->query($sql);

    if ($res->num_rows == 0) {
        $_SESSION['pro'] = "تأكد من بياناتك";
        header('Location: login.php');
    }

    $user = $res->fetch_array();
    // $_SESSION['username']= $user['username'];
    $_SESSION['token'] = $user['token'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['level'] = $user['u_level'];
    if (isset($_SESSION['level'])) {
        if ($_SESSION['level'] == 1) {
            //admin
            $_SESSION['uname'] = "المشرف";
            header('Location: ' . "admin/index.php");
        } else if ($_SESSION['level'] == 2) {
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM teachers WHERE user_id='$id'";
            $res = $con->query($sql);
            $name = $res->fetch_array()['name'];
            $_SESSION['uname'] = $name;
            header('Location: ' . "teacher/index.php");
            //teacher
        } else if ($_SESSION['level'] == 3) {
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM students WHERE user_id='$id'";
            $res = $con->query($sql);
            $name = $res->fetch_array()['name'];
            $_SESSION['uname'] = $name;
            header('Location: ' . "student/index.php");
            //student
        }
    }
} else {
    $_SESSION['pro'] = "يرجى تعبئة البيانات";
    header('Location: login.php');
}
