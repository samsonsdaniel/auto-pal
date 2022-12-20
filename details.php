<?php include ("./includes/header.php"); ?>
<?php 
  include("includes/db_connection.php");
  include("includes/functions.php");
  $errorMessage =$firstName = $lastName = $email= "";

    if(isset($_POST['btncarType'])){
      
      $carType = sanitize_data($_POST['carType']);
      $carColor = sanitize_data($_POST['carColor']);
      $carModel = sanitize_data($_POST['carModel']);
      $user_type = $_SESSION['user_identity'];

          $sql = "INSERT INTO details (user_id, car_type,car_color, car_model) VALUES('$user_type','$carType','$carColor', '$carModel')";
          $result = mysqli_query($conn,$sql);
          // header("Location:signup.php");

          if (!$result) {
              die("Ooops! Something went wrong: " .mysqli_error($conn));
          }else{

            echo "<script> window.location.href = 'home.php'</script>"; //Will take you to Google.
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

  if(mysqli_num_rows($selQuery) < 1 ){

  ?>
    <div class="row">
        <div class="container col-md-3">
            <div class="row">
                <div class="container col-md-12">
                    <div class="user-container">
                        <i class="fa fa-car user"></i>
                    </div>
                    <div class="content">
                        <h2 class="text-center">Car Details</h2>
                        <form action="details.php" method="post" class = "form form-horizontal h-25 col-md-12">
                          <div class="form-group">
                              <select name="carType" class="form-control" id="">
                                <option value="">--Car Type--</option>
                                <?php
                                  $carQuery = mysqli_query($conn, "SELECT * FROM mechanic");
                                  while($carRow=mysqli_fetch_assoc($carQuery)){
                                ?>
                                  <option value="<?=$carRow['id'] ?>"><?=$carRow['type'] ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group ">
                                <input required autofocus type="text" name="carColor" id="log-input-mail" value="" class="form-control log-input mb-2" placeholder="Color" aria-describedby="helpId">   
                            </div>
                            <div class="form-group ">
                                <input required type="text" name="carModel" id="log-input-pwd" style="" class="form-control mb-2" placeholder="Model" aria-describedby="helpId">
                            </div>
                            <div class="form-group ">
                                <button type="submit" name ="btncarType" class = "btn btn-info btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
  <?php
                      
  }else{
    echo "<script> window.location.href = 'home.php'</script>"; //Will take you to Google.

  }
   
?>

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