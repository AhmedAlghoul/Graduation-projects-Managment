<?php
$hostName = $_SERVER['HTTP_HOST']; 
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$path= $protocol.'://'.$hostName."/".$base_folder;
require $_SERVER['DOCUMENT_ROOT']."/".$base_folder."/classes/config.php";

session_start();

$id = $_SESSION['id'];
$pid = $_REQUEST['p_id'];

$sql = "SELECT teacher FROM projects WHERE id=$pid";
$res = $con->query($sql);
$teacher = $res->fetch_array()[0];
$teacher = json_decode($teacher);
if(sizeof($teacher)<2){
    unset($teacher[array_search($id,$teacher)]);
    $teacher = json_encode($teacher);
    $sql = "UPDATE projects SET teacher='$teacher' WHERE id=$pid";
    $con->query($sql);

}else{
    // already have teachers
}
header("Location: ".$path."/teacher/projects/projects.php");

?>