<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Admin Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h3 class="text-center">All Listings</h3>
      <br>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-stripped">
              <thead>
                <tr>
                  <th>S/No</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Location</th>
                  <th>Bedrooms</th>
                  <th>Image</th>
                  <th>Type</th>
                  <th>Posted By</th>
                  <th>Delete</th>
                </tr>
          
        
                <tbody>
                    <?php
                      $i = 1; //to increment the S/NO

                      //fetch all the listings
                      $qry = "SELECT * FROM listing ORDER BY id DESC";
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
                          $user = $row['user_id'];

                          //fetch the user that posted the listing
                          $get_user = mysqli_query($connection, "SELECT * FROM users WHERE id='$user'");
                          $user_row = mysqli_fetch_assoc($get_user);
                          $username = $user_row['firstname'] ." ". $user_row['lastname'];
                      
                          echo "<tr>";
                          echo "<td>".$i++."</td>";
                          echo "<td>".$name."</td>";
                          echo "<td> #".$price."</td>";
                          echo "<td>".$location."</td>";
                          echo "<td>".$bedrooms."</td>";
                          echo "<td><img src='../images/$image' alt='$name' width='100'></td>";
                          echo "<td>".$type."</td>";
                          echo "<td>".$username."</td>";
                          echo "<td><a href='listings.php?delete=$id' type='submit' class='btn btn-danger'>Delete</a></td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </thead>
            </table> 
            <?php }
              else {
                echo "<p class='alert alert-danger'>You don't have any listings </p>";
              }
            ?> 
            <?php
              if(isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete = "DELETE FROM listing WHERE id='$id'";
                mysqli_query($connection, $delete);
              }
            ?>
        </div> 
      </div>
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

<?php include "includes/footer.php";?>
