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
    if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['cpassword']))
    {
     $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>All Input Field Required!</strong>
     </div>';
 }if($_POST['password'] != $_POST['cpassword'])
    {
     $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>Both Password Do Not Match!</strong>
     </div>';
 }
 else
 {

   $check_username = mysqli_query($db, "SELECT username FROM admin WHERE username = '".$_POST['username']."' ");

   if(mysqli_num_rows($check_username) > 0)
   {
       $error = '<div class="alert alert-danger alert-dismissible fade show">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong>Username already exist!</strong>
       </div>';
   }
   else{

      $pass = md5($_POST['password']);

       $mql = "INSERT INTO admin (username,password,email,code) VALUES('".$_POST['username']."','".$pass."','".$_POST['email']."','dispatch')";
       mysqli_query($db, $mql);
       $success =   '<div class="alert alert-success alert-dismissible fade show">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       New User Added Successfully.</br></div>';

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
    <title>Add Users</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="fix-header">
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
         <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
     </div> -->
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
                        <h4 class="m-b-0 text-white">Add Users</h4>
                    </div>
                    <form action='' method='POST' >
                        <div class="form-body">

                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" name="email" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="password" name="cpassword" class="form-control" >
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                <a href="add_category.php" class="btn btn-inverse">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Listed Categories</h4>

                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Usertype</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                 <?php
                                 $sql = "SELECT * FROM admin WHERE adm_id != '".$_SESSION['adm_id'] ."' ";
                                 $query = mysqli_query($db,$sql);

                                 if(!mysqli_num_rows($query) > 0 )
                                 {
                                     echo '<td colspan="7"><center>No User Data!</center></td>';
                                 }
                                 else
                                 {              
                                   while($rows=mysqli_fetch_array($query))
                                   {

                                       echo ' <tr><td>'.$rows['username'].'</td>
                                       <td>'.$rows['email'].'</td>
                                       <td>'.$rows['code'].'</td>
                                       <td>'.$rows['date'].'</td>

                                       <td><a href="delete_admin.php?admin='.$rows['adm_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                       </td></tr>';
                                   }    
                               }
                               ?>
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

<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/bootstrap/js/popper.min.js"></script>
<script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>   
<script src="js/sidebarmenu.js"></script>  
<script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="js/custom.min.js"></script>

</body>

</html>