<?php 
include("../includes/db_connection.php");
include("../includes/functions.php");
$errorMessage =$firstName = $lastName = $email= $pass = $match = "";

    if(isset($_POST['btnSubmit'])){
      
      $username = sanitize_data($_POST['txtusername']);
      $email = sanitize_data($_POST['txtEmail']);
      $user_type = sanitize_data($_POST['user_type']);
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

            echo "<script> window.location.href = 'index.php'</script>"; //Will take you to Google.
          }
        }        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Pal</title>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../bs4/css/bootstrap.min.css">
    <link rel="stylesheet" type="../text/css" href="./css/style.css">
    <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../vendors/chartist/chartist.min.css">



    

    

    <link rel="stylesheet" href="../cs/animate.css">
    <link rel="stylesheet" href="../cs/owl.carousel.min.css">
    <link rel="stylesheet" href="../cs/owl.theme.default.min.css">
    <link rel="stylesheet" href="../cs/magnific-popup.css">
    <link rel="stylesheet" href="../cs/ionicons.min.css">
    <link rel="stylesheet" href="../cs/flaticon.css">
    <link rel="stylesheet" href="../cs/icomoon.css">
    <link rel="stylesheet" href="../cs/style.css">

</head>
<body class="main-body">

  <div class="row signup-form">
    <div class="container col-md-3">
      <div class="row">
        <div class="container s-cont col-md-12">
          <div class="user-container">
          <i class="fa fa-user-plus user" aria-hidden="true"></i>
          </div>
          <div class="content p-2">
            <?php 
                $errorMessage = $username = "";
            ?>
            <h2 class="text-center">Sign Up</h2>
            <form style="width: 400px; margin: auto" action="addUser.php" method="post">              
              <div class="form-group">
                <label for="exampleInputLastName">Username</label>
                <i class="fa fa-user input-icon s-user" style="margin-top: 55px; margin-left: -62px;" aria-hidden="true"></i>
                <input type="text" class="form-control" id="exampleInputuserName" value="<?php echo $username; ?>" aria-describedby="emailHelp" name="txtusername" required>
              </div>
              <div class="form-group">
              <i style="margin-top: 55px; margin-left: 10px;" class="fa fa-envelope input-icon s-env" aria-hidden="true"></i>
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $email; ?>" aria-describedby="emailHelp" name="txtEmail" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                              <select name="user_type" class="form-control" id="">
                                <option value="">-- Who you are --</option>
                                <?php
                                  $carQuery = mysqli_query($conn, "SELECT * FROM `role`");
                                  while($carRow=mysqli_fetch_assoc($carQuery)){
                                ?>
                                  <option value="<?=$carRow['user_type'] ?>"><?=$carRow['roles'] ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </div>

              <div class="form-group">

                <label for="exampleInputPassword1">Password</label>
                <i style="margin-top: 55px; margin-left: -60px;" class="fa fa-lock input-icon s-lock" aria-hidden="true"></i>

                <input type="password"  class="form-control
                
                <?php
                
                  if($pass== 'no match')
                  {echo 'is-invalid';
                  }else if ($match == 'match')
                  {echo 'is-valid';}
                
                ?>
                
                
                " id="exampleInputPassword1" name="txtPassword1"  required>
                <small class="is-invalid-feedback text-danger"><?=$errorMessage; ?></small>
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword">Confirm Password</label>
                <i style="margin-top: 55px; margin-left: -120px;" class="fa fa-lock input-icon s-lock-2" aria-hidden="true"></i>
                <input type="password"  class="form-control
                
                
              
                <?php
                
                  if($pass== 'no match')
                  {echo 'is-invalid';
                  }else if ($match == 'match')
                  {echo 'is-valid';}
                
                ?>
                
                 " id="exampleInputConfirmPassword" name="txtPassword2"   required>
                <small class="is-invalid-feedback text-danger"><?=$errorMessage; ?></small>
              </div>
              <div class="container mt-3">
                <p class="text-center">Already have an account?<a href="index.php" id="login-link" class="ml-2">&nbsp;Log in</a></p>
              </div>
              <button type="submit" name="btnSubmit" class="btn btn-block btn-info">Submit</button>
            </form>
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