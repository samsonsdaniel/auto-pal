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
<body class="main-body">
<section class="mt-3 ftco-section ftco-no-pt ftco-no-pb">
    <div class="container-fluid content">

          <div class="content p-2">
            <h4 class="text-center">About Us</h4>
            <p>The auto shop repair service and booking system is an automation of the various vehicle services needed by a vehicle user in a mobile application. This application provides vehicle service reminder while providing vehicle related solution. The vehicle maintenance and service system provide repair cost estimates to help mitigate the rigged system vehicle users pass through for vehicle repairs and maintenance. This project work contains a review of existing systems related to the proposed system and the prototype development methodology used to develop the system. And also provides the design of the system using the Unified Modelling Language as well as testing of the system. The examination of the literature uncovered a number of empirical evidence areas, and the resulting discussion provides the basis for the design and implementation of an auto shop repair service and booking system.</p>
          </div>
  </div>
</section>
   
<section id="about" class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
          <div class="media block-6 d-block text-center pt-md-4">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class="fa fa-cog"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Mission</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>      
        </div>
        <div class="col-md-4 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
          <div class="media block-6 d-block text-center pt-md-4">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class="fa fa-wrench"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Vision</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>    
        </div>
        <div class="col-md-4 d-flex services align-self-stretch p-4 py-md-5 ftco-animate">
          <div class="media block-6 d-block text-center pt-md-4">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class="fa fa-car"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">About</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>
		
  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container-fluid content">
      <br>
      <div id="header-2">
          <h2 class="motorist">For motorist looking for assistance</h2>
      </div>
      <hr class="bg-warning horizon">
      <div class="row d-flex justify-content-center mt-5">
        <div id="left" class="col-md-3 p-5 bg-light right">
          <img src="./image/IMG_20200916_102737_058.JPG" class="img-fluid mt-3" alt="" width="400">
          <h3 class="heading" >Questions and Answer</h3>
          <p>get all the answers you need to know about what is/when wrong with your vehicle. There are <strong>professional</strong> ready to answer question concering your car.</p>
          <a href="comment.php" class="btn btn-lg btn-block btn btn-warning  btn-outline-light text-dark"><b>Ask Question</b> </a>
        </div>
        <div id="middle" class="col-md-3 p-5 bg-light">
          <img src="./image/IMG_20200916_102737_058.JPG" class="img-fluid mt-3" alt="" width="400">
          <h3 class="heading" >Questions and Answer</h3>
          <p>get all the answers you need to know about what is/when wrong with your vehicle. There are <strong>professional</strong> ready to answer question concering your car.</p>
          <a href="#" class="btn btn-lg btn-block btn btn-warning btn-outline-light text-dark"><b>Request For Service</b> </a>
        </div>
        <div id="right" class="col-md-3 p-5 right bg-light">
          <img src="./image/IMG_20200916_102806_990.JPG" class="img-fluid mt-3" alt="" width="400">
          <h3 class="heading" >Questions and Answer</h3>
          <p>get all the answers you need to know about what is/when wrong with your vehicle. There are <strong>professional</strong> ready to answer question concering your car.</p>
          <a href="comment.php" class="btn btn-lg btn-block btn btn-warning  btn-outline-light text-dark"><b>Ask Question</b> </a>
        </div>
    </div>  
  </section>
      

  <footer class="footer">
	<div class="container-fluid px-lg-5">
		<div class="row">
			<div class="col-md-9 py-5">
				<div class="row">
					<div class="col-md-4 mb-md-0 mb-4">
						<h2 class="footer-heading">About us</h2><hr>
						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
						<!-- <ul class="ftco-footer-social p-0">
							<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="ion-logo-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="ion-logo-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="ion-logo-instagram"></span></a></li>
						</ul> -->
					</div>
					<div class="col-md-8">
						<div class="row justify-content-center">
							<div class="col-md-12 col-lg-10">
								<div class="row">
									<div class="col-md-4 mb-md-0 mb-4">
										<h2 class="footer-heading">Services</h2><hr>
										<ul class="list-unstyled">
											<li><a href="#" class="py-1 d-block">Car Repairs</a></li>
											<li><a href="#" class="py-1 d-block">Car Sales</a></li>
											<li><a href="#" class="py-1 d-block">Mechanical Tips</a></li>
											<li><a href="#" class="py-1 d-block">Automobile Design</a></li>
										</ul>
									</div>
									<div class="col-md-4 mb-md-0 mb-4">
										<h2 class="footer-heading">About</h2><hr>
										<ul class="list-unstyled">
											<li><a href="#" class="py-1 d-block">Staff</a></li>
											<li><a href="#" class="py-1 d-block">Team</a></li>
											<!-- <li><a href="#" class="py-1 d-block">Careers</a></li> -->
											<li><a href="#" class="py-1 d-block">Blog</a></li>
										</ul>
									</div>
									<div class="col-md-4 mb-md-0 mb-4">
										<h2 class="footer-heading">Resources</h2><hr>
										<ul class="list-unstyled">
											<li><a href="#" class="py-1 d-block">Security</a></li>
											<li><a href="#" class="py-1 d-block">Global</a></li>
											<li><a href="#" class="py-1 d-block">Charts</a></li>
											<li><a href="#" class="py-1 d-block">Privacy</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-md-5">
					<div class="col-md-12">
						<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This was made by Exceptional  VASS <i class="ion-ios-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">ROCKETWARES.com</a>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5">
				<h2 class="footer-heading">SEND A MESSAGE</h2><hr>
				<form action="index.php" method="POST" class="contact-form">
					<div class="form-group">
						<input type="text" class="form-control" name="txt_name" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Your Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="subject" placeholder="Subject">
					</div>
					<div class="form-group">
						<textarea id="" cols="30" name="body" rows="3" class="form-control" placeholder="Message"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" onclick="sendEmail()" name="btnSend" class="form-control submit px-3">Send</button>
					</div>
				</form>
			</div> -->
		</div>
	</div>
</footer>
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