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
                <div class="col-md-6 mt-2">
                    <a id="item-link" href="drawer.php">
                        <div style="" class="item-container">
                            <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                                <i style="font-size: 8em;" class="icons fa fa-car"></i>                            
                            </div>
                            <div style="" class="item-footer" >
                                <p class="">my car</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="item-container">
                        <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                            <i style="font-size: 8em;" class="icons fa fa-warning"></i>
                        </div>
                        <div style="" class="item-footer" >
                            <p class=""></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="item-container">
                        <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                            <i style="font-size: 8em;" class="icons fa fa-gear"></i>
                        </div>
                        <div style="" class="item-footer" >
                            <p class="">Setting</p>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6 mt-2">
                <a href="comment.php">

                        <div class="item-container">
                            <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                                <i style="font-size: 8em;" class="icons fa fa-car" aria-hidden="true"></i>
                            </div>
                            <div style="" class="item-footer" >
                                <p class="">Report a Problem</p>
                            </div>
                        </div>
                </a>

                    </div>
                <div class="col-md-6 mt-2">
                    <a href="booking.php">
                        <div class="item-container">
                            <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                                <i style="font-size: 8em;" class="icons fa fa-book"></i>
                                <i style="font-size: 8em;" class="icons fa fa-pencil"></i>
                            </div>
                            <div style="" class="item-footer" >
                                <p class="">Book</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="item-container">
                        <div style="border: 1px solid #007bff;color: #007bff; display: flex; justify-content: center; align-items: center; border-radius: 50%;height:250px; width:50%;" class="item-img">
                            <i style="font-size: 8em;" class="icons fa fa-calculator"></i>
                        </div>
                        <div style="" class="item-footer" >
                            <p class=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
<?php include("includes/footer_page.php") ?>
