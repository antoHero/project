<!DOCTYPE html>
<html lang="en">
<head>
<title>Property</title>
<?php include('includes/header.php');?>

<div class="super_container">
<?php
//view single listing
	$fid = $_GET['id'];
	$user = $_GET['user'];
	$qry = "SELECT * FROM listing WHERE id='$fid' AND user_id='$user'";
	$result = mysqli_query($connection, $qry);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$listing_name = $row['name'];
		$listing_price = $row['price'];
		$listing_bedrooms = $row['bedrooms'];
		$listing_location = $row['location'];
		$listing_image = $row['image'];
		$description = $row['description'];
		$listing_type = $row['type'];
		$listing_bathrooms = $row['bathroom'];
		$listing_garage = $row['garage'];
		$listing_area = $row['area'];
	} 


	//get user details in a separate query
	$sql = "SELECT * FROM users WHERE id='$user'";
	$run = mysqli_query($connection, $sql);
	if(mysqli_num_rows($run) > 0) {
		$user = mysqli_fetch_assoc($run);
		$firstname = $user['firstname'];
		$lastname = $user['lastname'];
		$email = $user['email'];
		$phone = $user['phone'];
		$image = $user['image'];
	}

?>
	<!-- Home Search -->
	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
							<form action="#" class="search_form d-flex flex-row align-items-start justfy-content-start">
								<div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select">
											<option disabled selected>For rent</option>
											<option>Yes</option>
											<option>No</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>All types</option>
											<option>Type 1</option>
											<option>Type 2</option>
											<option>Type 3</option>
											<option>Type 4</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>City</option>
											<option>New York</option>
											<option>Paris</option>
											<option>Amsterdam</option>
											<option>Rome</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>Bedrooms</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>Bathrooms</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
									</div>
								</div>
								<button class="search_form_button ml-auto">search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Intro -->

	<div class="intro">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="intro_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="intro_title_container">
							<div class="intro_title"><?php echo $listing_name; ?></div>
							<div class="intro_tags">
								<ul>
									<li><a href="#">Hottub</a></li>
									<li><a href="#">Swimming Pool</a></li>
									<li><a href="#">Garden</a></li>
									<li><a href="#">Patio</a></li>
									<li><a href="#">Hard Wood Floor</a></li>
								</ul>
							</div>
						</div>
						<div class="intro_price_container ml-lg-auto d-flex flex-column align-items-start justify-content-center">
							<div>For <?php echo $listing_type;?></div>
							<div class="intro_price">#<?php echo number_format($listing_price);?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro_slider_container">

			<!-- Intro Slider -->
			<div class="owl-carousel owl-theme intro_slider">
				<!-- Slide -->
				<div class="owl-item"><img src="images/<?php echo $listing_image; ?>" alt="<?php echo $listing_name?>" height="500"></div>
				<!-- Slide -->
			</div>

			<!-- Intro Slider Nav -->
			<div class="intro_slider_nav_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="intro_slider_nav_content d-flex flex-row align-items-start justify-content-end">
								<div class="intro_slider_nav intro_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
								<div class="intro_slider_nav intro_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Property -->

	<div class="property">
		<div class="container">
			<div class="row">
				
				<!-- Sidebar -->

				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Realtor -->
						<div class="sidebar_realtor">
							<?php 
								if($image != NULL) {
									echo "<div class='sidebar_realtor_image'><img src='images/$image' width='100%' alt=''></div>";
								} else {
									echo "<div class='sidebar_realtor_image'><img src='images/sidebar_realtor.jpg' alt=''></div>";
								}
							?>
							
							
							<div class="sidebar_realtor_body text-center">
								<div class="sidebar_realtor_title"><a href="#"><?php echo $firstname ." ". $lastname;?> </a></div>
								<div class="sidebar_realtor_subtitle">Senior Realtor</div>
								<div class="sidebar_realtor_phone"><span>call us: </span><?php echo $phone;?></div>
								<div class="sidebar_realtor_phone"><span>Send a message: </span><?php echo $phone;?></div>
								<div class="realtor_link"><a href="#">+</a></div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Property Content -->
				<div class="col-lg-7 offset-lg-1">
					<div class="property_content">
						<div class="property_icons">
							<div class="property_title">Extra Facilities</div>
							<div class="property_text property_text_1">
							</div>
							<div class="property_rooms d-flex flex-sm-row flex-column align-items-start justify-content-start">

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Bedrooms</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_1.png" alt=""></div>
										<div class="room_num"><?php echo $listing_bedrooms;?></div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Bathrooms</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_2.png" alt=""></div>
										<div class="room_num"><?php echo $listing_bathrooms; ?></div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Area</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_3.png" alt=""></div>
										<div class="room_num"><?php echo $listing_area . " Sq Ft"; ?></div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Garage</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_5.png" alt=""></div>
										<div class="room_num"><?php echo $listing_garage; ?></div>
									</div>
								</div>

							</div>
						</div>

						<!-- Description -->

						<div class="property_description">
							<div class="property_title">Description</div>
							<div class="property_text property_text_2">
								<p><?php echo $description; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/rangeslider.js-2.3.0/rangeslider.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/property.js"></script>
</body>
</html>