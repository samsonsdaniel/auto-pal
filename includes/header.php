<?php
    session_start();
    

    // include("addToCart.php");
    if(!isset($_SESSION['TypeOfUser'])){
 
        header('location: index.php');
    }else{
    
    }

        // $cartId = 0;
        // $_SESSION['cart'][$cartId] = array();

    // $_SESSION['cart'][] = array('cart' => $cart);
    if(empty($cart = $_SESSION['cart'])){
        $count = "";
    }else{
        $count = count($cart);
    }
    include("db_connection.php");


    $usertype = $_SESSION['TypeOfUser'];

    if($usertype == 0){
        $edit = "<a href='admin/users.php?action>edit profile</a>
";
    }else{
        $edit = "<a href='admin/user_profile.php?action'>edit profile</a>
        ";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auto Pal</title>
        <link rel="stylesheet" href="./font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="./bs4/css/bootstrap.min.css">
        <link rel="stylesheet" type="./text/css" href="./css/style.css">
        <!-- <link rel="stylesheet" href="./vendors/simple-line-icons/css/simple-line-icons.css"> -->
        <!-- <link rel="stylesheet" href="./vendors/flag-icon-css/css/flag-icon.min.css"> -->
        <!-- <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css"> -->
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- <link rel="stylesheet" href="../vendors/daterangepicker/daterangepicker.css"> -->
        <!-- <link rel="stylesheet" href="../vendors/chartist/chartist.min.css"> -->

        <!-- <link rel="stylesheet" href="./cs/animate.css"> -->
        <!-- <link rel="stylesheet" href="./cs/owl.carousel.min.css"> -->
        <!-- <link rel="stylesheet" href="./cs/owl.theme.default.min.css"> -->
        <!-- <link rel="stylesheet" href="./cs/magnific-popup.css"> -->
        <!-- <link rel="stylesheet" href="./cs/ionicons.min.css"> -->
        <!-- <link rel="stylesheet" href="./cs/flaticon.css"> -->
        <!-- <link rel="stylesheet" href="./cs/icomoon.css"> -->
        <!-- <link rel="stylesheet" href="./cs/style.css"> -->

    </head>
    <body>

        <div class="container pt-5">
            <div class="row justify-content-between">
                <div class="col">
                    <a class="navbar-brand" href="home.php">Auto<span>Pal</span></a>
                </div>
                    <div class="col d-flex justify-content-end">
                        <div class="social-media">
                            <p class="mb-0 d-flex">
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                            </p>
                        </div>
                    </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">        
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a href="home.php" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>

                        <li class="nav-item"><a href="product.php" class="nav-link">Product</a></li>
                        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                        
                        <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa fa-shopping-cart"></i><span class="badge badge-danger"><?php echo $count; ?></span></a></li>

                        
                        <?php
                            if($_SESSION['user_identity']){
                        ?>
                            
                                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        $userId = $_SESSION['user_identity'];
                                        $userQuery = mysqli_query($conn, "SELECT * FROM users_data WHERE user_id = $userId");
                                        if(!$userQuery){
                                            exit("ERROR: ".mysqli_errno($conn));
                                        }else{
                                            while($userRow=mysqli_fetch_assoc($userQuery)){
                                                $userImg = $userRow['img'];
                        
                                    ?>
                                    <img class="img-xs rounded-circle ml-2" id="userImg" src="../<?=$userImg ?>" alt="<?=$_SESSION['user_email'] ?>">

                                    <?php
                                            }
                                        }
                                    ?>
                                </a>
                                <div  style="left: 40%" class="dropdown-menu navbar-dropdown" aria-labelledby="UserDropdown">
                                    <div class="dropdown-header text-center">
                                        <img class="img-md rounded-circle" src="../<?=$userImg ?>" alt="Profile image">
                                        <p class="mb-1 mt-3"><?=$_SESSION['user_email']; ?><span class="font-weight-normal"><?php //echo $_SESSION['user_lastname']; ?></span></p>
                                        <p class="font-weight-light text-muted mb-0"><?=$_SESSION['user_email']; ?></p>
                                    </div>
                                    <a class="dropdown-item" href="profile.php?action=<?php echo $_SESSION['user_identity'] ?>"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger"></span></a>
                                    <!-- <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
                                    <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
                                    <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a> -->
                                    <a href="logout.php" class="dropdown-item btn btn-danger"><i class="dropdown-item-icon icon-power text-primary"></i> LogOut</a>
                                </div>
                
                        <?php
                            }else{

                        ?>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="signup.php">Sign Up</a>
                                </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->

        <?php

// echo "<pre>";
// exit(print_r($_SESSION));
// echo "</pre>";


?>