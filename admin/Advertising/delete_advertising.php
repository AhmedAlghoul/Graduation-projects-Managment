<?php
$hostName = $_SERVER['HTTP_HOST']; 
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$path= $protocol.'://'.$hostName."/".$base_folder;
require $_SERVER['DOCUMENT_ROOT']."/".$base_folder."/classes/config.php";

session_start();

$id = $_SESSION['id'];
$aid = $_REQUEST['aid'];
if($_SESSION['level'] ==1){
$sql = "DELETE FROM advertising WHERE id=$aid";
$con->query($sql);
}
header("Location: ".$path."/admin/Advertising/Advertising.php");

?>