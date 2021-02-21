<?php
session_start();
// require "classes/config.php";

if (!(isset($_SESSION['uname']) && isset($_SESSION['token']))) {
    ?>

    <!DOCTYPE html>
    <html dir="rtl">

    <head>
        <title></title>
        <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <style type="text/css">
            h3 {
                margin-bottom: 4%
            }

            .classForm {
                margin-top: 5%;
                margin-left: 10%
            }

            .alert {
                padding: 20px;
                background-color: #f44336;
                color: white;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }

            @media only screen and (max-width: 600px) {
                .classImg {
                    display: none;
                }

                .classForm {
                    margin-right: 30%;
                }

                h3 {
                    margin-bottom: 10%;
                }
            }
        </style>
    </head>

    <body>
        <div class="row">
            <div class="col-md-6 classImg" style="height: 1100px">
                <img src="img/3.jpg" class="img-fluid" alt="Responsive image" style="height: 100%">
            </div>

            <div class=" col-md-4  col-sm-12">
                <div class="classForm">
                    <h3>تسجيل الحساب</h3>
                    <form id="myform" action="registerDB.php" method="post">

                        <?php
                        if (isset($_SESSION['pro'])) {
                            echo '<div class="alert">';
                            echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                            echo '' . $_SESSION['pro'] . '';
                            echo '</div>';
                            unset($_SESSION['pro']);
                        }
                        ?>

                        <div class="form-group">
                            <label for="type1">نوع الحساب </label><br>
                            <input id="type1" name="type" type="radio" class="" value="Student"> <label for="type1">طالب
                            </label><br>
                            <input id="type2" name="type" type="radio" class="" value="Teacher"> <label for="type2">معلم
                            </label><br>
                        </div>

                        <div class="form-group" id="u_id">
                            <label for="id"> الرقم الجامعي</label>
                            <input id="id" name="id" type="text" class="form-control" placeholder="الرقم الجامعي">
                        </div>

                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="الاسم">
                        </div>

                        <div class="form-group">
                            <label for="email">البريد الالكتروني</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="البريد الالكتروني">
                        </div>

                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input id="phone" name="phone" type="text" class="form-control" placeholder="رقم الهاتف">
                        </div>

                        <div class="form-group">
                            <label for="username">اسم المستخدم:</label>
                            <input id="username" name="username" type="text" class="form-control" placeholder="اسم المستخدم">
                        </div>

                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="كلمة المرور">
                        </div>

                        <div class="form-group">
                            <label for="password2">تأكيد كلمة المرور</label>
                            <input id="password2" name="password2" type="password" class="form-control" placeholder="تأكيد كلمة المرور">
                        </div>

                        <div id="std">
                            <div class="form-group">
                                <label for="specialization">التخصص</label>
                                <input id="specialization" name="specialization" type="text" class="form-control" placeholder="التخصص">
                            </div>
                            <div class="form-group">
                                <label for="level">المستوى</label>
                                <input id="level" name="level" type="text" class="form-control" placeholder="المستوى">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%">تسجيل</button>

                        <div class="form-group">
                            <a href="index.php" style="width: 100%;margin-top: 20px" class="btn btn-primary">الصفحة الرئيسية</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script>
            $('input[type=radio][name=type]').change(function() {
                if (this.value == 'Teacher') {
                    $("#std").fadeOut();
                    // $("#u_id").hide();
                } else if (this.value == 'Student') {
                    $("#std").fadeIn();
                    // $("#u_id").show();
                }
            });
        </script>

    </body>

    </html>
<?php
} else {

    if ($_SESSION['level'] == 1) {
        //admin
        header('Location: ' . "admin/index.php");
    } else if ($_SESSION['level'] == 2) {
        header('Location: ' . "teacher/index.php");
        //teacher
    } else if ($_SESSION['level'] == 3) {
        header('Location: ' . "student/index.php");
        //student
    }
}
?>