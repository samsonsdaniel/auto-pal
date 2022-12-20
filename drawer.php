<?php include ("./includes/header.php"); ?>

<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");

$errorMessage =$firstName = $lastName = $email= "";

    if(isset($_POST['btnSubmit'])){
      
      $username = sanitize_data($_POST['txtusername']);
      $email = sanitize_data($_POST['txtEmail']);
      $user_type = sanitize_data($_POST['user-type']);
      $password1 = sanitize_data($_POST['txtPassword1']);
      $password2 = sanitize_data($_POST['txtPassword2']);

        if ($password1 != $password2) {

          $errorMessage = " Ooop's Password do not match Try Again !";
          $pass = 'no match';

        }else {
          $match = "match";

          $hashed_password = password_hash($password1, PASSWORD_DEFAULT);    
          $sql = "INSERT INTO users (username,email, user_type, `password`) VALUES('$username','$email', '$user_type', '$hashed_password')";
          $result = mysqli_query($conn,$sql);
          // header("Location:signup.php");

          if (!$result) {
              die("Ooops! Something went wrong: " .mysqli_error($conn));
          }else{

            echo "<script> window.location.href = 'login.php'</script>"; //Will take you to Google.
          }
        }        
    }


?>

  <div class="row signup-form">
    <div class="container col-md-3">
      <div class="row">
        <div class="container s-cont col-md-12">
          <div class="user-container">
          <i class="fa fa-user user" aria-hidden="true"></i>
          </div>
          <div class="content p-2">
            <h2 class="text-center"><?php echo $_SESSION['user_email'] ?></h2>
            <h4 class="text-center">Car Details</h4>
            <?php
              $userId = $_SESSION['user_identity'];
              $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
              while($userRow = mysqli_fetch_assoc($userQuery)){
                $id = $userRow['id'];
                $detailsQuery = mysqli_query($conn, "SELECT * FROM details WHERE user_id = $id");
                while($detailsRow=mysqli_fetch_assoc($detailsQuery)){
                  $car_type=$detailsRow['car_type'];
                  $car_color=$detailsRow['car_color'];
                  $car_model=$detailsRow['car_model'];
                // }
                  $typeQuery = mysqli_query($conn, "SELECT * FROM mechanic WHERE id = $car_type");
                  while($typeRow=mysqli_fetch_assoc($typeQuery)){
                    $type = $typeRow['type'];
                  }
            ?>
            <div class="row">
              <div class="col-md-5">
                <span>Type</span>
                <span><?=$type ?></span>
              </div>
              <div class="col-md-5">
              <span>Color</span>
                <span><?=$detailsRow['car_color'] ?></span>
              </div>
              <div class="col-md-3">
              <span>Model</span>
                <span><?=$detailsRow['car_model'] ?></span>
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
            </div>
            <?php
            
          }
        }
            ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/typed.js"></script>        
  <script src="js/main.js"></script>
  <script src="jsc/jquery.min.js"></script>
  <script src="jsc/jquery-migrate-3.0.1.min.js"></script>
  <script src="jsc/popper.min.js"></script>
  <script src="jsc/bootstrap.min.js"></script>
  <script src="jsc/jquery.easing.1.3.js"></script>
  <script src="jsc/jquery.waypoints.min.js"></script>
  <script src="jsc/jquery.stellar.min.js"></script>
  <script src="jsc/jquery.animateNumber.min.js"></script>
  <script src="jsc/owl.carousel.min.js"></script>
  <script src="jsc/jquery.magnific-popup.min.js"></script>
  <script src="jsc/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="jsc/google-map.js"></script>
  <script src="jsc/main.js"></script>

  <script type="text/javascript">
	function sendEmail() {
		console.log('sending ...');
		var name = $("name");
		var email = $("email");
		var subject = $("subject");
		var body = $("body");

		if (isNotEmpty(name) ** isNotEmpty(email) && isNotEmpty($subject) && isNotEmpty(body)){
			// console.log('passing condition');

			$.ajax ({
				url: 'sendmail.php',
				method: 'POST',
				dataType: 'json',
				data: {
					name: name.val(),
					email: email.val(),
					subject: subject.val(),
					body: body.val(),
				}, success: function (response){
					console.log(response);
				}
			});
		}

		function isNotEmpty(caller){
			if  (caller.val() == "") {
				caller.css('border', '1px solid red');
				return false;
			}else {
				caller.css ('border', '1px solid green');
				return true;
			}  
		} 
	}
  </script>

  <script src="hhtps://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
	setTimeout(function () {
		$('.loader_bg').fadeToggle();

	}, 1500)
  </script>
    
  </body> 
</html>