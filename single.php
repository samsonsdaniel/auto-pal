<?php include ("./includes/header.php"); ?>

<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    $new_file_name = "";

    if (isset($_POST['btnAsk'])){
        $question = sanitize_data($_POST['txtQuestion']);
        $author = $_SESSION['logged_in'];
    
        $sql = " INSERT INTO posts (`image`, body, author_id) VALUES ('$new_file_name', '$question', '$author')";

        $result = mysqli_query ($conn, $sql);

        if(!$result){
            die("ERROR OCCURED" . mysqli_error($conn));
        }else{
    
        }
    }
?>

        <div class="container">
            <div class="row mt-3">

                <?php
                    if(isset($_GET['action'])){
                        $id = $_GET['action'];
                        $singleQuery = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
                        if(!$singleQuery){
                            exit("ERROR: ".mysqli_error($conn));
                        }else{
                            while($singleRow=mysqli_fetch_assoc($singleQuery)){
                ?>
                            <div class="col-md-8 offset-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="container-fluid">
                                            <img src="<?=$singleRow['product_img'] ?>" alt="<?=$singleRow['product_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="addToCart.php" method="get">
                                            <input type="text" name="action" value="<?=$id ?>">
                                            <input type="number" name="quantity" value="" id="">
                                            <input type="submit" value="Add To Cart">
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                <?php
                            }
                        }
                    }
                ?>               
            </div>
        </div>
        <hr>
<?php include("includes/footer_page.php") ?>
