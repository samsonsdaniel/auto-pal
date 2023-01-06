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

    // if(!$_SESSION)  {
    //     header("location: signup.php");
    // }
    
    

    $name = $successMessage= "";
    if (isset($_GET['login'])){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>'.$_SESSION['user_identity'].'Success</strong> 
        </div>
        
        <script>
        $(".alert").alert();
        </script>';
    }

    if (isset($_GET['action'])){
        if ($_GET['action'] == 'reply'){
            $successmsg = '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>You replied to this his/her comment</strong> 
            </div>
            
            <script>
            $(".alert").alert();
            </script>';
        }
    }

    // echo $_SESSION['user_identity'];

?>

        <div class="container">
            <div class="row mt-3">
                <?php
                    $sn = 0;
                    $sql = mysqli_query($conn, "select * from products");
                    if(!$sql){
                        exit("ERROR :".mysqli_error($conn));
                    }else{
                        if(mysqli_num_rows($sql) < 1){
                ?>
                                <div  style="height: 50vh;" class="col-md-6 mt-2 d-flex justify-content-center">
                                    <div style="display: flex; justify-content:center; align-items: center; position: relative; left: 50%" class="item-container">
                                      <h3>No Products available</h3>
                                    </div>
                                </div>
                <?php
                            }else{
                                while($row=mysqli_fetch_assoc($sql)){
                                    $sn++;
                             
                ?>
                                <div class="col-md-6 mt-2 d-flex justify-content-center">
                                    <div style="" class="item-container">
                                        <div style="" style="" class="item-img">
                                            <img class="img-fluid " style="height:300px; width: 300px;"  src="admin/<?=$row['product_img'] ?>" alt="<?=$row['product_name'] ?>">
                                        </div>
                                        <div style="" class="" >
                                            <p class=""><?=$row['product_name'] ?></p>
                                            <p class=""><?=$row['product_price'] ?></p>
                                            <p class=""><?=$row['vendor_label'] ?></p>
                                        </div>
                                        <div>
                                            <a href="addToCart.php?action=<?=$row['id'] ?>" class="btn btn primary">Add To Cart</a>
                                            <a href="single.php?action=<?=$row['id'] ?>" class="btn btn primary">View</a>
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
