<?php
$hostName = $_SERVER['HTTP_HOST']; 
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$path= $protocol.'://'.$hostName."/".$base_folder;
require $_SERVER['DOCUMENT_ROOT']."/".$base_folder."/classes/config.php";

session_start();

$did = $_REQUEST['did'];
if($_SESSION['level'] ==1){
$sql = "DELETE FROM discussions WHERE id=$did";
$con->query($sql);
}
header("Location: ".$path."/admin/discussions/discussions.php");

?>