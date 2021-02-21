<?php
$DB = array(
    "Server" => "127.0.0.1",
    "User" => "root",
    "Pass" => "",
    "db_name" => "project"
    
);
$con = new mysqli($DB['Server'], $DB['User'],$DB['Pass'],$DB['db_name']) ;
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_set_charset($con,'utf8');
if($con->connect_error){
   die("connection failed");
}
$hostName = $_SERVER['HTTP_HOST']; 
$base_folder = "project";
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$path= $protocol.'://'.$hostName."/".$base_folder;
$uploads = $hostName.'/'.$base_folder.'/uploads' .'/';
?>
