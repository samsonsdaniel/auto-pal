<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
        <a class="navbar-brand" href="index.php">Auto<span>Pal</span></a>
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
		
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
				<?php
					if($_SESSION['user_type'] == 1){
				?>
						<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="addUser.php" class="nav-link">Add User</a></li>
						<li class="nav-item"><a href="roles.php" class="nav-link">All Roles</a></li>
						<li class="nav-item"><a href="product.php" class="nav-link">Products</a></li> 
						<li class="nav-item"><a href="orders.php" class="nav-link">View Orders</a></li>
						<li class="nav-item"><a href="logout.php" class="nav-link">logout</a></li>
				<?php
					}else{
				?>
						<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="product.php" class="nav-link">Products</a></li> 
						<li class="nav-item"><a href="orders.php" class="nav-link">View Orders</a></li>
						<li class="nav-item"><a href="logout.php" class="nav-link">logout</a></li>
             
				<?php
					}
				?>
            
            </ul>
        </div>

	      </div>
	    </div>
	  </nav>
    <!-- END nav -->