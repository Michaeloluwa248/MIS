<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}

?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<title>All Orders</title>
	<link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="css/helper.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style type="text/css">
        * {
            margin: 0;
        }
        @media print {
            .btn-print {
                display:none !important;
            }
        }
    </style>

</head>

<body>
		
		
					
					<div class="row">
						<div class="col-12">
							
							
							<div class="col-lg-12">
								<div class="card card-outline-primary">
									<div class="card-header">
										<h4 class="m-b-0 text-white">Sales Report From <strong><?= $_GET['from'] ?></strong> - <strong><?= $_GET['to'] ?></strong></h4>
										<button type="submit" name="" class="btn btn-danger btn-print" onclick="window.print();">Print</button>
									</div>
									
									<div class="table-responsive m-t-40">
										<table id="myTable" class="table table-bordered table-striped">
											<thead class="thead-dark">
												<tr>
													<th>Invoice No</th>
													<th>Total</th>
													<th>Status</th>
													<th>Payment Status</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>


												<?php 

												$query_res= mysqli_query($db,"SELECT * FROM user_payment WHERE date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ");
												if(!mysqli_num_rows($query_res) > 0 )
												{
													echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
												}
												else
												{			      

													while($row=mysqli_fetch_array($query_res))
													{

														?>
														<tr>	
															<td data-column="Item"> <?php echo $row['invoiceno']; ?></td>
															<td data-column="price">€ <?php echo $row['amount']; ?></td>
															<td data-column="status"> 
																<?php 
																$status=$row['status'];
																if($status=="0" or $status=="NULL")
																{
																	?>
																	<button type="button" class="btn btn-warning"><span class="fa fa-bars"  aria-hidden="true" ></span> Pending</button>
																	<?php 
																}
																if($status=="1")
																	{ ?>
																		<button type="button" class="btn btn-info"><span class="fa fa-check-circle"  aria-hidden="true" ></span> Confirmed!</button>
																		<?php
																	}
																	if($status=="2")
																	{
																		?>
																		<button type="button" class="btn btn-primary" ><span  class="fa fa-cog fa-spin" aria-hidden="true"></span> Picked Up</button> 
																		<?php 
																	} 
																	if($status=="3")
																	{
																		?>
																		<button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button> 
																		<?php 
																	} 
																	?>
																	<?php
																	if($status=="4")
																	{
																		?>
																		<button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
																		<?php 
																	} 
																	?>
																</td>
																<td data-column="status"> 
																	<?php 
																	if($row['payment_type'] == 'Payment on Delivery'){
																		echo '<button type="button" class="btn btn-info" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Payment on Delivery</button>';
																	}else{

																		$payment_type = $row['payment_type'];

																		if($payment_type == "1")
																		{
																			?>
																			<button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Paid</button> 
																			<?php 
																		} 
																		?>
																		<?php
																		if($payment_type =="0")
																		{
																			?>
																			<button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Not Paid</button>
																			<?php 
																		} 
																	} 
																	?>
																</td>
																<td data-column="Date"> <?php echo $row['date']; ?></td>
															</tr>
														<?php }} ?>		
														<tr>
															<td colspan="3" class="h3 text-right">
																Total
															</td>
															<td colspan="2" class="h3">
																<?php 
							                                        $result = mysqli_query($db, "SELECT SUM(amount) AS value_sum FROM user_payment WHERE date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' "); 
							                                        $row = mysqli_fetch_assoc($result); 
							                                        $sum = $row['value_sum'];

							                                        if($sum > 0 || $sum != null){
							                                        	echo '€ ' .$sum;
							                                        }else {
							                                        	echo '€ 0';
							                                        }
							                                        
							                                        ?>
															</td>
														</tr>			
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
			
		
	
	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/bootstrap/js/popper.min.js"></script>
	<script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.slimscroll.js"></script>
	<script src="js/sidebarmenu.js"></script>
	<script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
	<script src="js/custom.min.js"></script>
	<script src="js/lib/datatables/datatables.min.js"></script>
	<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
	<script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	
</body>

</html>