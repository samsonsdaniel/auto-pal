<?php include ("./includes/header.php"); ?>

<?php
    include("./includes/db_connection.php");
    include("./includes/functions.php");
?>

    <div class="container">
        <div class="row mt-3">
            <h6 class="section-secondary-title mt-5">Striped rows :</h6>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cart = $_SESSION['cart'];
                        $sn = $total = 0;
                                
                        foreach ($cart as $key => $value) {
                            $cartSql = mysqli_query($conn, "SELECT * FROM products WHERE id = $key");
                            while($cartRow=mysqli_fetch_assoc($cartSql)){
                                $sn++;
                    ?>

                                <tr>
                                    <th scope="row"><?=$sn ?></th>
                                    <td>
                                            <img class="img-fluid" src="admin/<?=$cartRow['product_img'] ?>" alt="<?=$cartRow['product_name'] ?>">
                                    </td>
                                    <td><a href="single.php?action=<?=$cartRow['id'] ?>"><?=$cartRow['product_name'] ?></a></td>
                                    <td><?=$cartRow['product_price'] ?></td>
                                    <td><?=$value['quantity'] ?></td>
                                    <td><?php echo $cartRow['product_price'] * $value['quantity'] ?></td>
                                    <td>
                                            <a href="addToCart.php?deleteCart=<?=$cartRow['id'] ?>">Remove</a>
                                    </td>
                                
                                </tr>

                    <?php
                                $total = $total + ($cartRow['product_price'] * $value['quantity']);
                            }

                        
                        }
                    // }
                    ?>            
                </tbody>
            </table>

            <div>
                <div>total</div>
                <div><?=$total ?></div>
                <div>
                    <a href="checkout.php">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php include("includes/footer_page.php") ?>
