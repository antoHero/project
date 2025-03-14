<?php require("includes/locations.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Real Estate Management</title>
<?php include('includes/header.php');?>

	<div class="front">
		<form action="search_results.php" method="POST">
			<h1 class="home-text">Housing Manegement System</h1>
			<div class="form">
				<input type="hidden" name="search" placeholder="Search Property Type" class="search-field service">
				<input type="text" name="location" placeholder="Location...." class="search-field location" style="width: 700px;">
				<input type="submit" name="search" class="btn" value="Search...">
			</div>
			<span>Type of property like: Bungalow, duplex</span>
		</form>
	</div>
	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
					</div>
				</a>
			</div>
			<ul>
				<li class="menu_item"><a href="index.php">Home</a></li>
				<li class="menu_item"><a href="about.html">About us</a></li>
				<li class="menu_item"><a href="#">Speakers</a></li>
				<li class="menu_item"><a href="#">Tickets</a></li>
				<li class="menu_item"><a href="news.html">News</a></li>
				<li class="menu_item"><a href="contact.html">Contact</a></li>
			</ul>
		</div>
		<div class="menu_phone"><span>call us: </span>+234 345 3222 11</div>
	</div>

	<!-- Recent -->

	<div class="recent">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">Recent Properties</div>
					<div class="section_subtitle">Search your dream home</div>
				</div>
			</div>
			<div class="row recent_row">
				<div class="col">
					<div class="recent_slider_container">
						<div class="owl-carousel owl-theme recent_slider">
							
							<!-- Slide -->
							<?php

					            $user = $_SESSION['user_id'];
					            $qry = "SELECT * FROM listing ORDER BY id desc";
					            $result = mysqli_query($connection, $qry);
					            if(mysqli_num_rows($result) > 0) {
					              while($row = mysqli_fetch_assoc($result)) {
					              	$id = $row['id'];
					                $name = $row['name'];
					                $price = $row['price'];
					                $location = $row['location'];
					                $bedrooms = $row['bedrooms'];
					                $image = $row['image'];
					                $type = $row['type'];
					                $description = $row['description'];
					                $user_id = $row['user_id'];
					                $area = $row['area'];
					            

					          ?>
							<div class="owl-item">
								<div class="recent_item">
									<div class="recent_item_inner">
										<div class="recent_item_image">
											<img src="images/<?php echo $image; ?>" alt="<?php echo $name; ?>">
											<?php
												if($type == "Sale") {
													echo "<div class='tag_featured property_tag'><a href=''>$type</a></div>";
												} else {
													echo "<div class='tag_featured property_tag'><a href='' style='background-color: green;'>$type</a></div>";
												}
											?>
											
										</div>
										<div class="recent_item_body text-center">
											<div class="recent_item_location"><?php echo $location; ?></div>
											<div class="recent_item_title"><a href="property.php?id=<?php echo $id;?>&user=<?php echo $user_id;?>"><?php echo $name;?></a></div>
											<div class="recent_item_price"># <?php echo $price?></div>
										</div>
										<div class="recent_item_footer d-flex flex-row align-items-center justify-content-start">
											<div><div class="recent_icon"><img src="images/icon_1.png" alt=""></div><span><?php echo $area . " Sq Ft"; ?></span></div>
											<div><div class="recent_icon"><img src="images/icon_2.png" alt=""></div><span><?php echo $bedrooms; ?> Bedrooms</span></div>
											<div><div class="recent_icon"><img src="images/icon_3.png" alt=""></div><span>3 Bathrooms</span></div>
										</div>
									</div>
								</div>
							</div>
							<?php }} 
						        else {
						          echo "<p class='alert alert-danger'>You don't have any listings </p>";
						        }
						      ?>


						</div>

						<div class="recent_slider_nav_container d-flex flex-row align-items-start justify-content-start">
							<div class="recent_slider_nav recent_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
							<div class="recent_slider_nav recent_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
						</div>
					</div>
					<div class="button recent_button"><a href="properties.php">see more</a></div>
				</div>
			</div>
		</div>
	</div>


	<!-- Footer -->

	<?php include('includes/footer.php');?>