<?php
  include("./includes/db_connection.php");
  include("./includes/functions.php");

?>
<?php include ("./includes/header.php"); ?>

<div class="row signup-form">
  <div class="container-fluid col-md-3">
    <div class="row">
      <div class="container-fluid s-cont col-md-12">
        <div class="row">
          <?php
            $carown = $_SESSION['user_identity'];
            $query =mysqli_query($conn, "SELECT * FROM details WHERE user_id = $carown");
            while($carownRow=mysqli_fetch_assoc($query)){
              $own=$carownRow['car_type'];
              

              $carQuery = mysqli_query($conn, "SELECT * FROM mechanic WHERE id = $own");

              while($typeRow = mysqli_fetch_assoc($carQuery)){
                $typeId = $typeRow['id'];
                $mec_type = $typeRow['type'];


                $userQuery = mysqli_query($conn, "SELECT *FROM users_data WHERE user_type = $typeId");
                while($userRow=mysqli_fetch_assoc($userQuery)){
                  $fn = $userRow['firstname'];
                  $type = $userRow['user_type'];
                  $ty = $userRow['id'];
                  $add = $userRow['address'];



          ?>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h4><?=$fn  ?></h4>
                        <h5><?=$add ?></h5>
                        <h6><?=$typeRow['type']; ?></h6>
                      </div>
                      <div class="">
                        <a href="appoint.php?action=<?=$ty ?>" class="btn btn-block btn-primary">book</a>                        
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
  </div>
</div>

<?php include('includes/footer_page.php') ?>