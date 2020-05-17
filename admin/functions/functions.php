<?php
	$connection = mysqli_connect("127.0.0.1", "root", "secret", "her_project");
	if(!$connection):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;

	function getUsers() {
		global $connection;
		$i = 1; //to increment the SN
		$results = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC");
		if(mysqli_num_rows($results) > 0) {
			while($user_row = mysqli_fetch_assoc($results)) {
				$user_id = $user_row['id'];
				$user_name = $user_row['firstname'] ." ". $user_row['lastname'];
				$email = $user_row['email'];
				$phone = $user_row['phone'];
				$user_type = $user_row['user_type'];
				$address = $user_row['address'];

				echo "<tr>";
				echo "<td>".$i++."</td>";
				echo "<td>".$user_name."</td>";
				echo "<td>".$email."</td>";
				echo "<td>".$phone."</td>";
				echo "<td>"if($user_type == 2): 'Houseowner' else: 'Client' endif;"</td>";
				echo "<td>".$address."</td>";
				echo "<td>""<a type='submit' href='users.php?id=$user_id'></a>""</td>";
				echo "</tr>";
			}
		}
	}

	function getListings() {
		global $connection;
		$i = 0;
		$all_listings = mysqli_query($connection, "SELECT * FROM listing ORDER BY id DESC");
		if(mysqli_num_rows($all_listings) > 0) {
			while($row = mysqli_fetch_assoc($all_listings)) {
				$listing_id = $orw['id'];
				$listing_name = $row['name'];
				$listing_price = $row['price'];
				$listing_location = $row['location'];
				$listing_bedrooms = $row['bedrooms'];
				$listing_image = $row['image'];
				$listing_type = $row['type'];
				$user = $row['user_id'];

				echo "tr";
				echo "<td>".$i++."</td>";
				echo "<td>".$listing_name."</td>";
				echo "<td>".$listing_price."</td>";
				echo "<td>".$listing_location."</td>";
				echo "<td>".$listing_bedrooms."</td>";
				echo "<td>".$listing_image."</td>";
				echo "<td>".$listing_type."</td>";
				echo "<td>""<a type='submit' href='listings.php?id=$listing_id'></a>""</td>";
				echo "</tr>";
			}
		}
	}
?>