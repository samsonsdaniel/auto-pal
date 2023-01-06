<?php
    session_start();
    include("./includes/db_connection.php");
include("./includes/functions.php");

    if(isset($_GET['action'])){

        if(isset($_GET['quantity'])){
            $quantity = $_GET['quantity'];

        }else{
            $quantity = 1;
        }

        $cartId = $_GET['action'];        
        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $cartId");
            $proRow=mysqli_fetch_assoc($proSql);
            $vId = $proRow['user_id'];

        $sSql = mysqli_query($conn, "SELECT * FROM admin_user WHERE id = $vId");
        $sRow = mysqli_fetch_assoc($sSql);
        $v = $sRow['email'];
        // echo "<pre>";
        // exit(print_r($sRow));
        // echo "<pre>";
            
        $_SESSION['cart'][$cartId] = array("quantity" => $quantity, 'email' => $v);

            

        echo "<script> window.location.href = 'cart.php'</script>"; //Will take you to Google.
        // echo "<pre>";
        // exit(print_r($_SESSION));
        // echo "<pre>";

    }

    if(isset($_GET['deleteCart'])){
        $cart = $_GET['deleteCart'];
        unset($_SESSION['cart'][$cart]);
        header("location: cart.php");
    }
?>