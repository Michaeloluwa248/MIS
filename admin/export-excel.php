<?php
	include("../connection/connect.php");

	$html = '<table border="1"><tr><td>S/N</td><td>Invoice No</td><td>Total</td><td>Status</td><td>Payment Status</td><td>Date</td></tr>';
	$query_res = mysqli_query($db,"SELECT * FROM user_payment WHERE date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ");
	if(mysqli_num_rows($query_res) > 0 )
	{
		$i = 0;
		while($row = mysqli_fetch_array($query_res)){
			$html.='<tr><td>'.$i++.'</td><td>'.$row['invoiceno'].'</td><td>'.$row['amount'].'</td><td>'.$row['status'].'</td><td>'.$row['payment_status'].'</td><td>'.$row['date'].'</td></tr>';
		}
	}
	$html.='</table>';
	header('Content-Type:application/xls');
	header('Content-Disposition:attachment;filename=report.xls');
	echo $html;

	header('location: report.php');
?>