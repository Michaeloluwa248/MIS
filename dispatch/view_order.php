<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if($_POST['submit'])
{
    $status = $_POST['status'];

    $sql = "UPDATE user_payment SET status = '".$status."' WHERE invoiceno= '".$_GET["inv"]."' ";
    mysqli_query($db,$sql);

    $sql2 = "UPDATE users_orders SET status = '".$status."' WHERE invoiceno= '".$_GET["inv"]."' ";
    mysqli_query($db,$sql2);

    $success = '<div class="alert alert-success alert-dismissible fade show m-t-20">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong>Order Status has been Updated Successfully!</strong>
       </div>';

}


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>View Order</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
        var popUpWin=0;
        function popUpWindow(URLStr, left, top, width, height)
        {
           if(popUpWin)
           {
            if(!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+1000+',height='+1000+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
    }

</script>
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
                        	<?php  
				                echo $error;
				                echo $success; 
				            ?>
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">View Order</h4>
                                </div>
                                
                                <div class="table-responsive m-t-20">
                                    <table id="myTable" class="table table-bordered table-striped">
                                     
                                        <tbody>
                                         <?php
                                         $sql="SELECT users.*, users_orders.*, user_payment.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id INNER JOIN user_payment ON user_payment.invoiceno = users_orders.invoiceno WHERE user_payment.invoiceno='".$_GET['inv']."'";
                                         $query=mysqli_query($db,$sql);
                                         $rows=mysqli_fetch_array($query);
                                         
                                         ?>
                                         
                                         <tr>
                                            <td><strong>Username:</strong></td>
                                            <td><center><?php echo $rows['username']; ?></center></td>
                                            <td><strong>Full Name:</strong></td>
                                            <td><center><?php echo $rows['l_name'] . " " . $rows['f_name']; ?></center></td>										
                                        </tr>
                                        <tr>
                                            <td><strong>Phone No:</strong></td>
                                            <td><center><?php echo $rows['phone']; ?></center></td>
                                            <td><strong>Address:</strong></td>
                                            <td><center><?php echo $rows['address']; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align: center;font-weight: bold;">List of Purchased Items</td>
                                        </tr>
                                        <tr style="text-align: center;font-weight: bold;">
                                            <td>Title</td>
                                            <td>Quantity</td>
                                            <td>Price</td>
                                            <td>Sub Total</td>
                                        </tr>
                                        <?php
                                        $SQL = "SELECT * FROM users_orders WHERE invoiceno='".$_GET['inv']."'";
                                        $query = mysqli_query($db,$SQL);

                                        if($query > 0){
                                            while($rows1 = mysqli_fetch_array($query)){
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows1['title']; ?></td>
                                                    <td style="text-align: center;"><?php echo $rows1['quantity']; ?></td>
                                                    <td style="text-align: center;"><?php echo $rows1['price']; ?></td>
                                                    <td style="text-align: center;"><?php echo $rows1['quantity'] * $rows1['price']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><strong>Order Status:</strong></td>
                                            <td>
                                                <?php 
                                                $status=$rows['status'];
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
                                                <td><strong>Payment Status:</strong></td>
                                                <td>
                                                    <?php 
                                                    if($rows['payment_type'] == 'Payment on Delivery'){
                                                        echo '<button type="button" class="btn btn-info" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Payment on Delivery</button>';
                                                    }else{

                                                        $status = $rows['payment_status'];

                                                        if($status=="1")
                                                        {
                                                            ?>
                                                            <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Paid</button> 
                                                            <?php 
                                                        } 
                                                        ?>
                                                        <?php
                                                        if($status=="0")
                                                        {
                                                            ?>
                                                            <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Not Paid</button>
                                                            <?php 
                                                        } 
                                                    }
                                                    
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td colspan="3" ><h3 style="float: left;">€ <?php echo $rows['amount']; ?></h3></td>                                      
                                            </tr>
                                            <tr>
                                                <td>
                                                    <form method="POST">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Order Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="2">Picked Up</option>
                                                                    <option value="3">Delivered</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-actions">
                                                                <input type="submit" name="submit" class="btn btn-primary" value="Update Order Status">
                                                                <a href="all_orders.php" class="btn btn-inverse">Cancel</a>
                                                            </div>
                                                        </div>
                                                        
                                                    </form>
                                                </td> 
                                                <td colspan="3"></td>                                   
                                            </tr>											
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
<script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>