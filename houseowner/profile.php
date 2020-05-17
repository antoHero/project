<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1373.62px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php 
        if(isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];

        }
      ?>
      <h1>
        My Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content align-center">
      <!-- Main row -->
      <div class="row">
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <div class="text-center">

                  <?php 
                  $result = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id'");
                  if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $user = $row['id'];
                    $name = $row['firstname'] ." ". $row['lastname'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $image = $row['image'];
                    $location = $row['address'];
                    $about = $row['about'];
                  
                ?>
                <?php 
                  if($image != NULL) {
                    echo "<img class='profile-user-img img-fluid img-circle' src='../images/".$image."' alt='$name profile picture'>";
                  } else {
                   echo "<img class='profile-user-img img-fluid img-circle' src='dist/img/user4-128x128.jpg' alt='$name profile picture'>";
                  }
                ?>
                </div>
                
                <h3 class="profile-username text-center"><?php echo $name; ?></h3>

                <p class="text-muted text-center">Houseowner</p>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Location</th>
                      <th>Phone</th>
                      <th>About</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $location; ?></td>
                      <td><?php echo $phone; ?></td>
                      <td><?php echo substr($about, 5) ;?></td>
                    </tr>
                  </tbody>
                </table>
                
                <?php echo "<a href='edit.php?user=$user_id' type='submit' class='btn btn-primary btn-block'><b>Edit Profile</b></a>";?>
                <?php 
                  } 
                  else {
                    echo "User with ID not found";
                  }
                ?>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
      

        <!-- /.Left col -->
        
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

<?php include "includes/footer.php";?>
