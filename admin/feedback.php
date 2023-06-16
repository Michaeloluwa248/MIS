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
	<title>Feedback</title>
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
										<h4 class="m-b-0 text-white">All Feedback</h4>
									</div>
									
									<div class="table-responsive m-t-40">
										<table id="myTable" class="table table-bordered table-striped">
											<thead class="thead-dark">
												<tr>
													<th>S/N</th>
													<th>Name</th>
													<th>Email</th>
													<th>Title</th>
													<th>Message</th>
												</tr>
											</thead>
											<tbody>


												<?php 

												$query_res= mysqli_query($db,"SELECT * FROM feedback AS f INNER JOIN users AS u ON f.u_id = u.u_id");
												if(!mysqli_num_rows($query_res) > 0 )
												{
													echo '<td colspan="6"><center>No Feedback Available. </center></td>';
												}
												else
												{			      
													$i = 1;
													while($row=mysqli_fetch_array($query_res))
													{

														?>
														<tr>	
															<td data-column="Item"> <?php echo $i++; ?></td>
															<td data-column="price"> <?php echo $row['l_name'] . " " . $row['f_name']; ?></td>
															<td data-column="price"> <?php echo $row['email']; ?></td>
															<td data-column="price"> <?php echo $row['title']; ?></td>
															<td data-column="price" style="text-align: center;"><small><?php echo $row['message']; ?></small></td>
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