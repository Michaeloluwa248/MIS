<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  
#error_reporting(0);  
session_start(); 


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">

    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> </a>
                <p class="text-white h6"> Welcome, 
                <?php
                    if(isset($_SESSION["user_id"])){
                        echo $_SESSION["fname"]; 
                    }
                ?>
                </p>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>


                        <?php
						if(empty($_SESSION["user_id"])) // if user is not login
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

<section class="hero bg-image" data-image-src="images/img/pimg.jpg">
    <div class="hero-inner">
        <div class="container text-center hero-text font-white">
            <h1>Welcome to <br>Steakz Restaurant</h1>

            <div class="banner-form">
                <form class="form-inline">

                </form>
            </div>
            <div class="steps">
                <div class="step-item step1">
                    <i class="fa fa-cutlery fa-3x"></i>
                    <h4><span style="color:white;">1. </span>Order Food</h4> </div>

                    <div class="step-item step2">
                        <i class="fa fa-money fa-3x"></i>
                        <h4><span style="color:white;">2. </span>Make Payment</h4> </div>

                        <div class="step-item step3">
                            <i class="fa fa-bus fa-3x"></i>
                            <h4><span style="color:white;">3. </span>Delivery</h4> </div>

                        </div>

                    </div>
                </div>

            </section>

            <section class="popular">
                <div class="container">
                    <div class="title text-xs-center m-b-30">
                        <h2>Popular Dishes</h2>
                        <p class="lead">Easiest way to order your favourite food among these dishes</p>
                    </div>
                    <div class="row">
                      <?php 					
                      if(!isset($_SESSION["user_id"])){
                         $query_res= mysqli_query($db,"SELECT * FROM dishes ORDER BY RAND() LIMIT 6");  
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
                    }else{

                        $query_res= mysqli_query($db,"SELECT * FROM dishes ORDER BY RAND() "); 
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
                    }	
                    ?>
                </div>
            </div>
        </section>

        <section class="how-it-works">
            <div class="container">
                <div class="text-xs-center">
                    <h2>Easy to Order</h2>
                    <div class="row how-it-works-solution">
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col1">
                            <div class="how-it-works-wrap">
                                <div class="step step-1">
                                    <div class="icon" data-step="1">
                                        <i class="fa fa-cutlery fa-3x"></i>
                                    </div>
                                    <h3>Choose a food</h3>
                                    <p>We"ve got you covered with menus from a variety of foods available.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col2">
                            <div class="step step-2">
                                <div class="icon" data-step="2">
                                    <i class="fa fa-money fa-3x"></i>
                                </div>
                                <h3>Make Payment</h3>
                                <p>You can pay on delivery or pay with your card.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col3">
                            <div class="step step-3">
                                <div class="icon" data-step="3">
                                   <i class="fa fa-cutlery fa-3x"></i>
                               </div>
                               <h3>Pick up or Delivery</h3>
                               <p>Get your food delivered! And enjoy your meal! </p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <section class="featured-restaurants">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title-block pull-left">
                        <h4>Categories</h4> </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="restaurants-filter pull-right">
                            <nav class="primary pull-left">
                                <ul>
                                    <li><a href="#" class="selected" data-filter="*">all</a> </li>
                                    <?php 
                                    $res= mysqli_query($db,"SELECT * FROM res_category");
                                    while($row=mysqli_fetch_array($res))
                                    {
                                       echo '<li><a href="#" data-filter=".'.$row['c_name'].'"> '.$row['c_name'].'</a> </li>';
                                   }
                                   ?>

                               </ul>
                           </nav>
                       </div>

                   </div>
               </div>

               <div class="row">
                <div class="restaurant-listing">


                  <?php  
                  $ress= mysqli_query($db,"SELECT * FROM dishes");  
                  while($rows=mysqli_fetch_array($ress))
                  {

                     $query= mysqli_query($db,"SELECT * FROM res_category WHERE c_id='".$rows['cat_id']."' ");
                     $rowss=mysqli_fetch_array($query);

                     echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all '.$rowss['c_name'].'">
                     <div class="restaurant-wrap">
                     <div class="row">
                     <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                     <a class="restaurant-logo" href="view_category.php?res_id='.$rows['cat_id'].'" > <img src="admin/Res_img/dishes/'.$rows['img'].'" alt="Food Image" height="150" width="150"> 
                     </a>
                     </div>

                     <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                     <h5><a href="view_category.php?res_id='.$rows['cat_id'].'" >'.$rows['title'].'</a>
                     </h5> <span>'.$rows['slogan'].'</span>
                     </div>

                     </div>

                     </div>

                     </div>';
                 }
                 ?>
             </div>
         </div>


     </div>
 </section>


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