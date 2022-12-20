<?php include ("./includes/header.php"); ?>
<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    $new_file_name = $msg = "";

    $_POST['agree'] = 'false';
    $_POST['payment'] = '';

 
?>

        <div class="container">
            <div class="row mt-3">
                <div class="col-md-8 offset-2">
                    <?=$msg ?>
                    <h2>My Account</h2>

                    <h4>Recent Orders</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                                $cId= $_SESSION['user_identity'];
                                if (isset($_GET['action'])){
                                    $oId = $_GET['action'];
                                    $oSql = mysqli_query($conn, "SELECT * FROM orders WHERE id = $oId  AND user_id = $cId");
                                    $orow = mysqli_fetch_assoc($oSql);
                                    
                                    $cSql = mysqli_query($conn, "SELECT * FROM orderTracking WHERE orderid = $oId");
                                    if(mysqli_num_rows($cSql) > 0){
                                        while($row=mysqli_fetch_assoc($cSql)){
                                            $pId = $row['productid'];
                                            ?>
                                            <tr>
                                                <td scope="row">
                                                    <?php 
                                                        $proSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $pId ");
                                                        $prow = mysqli_fetch_assoc($proSql);
                                                        echo $prow['product_name'];

                                                    ?>
                                                </td>
                                                <td><?=$row['quantity'] ?></td>
                                                <td><?=$row['productprice'] ?></td>
                                                <td><?php echo $row['quantity'] * $row['productprice'] ?></td>
                                                <td>
                                                    <a href="view-order.php?action=<?=$row['id'] ?>">View</a>
                                                </td>

                                            </tr>
                            <?php
                                        }
                                
                                    }else{
                                        echo "No record!";
                                    }

                                }
                            ?>
                                                        
                        </tbody>
                        <tfooter>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Total Price</th>
                                <th scope="col"><?=$orow['totalPrice'] ?></th>
                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Order Status</th>
                                <th scope="col"><?=$orow['orderStatus'] ?></th>

                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Time and Date</th>
                                <th scope="col"><?=$orow['create_at'] ?></th>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 offset-2">
                    <h4>Billing Address</h4>
                    <?php
                        $uSql = mysqli_query($conn, "SELECT * FROM users_data WHERE user_id = $cId");
                        $uRow=mysqli_fetch_assoc($uSql);
                        
                    ?>
                    <h5><?=$uRow['firstname'] ." ". $uRow['lastname']?></h5>
                    <h5><?=$uRow['mobile_phone'] ?></h5>
                    <h5><?=$uRow['address'] ?></h5>
                </div>
            </div>

        </div>
        <hr>
<?php include("includes/footer_page.php") ?>
