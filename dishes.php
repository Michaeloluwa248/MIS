<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Dishes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> </head>

    <body>
        
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark" style="background: black;">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav text-dark">
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
                            echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                            echo '<li class="nav-item"><a href="feedback.php" class="nav-link active">Feedback</a> </li>';
                        }

                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<div class="page-wrapper">

            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        
                         <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Your Cart
                              </h3>
                                              
                              
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
                                    
                                    
    <?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  
{
?>                                  
                                    
                                        <div class="title-row">
                                        <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
                                        <i class="fa fa-trash pull-right"></i></a>
                                        </div>
                                        
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                 <input type="text" class="form-control b-r-0" value=<?php echo "€".$item["price"]; ?> readonly id="exampleSelect1">
                                                   
                                            </div>
                                            <div class="col-xs-4">
                                               <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        
                                      </div>
                                      
    <?php
$item_total += ($item["price"]*$item["quantity"]); 
}
?>                                
                                      
                                      
                                      
                                    </div>
                                </div>
                               
                         
                             
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong>
                                        <?php 
                                            echo "€".$item_total;
                                            $_SESSION['total_price'] = $item_total;
                                         ?></strong></h3>
                                        <!-- <p>Free Delivery!</p> -->
                                        <?php
                                        if($item_total==0){
                                        ?>

                                        
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-danger btn-lg disabled">Checkout</a>

                                        <?php
                                        }
                                        else{   
                                        ?>
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-success btn-lg active m-b-20">Checkout</a>
                                        <?php   
                                        }
                                        ?>
                                        <a href="index.php"  class="btn btn-info btn-lg">Continue Ordering</a>
                                    </div>
                                </div>
                                
                        
                                
                                
                            </div>
                    </div>

                    <div class="col-md-8">
                      
             
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
                        <?php  
                                    $stmt = $db->prepare("select * from dishes where d_id='$_GET[res_id]'");
                                    $stmt->execute();
                                    $products = $stmt->get_result();
                                    if (!empty($products)) 
                                    {
                                    foreach($products as $product)
                                        {
                        
                                                    
                                                     
                                                     ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                <p> <?php echo $product['slogan']; ?></p>
                                            </div>
                           
                                        </div>
                               
                                        <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info"> 
                                        <span class="price pull-left" >€<?php echo $product['price']; ?></span>
                                          <input class="b-r-0" type="text" name="quantity"  style="margin-left:30px;" value="1" size="2" />
                                          <input type="submit" class="btn theme-btn mt-2" style="margin-left:40px;" value="Add To Cart" />
                                        </div>
                                        </form>
                                    </div>
              
                                </div>
                
                                
                                <?php
                                      }
                                    }
                                    
                                ?>
                                
                                
                              
                            </div>
             
                        </div>
            
                       
                    </div>
                    
                </div>
     
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
