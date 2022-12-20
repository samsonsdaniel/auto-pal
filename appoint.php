<?php include ("./includes/header.php"); ?>

<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    if(isset($_POST['btnBook'])){
        $theDate = $_POST['theDate'];
        $theTime = $_POST['theTime'];
        $mechId = $_POST['mech_id'];
        $userId = $_SESSION['user_identity'];

        $bookQuery = mysqli_query($conn, "INSERT INTO booking (user_id, mech_id, theDate, theTime) VALUES ('$userId', '$mechId', '$theDate', '$theTime')");
        if(!$bookQuery){
            exit("ERROR: ". mysqli_error($conn));
        }else{
            $mechId = mysqli_insert_id($conn);
            $selQuery = mysqli_query($conn, "select * from booking where id = $mechId");
            if(!$selQuery){
                exit("Error :" .mysqli_error($con));
            }else{
                while($selRow=mysqli_fetch_assoc($selQuery)){
                $mechID = $selRow['mech_id'];

            }
        }
            echo "<script> window.location.href = 'home.php'</script>"; //Will take you to Google.

        }
    }
?>


<?php

    if(isset($_GET['action'])){

        $typeId = $_GET['action'];

        $userQuery = mysqli_query($conn, "SELECT *FROM users_data WHERE id = $typeId");
        while($userRow=mysqli_fetch_assoc($userQuery)){
            $fn = $userRow['firstname'];
            $ty = $userRow['user_id'];
            $type = $userRow['user_type'];
            $add = $userRow['address'];
?>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <form action="appoint.php" class="form-horizontal" method="post">
                            <div class="form-group">
                                <input type="date" name="theDate" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="time" name="theTime" id="" class="form-control">
                                <input type="text" name="mech_id" id="" value="<?=$ty ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Book an Appointment" name="btnBook" class="btn btn-block btn-primary">
                            </div>                      
                        </form>
                    </div>
                </div>
            </div>
<?php
        }
    }

?>