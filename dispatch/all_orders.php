<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

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
	

</head>

<body class="fix-header fix-sidebar">
	
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
		</div>
		
		<div id="main-wrapper">
			
			<div class="header">
				<?php include('include/header.php'); ?>
			</div>
			
			<div class="left-sidebar">
				
				<div class="scroll-sidebar">
					<?php include('include/sidebar.php'); ?>
				</div>
				
			</div>
			
			<div class="page-wrapper">
				
				
				
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-12">
							
							
							<div class="col-lg-12">
								<div class="card card-outline-primary">
									<div class="card-header">
										<h4 class="m-b-0 text-white">All Orders</h4>
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
													<th>Action</th>
												</tr>
											</thead>
											<tbody>


												<?php 

												$query_res= mysqli_query($db,"SELECT * FROM user_payment WHERE status = 1 OR status = 2");
												if(!mysqli_num_rows($query_res) > 0 )
												{
													echo '<td colspan="6"><center>You have No You have No Orders To Pick. </center></td>';
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
																<td data-column="Action"> 
																	<a href="view_order.php?inv=<?php echo $row['invoiceno'];?>" target="_blank" class="btn btn-info btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-eye" style="font-size:16px"></i></a> 
																</td>
															</tr>
														<?php }} ?>					
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
							</div>
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