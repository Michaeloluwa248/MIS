<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}

mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'");
header("location:all_orders.php");  

?>
