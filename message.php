<?php include ("./includes/header.php"); ?>
<?php 

  include("includes/db_connection.php");
  include("includes/functions.php");
  $errorMessage =$firstName = $lastName = $email= "";

    if(isset($_POST['btncarType'])){
      
      $fn = sanitize_data($_POST['fn']);
      $ln = sanitize_data($_POST['ln']);
      $address = sanitize_data($_POST['address']);
      $user_type = $_SESSION['user_identity'];
      $spec = $_POST['spec'];

          $sql = "INSERT INTO users_data (user_id, firstname,lastname, user_type, `address`) VALUES('$user_type','$fn','$ln', '$spec', '$address')";
          $result = mysqli_query($conn,$sql);
          // header("Location:signup.php");

          if (!$result) {
              die("Ooops! Something went wrong: " .mysqli_error($conn));
          }else{

            echo "<script> window.location.href = 'mechDetails.php'</script>"; //Will take you to Google.
          }
    }
   
  $userId = $_SESSION['user_identity'];
  $selQuery = mysqli_query($conn, "SELECT * FROM details WHERE user_id = $userId");

  if(!$selQuery){
    exit("eRROR: ".mysqli_error($conn));
  }else{
    while($row=mysqli_fetch_assoc($selQuery)){

    }
  }

?>

            <div class="row mt-3">
                <div class="container col-md-3 mt-3">
                    <div class="row mt-3">
                        <div class="container col-md-12 mt-3">
                            <h3 class="text-center">Your Message</h3>
                            <?php
                                if(isset($_GET['action'])){
                                    $appointId = $_GET['action'];
                                    $carQuery = mysqli_query($conn, "SELECT * FROM `booking` where id = $appointId");
                                    while($carRow=mysqli_fetch_assoc($carQuery)){                        
                                        $mech_user = $carRow['user_id'];
                                                    $mechQuery = mysqli_query($conn, "select * from users where id = $mech_user");
                                                    if(!$mechQuery){
                                                        exit("ERROR: ".mysqli_error($conn));
                                                    }else{
                                                        while($mechRow=mysqli_fetch_assoc($mechQuery)){
                                                            $userName = $mechRow['username'];
                                                        }
                                                    }
                                
                            ?>

                                        <p class="" style="border: 1px solid black; padding: 20px; border-radius: 12px;" href="#"><?=$userName ?> has an appointment with you on <?=$carRow['theDate'] ?></p>

                            <?php
                                    }
                                }
                            ?>


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