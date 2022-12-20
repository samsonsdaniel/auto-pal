<?php include ("./includes/header.php"); ?>
    <?php

        include("./includes/db_connection.php");
        include("./includes/functions.php");

        if(isset($_POST['btnCancle'])){
        $reason = $_POST['reason'];
        $orderid = $_POST['orderid'];
        $status = "Cancelled";

        $cancleOrder = mysqli_query($conn, "INSERT INTO orderItems (orderid, `status`, reason) VALUES ($orderid, '$status', '$reason')");
        echo "<pre>";
        exit(print_r($cancleOrder));
        echo "</pre>";
        if(!$cancleOrder){
            exit("ERROR: ".mysqli_error($conn));
        }else{
            $updateOrder = mysqli_query($conn, "UPDATE orders SET orderStatus='Cancelled' WHERE id = $orderid");
            if(!$updateOrder){
                exit("error: ".mysqli_error($conn));
            }else{
                echo "<script> window.location.href = 'myaccount.php'</script>"; //Will take you to Google.
            }
        }

        }
    
    ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 offset-2">            
                <h2>Cancle Order</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total Price</th>
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
                            <th scope="col">Total Price</th>
                            <th scope="col"><?=$orow['totalPrice'] ?></th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Order Status</th>
                            <th scope="col"><?=$orow['orderStatus'] ?></th>

                        </tr>
                        <tr>
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

                <form action="cancle-order.php" method="POST">
                    <div class="form-group">
                        <label for="">Reason</label>
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        <input type="hidden" name="orderid" value="<?=$_GET['action'] ?>" id="">
                    </div>          
                    <div class="form-group">
                        <input type="submit" value="Cancle Order" class="btn btn-primary btn-block" name="btnCancle" id="">
                    </div>                
                </form>
            </div>
        </div>

    </div>
    <hr>
<?php include("includes/footer_page.php") ?>
