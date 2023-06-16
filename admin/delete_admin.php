<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}

mysqli_query($db,"DELETE FROM admin WHERE adm_id = '".$_GET['admin']."'");
header("location:all_users.php");  

?>
