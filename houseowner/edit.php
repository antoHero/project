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
      <?php
        //fetch all details belonging to the user
        $result = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id'");
        while($row = mysqli_fetch_assoc($result)) {
          $user_firstname = $row['firstname'];
          $user_lastname = $row['lastname'];
          $user_email = $row['email'];
          $user_phone = $row['phone'];
          $user_image = $row['image'];
          $user_address = $row['address'];
          $user_about = $row['about'];
          $user_password = $row['password'];
          $user_image = $row['image'];
        }

      ?>
      <?php

        //set target directory where images will be saved and error messages
      $target_dir = 'http://127.0.0.1:8888/project/images/';
     
      if(isset($_POST['submit'])) {
        //create form fields
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $about = $_POST['about'];
        $image = $_FILES['image']['name'];
        $password = $_POST['password'];
        $target = "../images/".basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        //get user id that add a listing
        $user =  $_SESSION['user_id'];
        
          //move image file to target_dir
         if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $qry = "UPDATE users SET ";
            $qry .= "firstname = '$firstname', ";
            $qry .= "lastname ='$lastname', ";
            $qry .= "email ='$email', ";
            $qry .= "phone ='$phone', ";
            $qry .= "image ='$image', ";
            $qry .= "address ='$address', ";
            $qry .= "about ='$about' ";
            $qry .= "WHERE id='$user_id'";
            $updateUser = mysqli_query($connection, $qry);
            // var_dump($updateListing);
            if($updateUser) {
              if($user_password == $password) {
                $_SESSION['success'] = "Profile updated successfully";
                header('location: profile.php');
              } else {
                echo "Passwords do not match";
              }
              
              // echo "Listing updated successfully";
              
            } 
            else {
              die("An error occured: " . mysqli_error($connection));
            }
          }else {

              echo("Some error occured: " . mysqli_error($connection));
            }
      } 

      ?>
      <h1>
        Edit Profile
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  
                
                </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <span>All fields are required *</span>
                <p></p>
                <div class="form-group">
                  <input type="text" class="form-control" name="firstname" value="<?php echo $user_firstname; ?>" >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="lastname" value="<?php echo $user_lastname; ?>">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="<?php echo $user_email; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="phone" value="<?php echo $user_phone; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="address" value="<?php echo $user_address; ?>">
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" name="image">
                  <small>Allowed types: .jpg, .JPG, .jpeg, .JPEG, .png, .PNG *</small>
                </div>
                <div class="form-group">
                  <textarea name="about" class="form-control" value="<?php echo $user_about; ?>"></textarea>
                </div>
                <div class="form-group">
                  <label for="Password">Enter Password to proceed</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password:">
                </div>
                

                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-primary" id="sendEmail" name="submit">Go
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </form>
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
