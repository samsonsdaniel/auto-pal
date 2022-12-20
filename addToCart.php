<?php
    session_start();
    if(isset($_GET['action'])){

        if(isset($_GET['quantity'])){
            $quantity = $_GET['quantity'];

        }else{
            $quantity = 1;
        }

        $cartId = $_GET['action'];        
        $_SESSION['cart'][$cartId] = array("quantity" => $quantity);

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