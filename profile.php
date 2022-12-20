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

<main>
    <h4>Your Details</h4>
    <?php
        if(isset($_GET['action'])){
            
            $userId = $_GET['action'];
            $userQuery = mysqli_query($conn, "SELECT * FROM users_data WHERE user_id = $userId");
            if(!$userQuery){
                exit("ERROR: ".mysqli_errno($conn));
            }else{
                if(mysqli_num_rows($userQuery) < 1){
    ?>
                    <div class="">
                        <div class="body">
                            <a href="editProfile.php?action=<?=$userId ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
    <?php
                }elseif(mysqli_num_rows($userQuery) > 0){
                    while($userRow=mysqli_fetch_assoc($userQuery)){
                        $userImg = $userRow['img'];                   

                    
    ?>
                        <img src="<?=$userRow['img'] ?>" alt="<?=$userRow['firstname'] ?>">
                        <h6><?=$userRow['firstname'] ?></h6>
                        <h6><?=$userRow['lastname'] ?></h6>
                        <a href="editProfile.php?action=<?=$userId ?>" class="btn btn-primary">Edit</a>


    <?php
                    }
                }
            }
        }
    ?>
</main>
<?php include("includes/footer_page.php") ?>