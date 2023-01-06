<?php

session_start();
include("./includes/db_connection.php");
include("./includes/functions.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

//Create an instance; passing `true` enables exceptions


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
    $label = $_POST['vendor_label'];
    $cId = $_SESSION['user_identity'];
    $txtTy = $_POST['txtTy'];

        // echo "<pre>";
        // exit(print_r($_POST));
        // echo "<pre>";



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
            $insertOrder = "INSERT INTO orders (user_id, totalprice, orderStatus, paymentMode, vendor_label) VALUES ($cId, '$total', 'Order Placed', '$payment', '$label')";
        
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

                        $mail = new PHPMailer(true); 
                        $cId= $_SESSION['user_identity'];
                        $cSql = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $cId");
                        if(mysqli_num_rows($cSql) > 0){
                            while($row=mysqli_fetch_assoc($cSql)){
                                $oId = $row['id'];
                                $cSql = mysqli_query($conn, "SELECT * FROM orderTracking WHERE orderid = $oId");
                                if(mysqli_num_rows($cSql) > 0){
                                    while($trow=mysqli_fetch_assoc($cSql)){
                                        $pId = $trow['productid'];
                                        $proQty = $trow['quantity'];
                                        $proPrice = $trow['productprice'];
                                        $proTotal = $trow['quantity'] * $trow['productprice'];
                                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $pId ");
                                        $prow = mysqli_fetch_assoc($proSql);
                                        $proName = $prow['product_name'];                                
                                        
                                    }
                                }
                                $message = "An order has been placed!";
        
                                $detaols = '<table style="text-align:center;">';
                                
                                $detaols1 = '<tr><th>Total Price</th><th>Order Status</th> <th>Payment Mode</th><th>Time</th></tr>';
                                $detaols2 = '<tr><td>'.$row['totalPrice'].'</td><td>'.$row['orderStatus'].'</td><td>'.$row['paymentMode'].'</td><td>'.$row['create_at'].'</td>></tr>';
                                $detaols3 = '<tr><th>Product</th><th>Quantity</th> <th>Price</th><th>Total Price</th></tr>';
                                $detaols4 = '<tr><td>'.$proName.'</td><td>'.$proQty.'</td><td>'.$proPrice.'</td><td>'.$proTotal.'</td></tr>';
                                $detaols5 = '</table>';
                                
                            }
                        
                        }
                        
                        $cart = $_SESSION['cart'];
                        foreach ($cart as $key => $value) {
                            $cartSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                            while($cartRow=mysqli_fetch_assoc($cartSql)){
                                $VENDOR = $value['email'];
                            }
                        }
                    
                        try {
                            //Server settings
                            
                            $mail->isSMTP();           
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'naanman10@gmail.com';                                 //SMTP username
                            $mail->Password   = 'tzdieozlrpfblght';                               //SMTP password
                            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                            $mail->SMTPDebug = 2;
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                                )
                            );
                    
                            //Recipients
                            $mail->addCC($VENDOR);
                            $mail->setFrom($_SESSION['user_email']);
                            
                            // $message = "Name".$name."/n"."Email".$email."/n"."Mobile".$mobile;
                    
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = $message;
                            $mail->Body    = $detaols. $detaols1. $detaols2. $detaols3. $detaols4. $detaols5 ;
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
               
                            $mail->send();
                            echo "<script> window.location.href = 'myaccount.php'</script>"; //Will take you to Google.
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
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
            $insertOrder = "INSERT INTO orders (user_id, totalprice, orderStatus, paymentMode, vendor_label) VALUES ($cId, '$total', 'Order Placed', '$payment', '$label')";
        
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
                        $mail = new PHPMailer(true); 
                        $cId= $_SESSION['user_identity'];
                        $cSql = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $cId");
                        if(mysqli_num_rows($cSql) > 0){
                            while($row=mysqli_fetch_assoc($cSql)){
                                $oId = $row['id'];
                                $cSql = mysqli_query($conn, "SELECT * FROM orderTracking WHERE orderid = $oId");
                                if(mysqli_num_rows($cSql) > 0){
                                    while($trow=mysqli_fetch_assoc($cSql)){
                                        $pId = $trow['productid'];
                                        $proQty = $trow['quantity'];
                                        $proPrice = $trow['productprice'];
                                        $proTotal = $trow['quantity'] * $trow['productprice'];
                                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $pId ");
                                        $prow = mysqli_fetch_assoc($proSql);
                                        $proName = $prow['product_name'];                                
                                        
                                    }
                                }
                                $message = "An order has been placed!";
        
                                $detaols = '<table style="text-align:center;">';
                                
                                $detaols1 = '<tr><th>Total Price</th><th>Order Status</th> <th>Payment Mode</th><th>Time</th></tr>';
                                $detaols2 = '<tr><td>'.$row['totalPrice'].'</td><td>'.$row['orderStatus'].'</td><td>'.$row['paymentMode'].'</td><td>'.$row['create_at'].'</td>></tr>';
                                $detaols3 = '<tr><th>Product</th><th>Quantity</th> <th>Price</th><th>Total Price</th></tr>';
                                $detaols4 = '<tr><td>'.$proName.'</td><td>'.$proQty.'</td><td>'.$proPrice.'</td><td>'.$proTotal.'</td></tr>';
                                $detaols5 = '</table>';
                                
                            }
                        
                        }
                        
                        $cart = $_SESSION['cart'];
                        foreach ($cart as $key => $value) {
                            $cartSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                            while($cartRow=mysqli_fetch_assoc($cartSql)){
                                $VENDOR = $value['email'];
                            }
                        }
                    
                        try {
                            //Server settings
                            
                            $mail->isSMTP();           
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'naanman10@gmail.com';                                 //SMTP username
                            $mail->Password   = 'jbstimjjdwgxitlb';                               //SMTP password
                            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                            $mail->SMTPDebug = 2;
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                                )
                            );
                    
                            //Recipients
                            $mail->addCC($VENDOR);
                            $mail->setFrom($_SESSION['user_email']);
                            
                            // $message = "Name".$name."/n"."Email".$email."/n"."Mobile".$mobile;
                    
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = $message;
                            $mail->Body    = $detaols. $detaols1. $detaols2. $detaols3. $detaols4. $detaols5 ;
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                            // echo "<pre>";
                            // exit(print_r($mail));
                            // echo "</pre>";
                    
                            $mail->send();
                            echo "<script> window.location.href = 'myaccount.php'</script>"; //Will take you to Google.
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                }
            }else{
                exit("ERROR: ".mysqli_error($conn));
            }
        }
    }

}

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

?>