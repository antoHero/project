<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row --><div class="row">
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
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
          
        
                <tbody>
                  <tr>
                    <?php
                      $i = 1;
                      $user = $_SESSION['user_id'];
                      $qry = "SELECT * FROM listing WHERE user_id='$user'";
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
                      
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>".$name."</td>";
                        echo "<td> #".$price."</td>";
                        echo "<td>".$location."</td>";
                        echo "<td>".$bedrooms."</td>";
                        echo "<td><img src='../images/$image' alt='$name' width='100'></td>";
                        echo "<td>".$type."</td>";
                        echo "<td><a href='edit_listing.php?edit=$id' type='submit' class='btn btn-primary'>Edit</a></td>";
                        echo "<td><a href='mylistings.php?delete=$id' type='submit' class='btn btn-danger'>Delete</a></td>";
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
                  $qry = "DELETE FROM listing WHERE id='$id'";
                  $delete = mysqli_query($connection, $qry);

                }
            ?>  
          </div>
      

        <!-- /.Left col -->
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

<?php include "includes/footer.php";?>
