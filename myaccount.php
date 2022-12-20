<?php include ("./includes/header.php"); ?>
<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

 
?>

        <div class="container">
            <div class="row mt-3">
                <div class="col-md-8 offset-2">
                    <h2>My Account</h2>

                    <h4>Recent Orders</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                                <th scope="col">Total Price</th>
                                <th scope="col">Order Status</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Date and time</th>
                                <th scope="col"></th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php
                                    $cId= $_SESSION['user_identity'];
                                    $cSql = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $cId");
                                    if(mysqli_num_rows($cSql) > 0){
                                        while($row=mysqli_fetch_assoc($cSql)){
                            ?>
                                            <tr>
                                                <td scope="row"><?=$row['totalPrice'] ?></td>
                                                <td><?=$row['orderStatus'] ?></td>
                                                <td><?=$row['paymentMode'] ?></td>
                                                <td><?=$row['create_at'] ?></td>
                                                <td>
                                                    <a href="view-order.php?action=<?=$row['id'] ?>">View</a>
                                                    <?php if($row['orderStatus'] != 'Cancelled'){ ?>
                                                        <a href="cancle-order.php?action=<?=$row['id'] ?>">Cancle</a>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                            <?php
                                        }
                                
                                    }else{
                                        echo "No record!";
                                    }

                            ?>
                                                        
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <hr>
<?php include("includes/footer_page.php") ?>
