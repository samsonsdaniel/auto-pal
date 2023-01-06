<?php 
    session_start();
    if(!isset($_SESSION['user_identity'])){
        header('location: login.php');
    }
    include("../includes/db_connection.php");
    include("../includes/functions.php");
    if(isset($_POST['btnAddPro'])){
        $pro_name = $_POST['pro_name'];
        $pro_price = $_POST['pro_price'];
        $vendor_label =$_POST['vendor_label'];
        $cId = $_POST['vendor'];
        $file_name = $_FILES['pro_img']['name'];
        $file_type = $_FILES['pro_img']['type'];
        $file_size = $_FILES['pro_img']['size'];
        $temp_location = $_FILES['pro_img']['tmp_name'];
        $error= $_FILES['pro_img']['error'];
        $upload_path="uploads/";
        // echo "<pre>";
        // exit(print_r($_POST));
        // echo "<pre>";

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
        $query = "INSERT INTO products (user_id, product_name, product_price, product_img, vendor_label) VALUES ($cId, '$pro_name', '$pro_price', '$new_file_name', '$vendor_label')";
        $result = mysqli_query($conn, $query);

        if(!$result){
            exit("Error: " .mysqli_error($conn));
        }else {
            echo "<script> window.location.href = 'product.php'</script>"; //Will take you to Google.
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
<?php include('./nav.php') ?>

  

  <div class="row signup-form">
    <div class="container col-md-12">
      <div class="row">
        <div class="container s-cont col-md-12">
        

            <div class="container">
                <h6 class="section-secondary-title mt-5 text-center">Add Product</h6>
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <form action="addProduct.php" class="form-horizontal" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" value="" name="pro_name" id="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="">Label</label>
                              <input type="text" class="form-control" name="vendor_label" id="" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Product Price</label>
                                <input type="text" value="" name="pro_price" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">vendor</label>
                                <input type="text" name="vendor" value="<?=$_SESSION['user_identity'] ?>" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Image</label>
                                <input type="file" value="" name="pro_img" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Add Product" name="btnAddPro" class="btn btn-block btn-primary">
                            </div>                      
                        </form>
                    </div>
                </div>
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