<?php
	$connection = mysqli_connect("127.0.0.1", "root", "secret", "her_project");
	if(!$connection):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;

	function latest_listings() {
		$result = mysqli_query($connection, "SELECT * FROM listing ORDER BY id DESC LIMIT 3");
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assco($result)) {
				$id = $row['id'];
				$name = $row['name'];
				$price = $row['price'];
				$location = $row['location'];
				$image = $row['image'];

				echo "<div class='col-lg-3 footer_col'>
					<div class='footer_latest d-flex flex-row align-items-start justify-content-start'>
					<div><div class='footer_latest_image'><img src='images/".$row['image']."' alt=''></div></div>
					<div class='footer_latest_content'>
								<div class='footer_latest_location'>".$location."</div>
								<div class='footer_latest_name'><a href='property.php?id=".$id."'>".$name."</a></div>
								<div class='footer_latest_price'>$ ".$price."</div>
							</div>
					</div>
				</div>"
			}

			break;
		}


	}

?>
