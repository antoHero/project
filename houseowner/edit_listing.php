<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>
<?php require("../includes/locations.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Listing
      </h1>
      <?php
                  
        if(isset($_GET['edit'])) {
          $the_list_id = $_GET['edit'];
          // echo $the_post_id;
        }
        
        $query = "SELECT * FROM listing WHERE id='$the_list_id'";
        $select_by_id = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_by_id)) {
            $id = $row['id'];
            $listing_name = $row['name'];
            $listing_price = $row['price'];
            $listing_location = $row['location'];
            $listing_bedrooms = $row['bedrooms'];
            $listing_image = $row['image'];
            $listing_type = $row['type'];
            $listing_description = $row['description'];
            $listing_area = $row['area'];
            $listing_garage = $row['garage'];
            $listing_bathroom = $row['bathroom'];
          }
      ?>

      <?php

        //set target directory where images will be saved and error messages
      $target_dir = 'http://127.0.0.1:8888/project/images/';
     
      if(isset($_POST['update_post'])) {
        //create form fields
        $name = $_POST['name'];
        $price = $_POST['price'];
        $bedrooms = $_POST['bedrooms'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $bathroom = $_POST['bathroom'];
        $garage = $_POST['garage'];
        $area = $_POST['area'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target = "../images/".basename($image);

        //get user id that is adding a listing
        $user =  $_SESSION['user_id'];
        
          //move image file to target_dir and update the other fields
         if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $qry = "UPDATE listing SET ";
            $qry .= "name = '$name', ";
            $qry .= "price ='$price', ";
            $qry .= "bedrooms ='$bedrooms', ";
            $qry .= "location ='$location', ";
            $qry .= "image ='$image', ";
            $qry .= "description ='$description', ";
            $qry .= "type ='$type', ";
            $qry .= "bathroom ='$bathroom', ";
            $qry .= "area ='$area', ";
            $qry .= "garage ='$garage' ";
            $qry .= "WHERE id='$the_list_id'";

            $updateListing = mysqli_query($connection, $qry);
            // var_dump($updateListing);
            if($updateListing) {
              $_SESSION['success'] = "Listing successfully updated";
              header('location: mylistings.php');
              // echo "Listing updated successfully";
              
            } 
            else {
              die("An error occured: " . mysqli_error($connection));
            }
          } 
          else {
              die("Some error occured: " . mysqli_error($connection));
          }
      } 

      ?>

      <?php

        if(isset($_SESSION['success'])) {
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        }

        elseif(isset($_SESSION['error'])) {
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        }

        else {
          echo "";
        }


      ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->


          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">

              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                
                <p></p>
                <div class="form-group">
                  <input type="text" value="<?php echo $listing_name; ?>" class="form-control" name="name" placeholder="Name:">
                </div>
                <div class="form-group">
                  <input type="text" value="<?php echo $listing_price; ?>" class="form-control" name="price" placeholder="Price:">
                </div>
                <div class="form-group">
                  <select class="form-control" name="bedrooms">
                    <option selected="selected"><?php echo $listing_bedrooms; ?></option>
                    <?php 
                      foreach($rooms as $room){
                    ?>
                  <option value="<?php echo $room; ?>"><?php echo $room; ?></option>
                <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="location">
                    <option selected="selected"><?php echo $listing_location; ?></option>
                    <?php 
                      foreach($locations as $location){
                    ?>
                  <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
                <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <img src="../images/<?php echo $listing_image;?>" width="100" style="margin-bottom: 10px;">
                  <input type="file" class="form-control" name="image">
                  <small>Allowed types: .jpg, .JPG, .jpeg, .JPEG, .png, .PNG *</small>
                </div>
                <div class="form-group">
                  <textarea name="description" class="form-control" placeholder="Description:"><?php echo $listing_description; ?></textarea>
                </div>
                <div class="form-group">
                  <select class="form-control" name="type">
                    <option selected="selected">For <?php echo $listing_type; ?></option>
                    <option value="Rent">For Rent</option>
                    <option value="Sale">For Sale</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" value="<?php echo $listing_area; ?>" class="form-control" name="area" placeholder="Area:">
                </div>
                <div class="form-group">
                  <input type="text" value="<?php echo $listing_garage; ?>" class="form-control" name="garage" placeholder="Garage:">
                </div>
                <div class="form-group">
                  <input type="text" value="<?php echo $listing_bathroom; ?>" class="form-control" name="bathroom" placeholder="Bathrooms:">
                </div>

                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-primary" id="sendEmail" name="update_post">Update
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </form>
            </div>
            
          </div>

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

<?php include "includes/footer.php";?>
