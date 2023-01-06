<?php include ("./includes/header.php"); ?>
<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");


?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 offset-2">
                <?=$msg ?>
                <h2>Billing Details</h2>
                <form action="send_mail.php" method="POST">
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="fn" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Lastname</label>
                        <input type="text" class="form-control" name="ln" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Vendor Label</label>
                        <input type="text" class="form-control" value="<?=$_SESSION['user_identity'] ?>" name="vendor_label" id="">
                    </div> 
                    <div class="form-group">
                        <label for="">Vendor Label</label>
                        <?php

                            $cart = $_SESSION['cart'];
                            foreach ($cart as $key => $value) {
                                $cartSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                                while($cartRow=mysqli_fetch_assoc($cartSql)){
                        ?>
                        <input type="text" class="form-control" value="<?=$value['email'] ?>" name="vendor_label" id="">
                        <?php

                                }}
?>
                    </div>                
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="mobile" id="">
                    </div>
                    <div class="form-group">
                        <?php

                            $tyQuery = mysqli_query($conn, "SELECT * FROM details WHERE user_id = $userId");
                            if(!$tyQuery){
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
<?=$value['email'] ?>
                <div>
                    <h6 class="section-secondary-title mt-5">Total :</h6>
                    <div><?=$total ?></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php include("includes/footer_page.php") ?>
