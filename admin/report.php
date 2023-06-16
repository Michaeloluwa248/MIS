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


if(isset($_POST['submit'] ))
{
  #var_dump($_POST);exit();
  if(empty($_POST['from_date']) || empty($_POST['to_date']))
  {
   $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>All Input Field Required!</strong>
   </div>';
 }
 else
 {
  header('location: view_report.php?from='.$_POST['from_date'].'&to='.$_POST['to_date']);
  
}

}

elseif(isset($_POST['excel'] ))
{

  if(empty($_POST['from_date']) || empty($_POST['to_date']))
  {
   $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>All Input Field Required!</strong>
   </div>';
 }
 else
 {
  #header('location: report.php?from='.$_POST['from_date'].'&to='.$_POST['to_date']);

  if(isset($_GET['from']) AND isset($_GET['to'])){

    $html = '<table border="1"><tr><td>S/N</td><td>Invoice No</td><td>Total</td><td>Date</td></tr>';
    $query_res = mysqli_query($db,"SELECT * FROM user_payment WHERE date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ");
    if(mysqli_num_rows($query_res) > 0 )
    {
      $i = 1;
      while($row = mysqli_fetch_array($query_res)){
        $html.='<tr><td>'.$i++.'</td><td>'.$row['invoiceno'].'</td><td>'.$row['amount'].'</td><td>'.$row['date'].'</td></tr>';
      }
    }
    $html.='</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=report.xls');
    echo $html;

  }

  
}

}


?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">   
  <title>Reports</title>
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body class="fix-header">
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
        <div class="container-fluid">
         <div class="col-lg-12">
          <?php  
          echo $error;
          echo $success; 
          ?>
          <div class="card card-outline-primary">
            <div class="card-header">
              <h4 class="m-b-0 text-white">Report</h4>
            </div>
            <form action="report.php?from=<?= $_POST['from_date']; ?>&to=<?= $_POST['to_date']; ?>" method='POST' >
              <div class="form-body">

                <hr>
                <div class="row p-t-20">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">From</label>
                      <input type="date" name="from_date" class="form-control" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">To</label>
                      <input type="date" name="to_date" class="form-control" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">&nbsp;</label>
                      <input type="submit" name="submit" class="form-control btn btn-primary" value="Search"> 
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">&nbsp;</label>
                      <input type="submit" name="excel" onclick="return confirm('Download Report?');" class="form-control btn btn-danger" value="Export to Excel"> 
                    </div>
                  </div>
                </div>
              </form>
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

</body>

</html>