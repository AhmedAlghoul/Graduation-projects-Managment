<?php
session_start();
require "classes/config.php";
if (isset($_REQUEST['test']) && isset($_REQUEST['id'])) {
    header('Content-Type: application/json');
    $_SESSION['level'] = $_REQUEST['test'];

    if (isset($_REQUEST['id'])) {
        $_SESSION['id'] = $_REQUEST['id'];
    }
    $_SESSION['token'] = "TESTING";
    $_SESSION['name'] = $_REQUEST['name'];
    echo "SET";
    echo "\n";
    echo json_encode($_SESSION, JSON_PRETTY_PRINT);
    header('Location: ' . "index.php");
} else {


    ?>
    <html>

    <head>
    </head>
    <?php
    function get($l)
    {
        if ($l == 1)
            return "admin";
        else if ($l == 2)
            return "teacher";
        else
            return "student";
    }
    $sql = "SELECT * FROM users";
    $users = $con->query($sql);
    $users = $users->fetch_all(MYSQLI_ASSOC);
    foreach ($users as $user) {
        ?>

        <a href="test.php?test=<?php echo $user['u_level'] . '&id=' . $user['id'] . '&name=tester'; ?>"> <?php echo $user['username']; ?> - <?php echo get($user['u_level']); ?> </a>
        <br>
    <?php
}
?>

    </html>
<?php } ?>