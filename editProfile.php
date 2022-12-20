<?php include ("./includes/header.php"); ?>

<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    $new_file_name = "";

    if (isset($_POST['btnupdate'])){

        $userid = $_POST['userid'];
        $txtfn = $_POST['txtfn'];
        $txtln = $_POST['txtln'];
        $txtTy = $_POST['txtTy'];

        $file_name = $_FILES['user_img']['name'];
        $file_type = $_FILES['user_img']['type'];
        $file_size = $_FILES['user_img']['size'];
        $temp_location = $_FILES['user_img']['tmp_name'];
        $error= $_FILES['user_img']['error'];
        $upload_path="admin/uploads/";

        if ($file_size > 1000000000) {
            exit("File too, large please upload only file lower than 1MB");
        }
        else{
            $file_extension = explode(".",$file_name );

            $permited_extentions = ["jpg","png","gif","jpeg"];


            if (!in_array(strtolower($file_extension[1]), $permited_extentions)) {
                exit("Unsupported File type");
            }else{
                $new_file_name = uniqid();

                $new_file_name = $upload_path.$new_file_name.".".strtolower($file_extension [1]);

                // exit($new_file_name);
                move_uploaded_file($temp_location, $new_file_name);
                // echo "Image uploaded successfully!";
            }
        }        

        $query = "INSERT INTO users_data (user_id, firstname, lastname, img, user_type, `address`) VALUES ($userid,'$txtfn', '$txtln', '$new_file_name', $txtTy, '')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            exit("Error: " .mysqli_error($conn));
        }elseif(mysqli_insert_id($conn)) {
            $upQuery = mysqli_query($conn, "UPDATE users_data SET firstname='$txtfn', lastname='$txtln', img='$new_file_name', user_type=$txtTy WHERE user_id = $userid");
            if(!$upQuery){
                exit("Error: " .mysqli_error($conn));                
            }else{
                echo "<script> window.location.href = 'profile.php'</script>"; //Will take you to Google.
            }
        }else{
            echo "<script> window.location.href = 'profile.php'</script>"; //Will take you to Google.
        }
    }
?>

<main>
    <?php
    if(isset($_GET['action'])){
        
        $userId = $_GET['action'];
        $userQuery = mysqli_query($conn, "SELECT * FROM users_data WHERE user_id = $userId");
        if(!$userQuery){
            exit("ERROR: ".mysqli_errno($conn));
        }else{
            if(mysqli_num_rows($userQuery) < 1){

                    
    ?>
                <div class="row">
                    <div class="col-md-3 offset-4">
                        <form action="editProfile.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <input class="form-control" type="type" value="<?=$userId ?>" placeholder="Id" name="userid" >
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text"  name="txtfn" placeholder="Firstname" >
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="LastName" name="txtln" >
                            </div>
                            <div class="form-group">
                                <?php

                                    $tyQuery = mysqli_query($conn, "SELECT * FROM details WHERE user_id = $userId");
                                    if(!$tyQuery){
                                        exit("ERROR: ".mysqli_errno($conn));
                                    }else{
                                        while($tyrow=mysqli_fetch_assoc($tyQuery)){                                            
                                ?>
                                            <input type="text" name="txtTy" value="<?=$tyrow['car_type'] ?>" id="">
                                <?php
                                        }
                                    }

                                ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="file" placeholder="" name="user_img" >
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnupdate"  value="Update" id="" class="btn btn-primary btn-block">
                            </div>
                            

                        </form>
                    </div>
                </div>
  <?php
            }elseif(mysqli_num_rows($userQuery) > 0){
                while($userRow=mysqli_fetch_assoc($userQuery)){
                    $userImg = $userRow['img'];
                
                ?>

                    <h1>there`s record</h1>
                        <form action="editProfile.php" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Id" name="userid" value="<?php echo $userRow['user_id'] ?>" id="">
                                <input type="text" name="txtTy" value="<?=$userRow['user_type'] ?>" id="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text"  name="txtfn" placeholder="Name" value="<?php echo $userRow['firstname'] ?>" id="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="LastName" name="txtln" value="<?php echo $userRow['lastname'] ?>" id="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="file" placeholder="" name="user_img" >
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="btnupdate"  value="UpDate" id=""">                            
                            </div>

                        </form>
                <?php
                
            }
        }
}
  }
  ?>
</main>
<?php include("includes/footer_page.php") ?>