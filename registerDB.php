<?php
session_start();
require "classes/config.php";

if (
    isset($_POST['id']) &&
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['type']) &&
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['phone'])
) {

    $username = $con->real_escape_string($_REQUEST['username']);
    $pass = $con->real_escape_string($_REQUEST['password']);
    $type = $con->real_escape_string($_REQUEST['type']);
    $name = $con->real_escape_string($_REQUEST['name']);
    $email = $con->real_escape_string($_REQUEST['email']);
    $phone = $con->real_escape_string($_REQUEST['phone']);

    $sql = "SELECT id FROM users WHERE username='$username'";
    $dup = $con->query($sql);
    if ($dup->num_rows == 0) {
        if ($type == "Student") {
            //student registeration
            $pass = md5($pass);
            $token = md5($username . $name . $pass);
            $sql = "INSERT INTO users(username,password,u_level,token,email,phone) VALUES('$username','$pass',3,'$token','$email','$phone')";
            $con->query($sql);
            $sql = "SELECT id FROM users WHERE username='$username'";
            $id = $con->query($sql);
            $id = $id->fetch_array()[0];
            $spec = $con->real_escape_string($_REQUEST['specialization']);
            $st_id = $con->real_escape_string($_REQUEST['id']);
            $level = $con->real_escape_string($_REQUEST['level']);
            $sql = "INSERT INTO students(name,user_id,spec,st_id,level) VALUES('$name','$id','$spec','$st_id','$level')";
            $con->query($sql);
        } else {
            //teacher regesteration
            $pass = md5($pass);
            $token = md5($username . $name . $pass);
            $sql = "INSERT INTO users(username,password,u_level,token,email,phone) VALUES('$username','$pass',2,'$token','$email','$phone')";
            $con->query($sql);
            $sql = "SELECT id FROM users WHERE username='$username'";
            $id = $con->query($sql);
            $id = $id->fetch_array()[0];
            $te_id = $con->real_escape_string($_REQUEST['id']);
            $sql = "INSERT INTO teachers(user_id,te_id,name) VALUES('$id','$te_id','$name')";
            $con->query($sql);
        }

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
        $res = $con->query($sql);
        $user = $res->fetch_array();
        // $_SESSION['username']= $user['username'];
        $_SESSION['token'] = $user['token'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['level'] = $user['u_level'];
        header('Location: login.php');
    } else {
        //already registered;
        $_SESSION['pro'] = "اسم المستخدم مستعمل";
        header('Location: register.php');
    }
} else {
    $_SESSION['pro'] = "الرجاء تعبئة بياناتك";
    header('Location: register.php');
}
