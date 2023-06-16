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


    <section class="popular">
                <div class="container">
                    <div class="title text-xs-center m-t-30 m-b-30">
                        <h2>Popular Dishes</h2>
                        <p class="lead">Easiest way to order your favourite food among these dishes</p>
                    </div>
                    <div class="row">
                    <?php           
                        
                      $query_res= mysqli_query($db,"SELECT * FROM dishes WHERE cat_id = '{$_GET['res_id']}' "); 
                        while($r=mysqli_fetch_array($query_res))
                        {

                            echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                            <div class="food-item-wrap">
                            <div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/'.$r['img'].'"></div>
                            <div class="content">
                            <h5><a href="dishes.php"></a></h5>
                            <div class="product-name" style="font-weight: bold;">'.$r['title'].'</div>
                            <div class="product-name">'.$r['slogan'].'</div>
                            <div class="price-btn-block"> <span class="price">€'.$r['price'].'</span> <a href="dishes.php?res_id='.$r['d_id'].'" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                            </div>

                            </div>
                            </div>';                                      
                        }

                    ?>
                </div>
            </div>
        </section>

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
