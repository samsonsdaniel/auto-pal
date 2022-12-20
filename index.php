<?php  

    include("./includes/db_connection.php");
    include("./includes/functions.php");

    $errorMessage = $username = "";
if (isset($_POST['btnLogin'])){
    
    $username = sanitize_data($_POST['txtUser']);
    $password = sanitize_data($_POST['txtpassword']);

    if ($username & $password){
        $query = "SELECT * FROM users WHERE email = '$username'";
        $result = mysqli_query($conn, $query);


        if(mysqli_num_rows($result) < 1 ){
            $errorMessage = '<div class="errorMsg alert alert-danger" role="alert">
                                <strong>Email or Password</strong><a class="close" data-dismiss="alert">&times;</a>
                            </div>';
                              
            }elseif(mysqli_num_rows($result) > 0){
    
                while($row =  mysqli_fetch_assoc($result)){
                $hashed_password = $row['password'];
                $id = $row['id'];
                $email = $row['email'];
                $user_type = $row['user_type'];
        
                }
        
                // dehash password and compare
                $check_password = password_verify($password, $hashed_password);
        
                if(!$check_password){
                
                $errorMessage = '<div class=" errorMsg alert alert-danger" role="alert">
                                        <strong>Incorrect Username/Email or Password</strong><a class="close" data-dismiss="alert">&times;</a>
                                    </div>';
                                
                                
                }else{
        
                    // User is valid, create sessions
                    session_start();
            
                    $_SESSION['user_identity'] = $id;
                    $_SESSION['id']=TRUE;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['TypeOfUser'] = $user_type; 
            
                    //   $duration = time(60 * 60 * 24 * 365);
            
                    
                    
                    //   setcookie('User', $user_id, $duration);
                    //   setcookie('Password', $password, $duration);

                    if($user_type == 1){
                        header("Location: mech.php");

                    }else{
            
                    header("Location: details.php");
            
                    }
                }    
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
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="bs4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">



    

    

    <link rel="stylesheet" href="cs/animate.css">
    
    <link rel="stylesheet" href="cs/owl.carousel.min.css">
    <link rel="stylesheet" href="cs/owl.theme.default.min.css">
    <link rel="stylesheet" href="cs/magnific-popup.css">

    <link rel="stylesheet" href="cs/ionicons.min.css">
    
    <link rel="stylesheet" href="cs/flaticon.css">
    <link rel="stylesheet" href="cs/icomoon.css">
    <link rel="stylesheet" href="cs/style.css">

</head>
<body>

    <!-- <div class="loader_bg">
      <div class="loader"></div>
    </div> -->
    <div class="row login-form">
        <div class="container col-md-3">
            <div class="row">
                <div class="container col-md-12">
                    <div class="user-container">
                        <i class="fa fa-user user"></i>
                    </div>
                    <div class="content">
                        
                        <h2 class="text-center">Login</h2>
                        <form action="index.php" method="post" class = "form form-horizontal h-25 col-md-12">
                            <?=$errorMessage ?>
                            <div class="form-group ">
                            <i class="fa fa-envelope input-icon env" aria-hidden="true"></i>
                                <input required autofocus type="text" name="txtUser" id="log-input-mail" value="<?=$username ?>" class="form-control log-input mb-2" placeholder="Enter Username/Email" aria-describedby="helpId">   
                            </div>
                            <div class="form-group ">
                                <i class="fa fa-lock input-icon lock" aria-hidden="true"></i>
                                <input required type="password" name="txtpassword" id="log-input-pwd" style="" class="form-control mb-2" placeholder="Enter password" aria-describedby="helpId">
                            </div>
                            <div class="form-group ">
                                <button type="submit" name ="btnLogin" class = "btn btn-info btn-block">Login</button>
                            </div>
                            <div class="login-footer">
                                <p class="text-center">Don`t have an Account? <a href="signup.php">Sign Up</a></p>
                            </div>
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

	}, 100)
  </script>
    
  </body> 
</html>