<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert() { 
  

    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

    

    $invoiceno = "INV".date('Ymd').rand(1111, 9999999);

    foreach ($_SESSION["cart_item"] as $item)
    {

        $item_total += ($item["price"]*$item["quantity"]);

        if($_POST['submit'])
        {
            $checkout = $_POST['checkout'];

            if($checkout == "COD"){

                $SQL="INSERT INTO users_orders(u_id,invoiceno,title,quantity,price,status) VALUES('".$_SESSION["user_id"]."','".$invoiceno."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."','0')";

                mysqli_query($db,$SQL);

                $query_res= mysqli_query($db,"SELECT * FROM user_payment WHERE u_id='".$_SESSION['user_id']."' AND invoiceno = '".$invoiceno."' ");
                if(mysqli_num_rows($query_res) > 0 )
                {
                    $sql="UPDATE user_payment SET amount = '".$_SESSION['total_price']."' WHERE u_id= '".$_SESSION["user_id"]."' AND invoiceno = '".$invoiceno."'";

                    mysqli_query($db,$sql);

                    $success = '<div class="alert alert-success alert-dismissible fade show m-t-20">
					       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					       <strong>Thank you. Your order has been placed!</strong>
					       </div>'; 
					echo "<script>window.location.replace('your_orders.php');</script>";    
                }else{

                    $date = date('Y-m-d');

                    $sql="INSERT INTO user_payment(u_id,invoiceno,amount,status,payment_status,payment_type,date) VALUES('".$_SESSION["user_id"]."','".$invoiceno."','".$item_total."','0','0','Payment on Delivery','".$date."')";

                    mysqli_query($db,$sql);

                    $success = '<div class="alert alert-success alert-dismissible fade show m-t-20">
					       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					       <strong>Thank you. Your order has been placed!</strong>
					       </div>'; 
					echo "<script>window.location.replace('your_orders.php');</script>";
                }

                unset($_SESSION["cart_item"]);
                unset($item["title"]);
                unset($item["quantity"]);
                unset($item["price"]);

                
            }
            elseif ($checkout == "paystack") {
                function_alert();
            }
        }
    }

    
    ?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Checkout</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet"> </head>
        <body>
            
            <div class="site-wrapper">
                <header id="header" class="header-scroll top-header headrom">
                    <nav class="navbar navbar-dark">
                        <div class="container">
                            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                            <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                                <ul class="nav navbar-nav">
                                    <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                                    
                                    <?php
                                    if(empty($_SESSION["user_id"]))
                                    {
                                        echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                        <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                                    }
                                    else
                                    {
                                        echo  '<li class="nav-item"><a href="cart.php" class="nav-link active">Cart</a> </li>';
                                        echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                        echo '<li class="nav-item"><a href="feedback.php" class="nav-link active">Feedback</a> </li>';
                                        echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                                    }

                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
                <div class="page-wrapper">			
                    <div class="container">
                     
                        <span style="color:green;">
                            <?php echo $success; ?>
                        </span>
                        
                    </div>
                    
                    
                    
                    
                    <div class="container m-t-30">
                       <form action="" method="post">
                        <div class="widget clearfix">
                            
                            <div class="widget-body">
                                <form method="post" action="">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Cart Summary</h4> </div>
                                                    <div class="cart-totals-fields">
                                                      
                                                        <table class="table">
                                                           <tbody>
                                                              
                                                             
                                                              
                                                            <tr>
                                                                <td>Cart Subtotal</td>
                                                                <td> <?php echo "€".$item_total; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Delivery Charges</td>
                                                                <td>Free</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-color"><strong>Total</strong></td>
                                                                <td class="text-color"><strong> <?php echo "€".$item_total; ?></strong></td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                        
                                                        
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="payment-option">
                                                <ul class=" list-unstyled">
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-20">
                                                            <input name="checkout" id="radioStacked1" value="COD" type="radio" class="custom-control-input" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash on Delivery</span>
                                                        </label>
                                                    </li>
                                            <!-- <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="checkout"  type="radio" value="paystack" class="custom-control-input" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Paystack <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                                </li> -->
                                            </ul>
                                            <p class="text-xs-center"> <input type="submit" name="submit"  class="btn btn-success btn-block" value="Order Now"> </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
            
            <footer class="footer" style="background: black;">
              <div class="container">
                <div class="bottom-footer">
                  <div class="row">
                    <div class="col-xs-12 col-sm-4 address color-gray">
                      <h5>Address</h5>
                      <p>1086 London Rd, UK</p>
                      <h5>Phone: +000000000000</a></h5> </div>
                      <div class="col-xs-12 col-sm-5 additional-info color-gray">
                        <h5>Addition informations</h5>
                        <p>Join thousands of other customers who loves a good meal.</p>
                    </div>
                </div>
            </div>

        </div>
    </footer>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/foodpicky.min.js"></script>
</body>

</html>

<?php
}
?>
