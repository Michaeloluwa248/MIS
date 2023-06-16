<?php
	include("connection/connect.php"); //connection to db
	error_reporting(0);
	session_start();

	if(isset($_GET['order_del'])){

		// sending query
		mysqli_query($db,"DELETE FROM users_orders WHERE invoiceno = '".$_GET['order_del']."'");
		mysqli_query($db,"DELETE FROM user_payment WHERE invoiceno = '".$_GET['order_del']."'"); 
		header("location: your_orders.php"); 
	}elseif(isset($_GET['remove_item'])){

		// sending query
		mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['remove_item']."'");
		header("location: order.php"); 
	}

	

?>
