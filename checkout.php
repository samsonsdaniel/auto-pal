<?php include ("./includes/header.php"); ?>
<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    $new_file_name = $msg = "";

    $_POST['agree'] = 'false';
    $_POST['payment'] = '';

    if (isset($_POST['btnPayNow'])){
        $fn = $_POST['fn'];
        $ln = $_POST['ln'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $payment = $_POST['payment'];
        $agree = $_POST['agree'];
        $cId = $_SESSION['user_identity'];
        $txtTy = $_POST['txtTy'];

        $cSql = mysqli_query($conn, "SELECT * FROM users_data WHERE user_id = $cId");
        
        if(mysqli_num_rows($cSql) == 1){
            $cUpSql = mysqli_query($conn, "UPDATE users_data SET firstname='$fn', lastname='$ln',  mobile_phone='$mobile', `address`='$address' WHERE user_id = $cId");
            if($cUpSql){
                $cartItem = $_SESSION['cart'];
                if(isset($cartItem)){
                    $total = 0;
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) {
                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                        $proRow=mysqli_fetch_assoc($proSql);
                        $total = $total + ($proRow['product_price'] * $value['quantity']);
                    }

                }
                $insertOrder = "INSERT INTO orders (user_id, totalprice, orderStatus, paymentMode) VALUES ($cId, '$total', 'Order Placed', '$payment')";
            
                if(mysqli_query($conn, $insertOrder)){
                    
                    $orderid = mysqli_insert_id($conn);
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) {
                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                        $proRow=mysqli_fetch_assoc($proSql);
                        $total = $total + ($proRow['product_price'] * $value['quantity']);
                        $quantity = $value['quantity'];
                        $price = $proRow['product_price'];
                        $insertItemSql = "INSERT INTO orderTracking (orderid, productid, quantity, productprice) VALUES ('$orderid', '$key', '$quantity', '$price')";
                        if(mysqli_query($conn, $insertItemSql)){                                
                            // echo " inserted into bot table";
                            echo "<script> window.location.href = 'myaccount.php'</script>"; //Will take you to Google.
                            // unset($_SESSION['cart']);
                        }
                    }
                }else{
                    exit("ERROR: ".mysqli_error($conn));
                }
            }
        }else{        
            
            $sql = " INSERT INTO users_data (user_id, `firstname`, lastname, mobile_phone, user_type, `address`) VALUES ($cId, '$fn', '$ln', '$mobile', $txtTy, '$address')";

            if($result = mysqli_query ($conn, $sql)){
                $cartItem = $_SESSION['cart'];
                if(isset($cartItem)){
                    $total = 0;
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) {
                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                        $proRow=mysqli_fetch_assoc($proSql);
                        $total = $total + ($proRow['product_price'] * $value['quantity']);
                    }

                }
                $insertOrder = "INSERT INTO orders (user_id, totalprice, orderStatus, paymentMode) VALUES ($cId, '$total', 'Order Placed', '$payment')";
            
                if(mysqli_query($conn, $insertOrder)){
                    
                    $orderid = mysqli_insert_id($conn);
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) {
                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                        $proRow=mysqli_fetch_assoc($proSql);
                        $total = $total + ($proRow['product_price'] * $value['quantity']);
                        $quantity = $value['quantity'];
                        $price = $proRow['product_price'];
                        $insertItemSql = "INSERT INTO orderTracking (orderid, productid, quantity, productprice) VALUES ('$orderid', '$key', '$quantity', '$price')";
                        if(mysqli_query($conn, $insertItemSql)){                                
                            echo " inserted into bot table";
                            // echo "<script> window.location.href = 'myaccount.php'</script>"; //Will take you to Google.
                            // unset($_SESSION['cart']);
                        }
                    }
                }else{
                    exit("ERROR: ".mysqli_error($conn));
                }
            }
        }

    }
?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 offset-2">
                <?=$msg ?>
                <h2>Billing Details</h2>
                <form action="checkout.php" method="POST">
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="fn" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="ln" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Lasname</label>
                        <input type="text" class="form-control" name="mobile" id="">
                    </div>
                    <div class="form-group">
                        <?php

                            $tyQuery = mysqli_query($conn, "SELECT * FROM details WHERE user_id = $userId");
                            if(!$tyQuery){
                                echo "<pre>";
                                exit(print_r($tyQuery));
                                echo "</pre>";
                                exit("ERROR: ".mysqli_errno($conn));
                            }else{
                                while($tyrow=mysqli_fetch_assoc($tyQuery)){                                            
                        ?>
                                    <input type="hidden" name="txtTy" value="<?=$tyrow['car_type'] ?>" id="">
                        <?php
                                }
                            }

                        ?>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" id="">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Pay Now" class="btn btn-primary btn-block" name="btnPayNow" id="">
                    </div>                
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-2">

                <?php
                    $cart = $_SESSION['cart'];
                    $sn = $total = 0;
                    foreach ($cart as $key => $value) {
                        $cartSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                        while($cartRow=mysqli_fetch_assoc($cartSql)){
                            $sn++;
                ?>

                <?php
                            $total = $total + ($cartRow['product_price'] * $value['quantity']);
                        }

                    }
                ?>            

                <div>
                    <h6 class="section-secondary-title mt-5">Total :</h6>
                    <div><?=$total ?></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php include("includes/footer_page.php") ?>
