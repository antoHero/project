<?php require('db/db.php');?>
<?php session_start();?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Bluesky template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="plugins/rangeslider.js-2.3.0/rangeslider.css">
<link rel="stylesheet" type="text/css" href="styles/property.css">
<link rel="stylesheet" type="text/css" href="styles/property_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/front.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
	  <a class="navbar-brand" href="index.php">ApartMent</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">For Sale</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">For Rent</a>
	      </li>
	      <?php 
	      	if(isset($_SESSION['user_id']) && isset($_SESSION['user'])) {



	      ?>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <?php echo $_SESSION['user'];?>
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="houseowner/profile.php">My account</a>
	          <a class="dropdown-item" href="logout.php">Logout</a>
	        </div>
	      </li>
	      <li class="nav-item my-2 my-lg-0">
	        <a class="nav-link align-right" style="background-color: #f44336; color: #fff;" href="houseowner/add_property.php">Post a property </a>
	      </li>
	      <?php
	      	} else {
	      ?>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          My account
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="register.php">Create account</a>
	          <a class="dropdown-item" href="login.php">Log in</a>
	        </div>
	      </li>
	      <li class="nav-item my-2 my-lg-0">
	        <a class="nav-link btn btn-outline-success align-right" href="login.php">Post a property </a>
	      </li>
	  		<?php } ?>
	      

	    </ul>
	  </div>
	</nav>

	<!-- <header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<div class="logo">
							<a href="index.php" style="color: #fff;"><h2>PROJECT</h2></a>
						</div>
						<nav class="main_nav">
							<ul>
								<li class="active"><a href="index.html">Home</a></li>
								<li><a href="about.html">About us</a></li>
								<li><a href="properties.html">Properties</a></li>
								<li><a href="news.html">News</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</nav>
						<div class="phone_num ml-auto">
							<div class="phone_num_inner">
								<a href="register.php"><span>Register</span></a>
							</div>
						</div>
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
		</div>
	</header> -->