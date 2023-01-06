<?php 
    session_start();
    if(!isset($_SESSION['user_identity'])){
        header('location: login.php');
    }
    include("../includes/db_connection.php");
    include("../includes/functions.php");


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
<?php include('./nav.php') ?>


  <div class="row signup-form">
    <div class="container col-md-3">
      <div class="row">
        <div class="container s-cont col-md-12">
            <div class="container">
                <a href="addProduct.php" class="btn btn-primary">Add Product</a>
            </div>        
            <h6 class="section-secondary-title mt-5">All Products :</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($_SESSION['user_type'] == 1){
                            $sn = 0;
                            $sql = mysqli_query($conn, "select * from products");
                            if(!$sql){
                                exit("ERROR :".mysqli_error($conn));
                            }else{
                                while($row=mysqli_fetch_assoc($sql)){
                                    $sn++;
                    ?>
                    <h2>admin</h2>

                                    <tr>
                                    <td scope="row"><?=$sn ?></td>
                                    <td>
                                        <img class="img-fluid rounded" style="border-radius: 300px; height: 100px" src="<?=$row['product_img'] ?>" alt="<?=$row['product_name'] ?>">
                                    </td>
                                    <td><?=$row['product_name'] ?></td>
                                    <td><?=$row['product_price'] ?></td>
                                    <td>
                                        <a href="editProduct.php?action=<?=$row['id'] ?>"><i class="fa fa-pencil"></i></a>
                                        <a href="editProduct.php?action=<?=$row['id'] ?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                    </tr>
                    <?php
                                }
                            }
                        }else{
                            $sn = 0;
                            $cId = $_SESSION['user_identity'];
                            $sql = mysqli_query($conn, "select * from products where user_id = $cId");
                            if(!$sql){
                                exit("ERROR :".mysqli_error($conn));
                            }else{
                                if(mysqli_num_rows($sql)){
                                    while($row=mysqli_fetch_assoc($sql)){
                                        $sn++;
                    ?>

                                        <tr>
                                        <td scope="row"><?=$sn ?></td>
                                        <td>
                                            <img class="img-fluid rounded" style="border-radius: 300px; height: 100px" src="<?=$row['product_img'] ?>" alt="<?=$row['product_name'] ?>">
                                        </td>
                                        <td><?=$row['product_name'] ?></td>
                                        <td><?=$row['product_price'] ?></td>
                                        <td>
                                            <a href="editProduct.php?action=<?=$row['id'] ?>"><i class="fa fa-pencil"></i></a>
                                            <a href="editProduct.php?action=<?=$row['id'] ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                    <?php
                                    }
                                }else{
                    ?>
                                        <tr>
                                            <td>No Record</td>
                                        </tr>
                    <?php
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
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