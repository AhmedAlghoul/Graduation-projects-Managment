<?php
require "../../classes/config.php";

session_start();

$fid = $_REQUEST['form'];
if($_SESSION['level'] ==1){
$sql = "DELETE FROM forms WHERE id=$fid";
$con->query($sql);
}
header("Location: ".$path."/admin/forms/forms.php");

?>