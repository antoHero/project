<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>
<?php require("../includes/locations.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add listing
      </h1>

      <?php

        //set target directory where images will be saved and error messages
      $target_dir = 'http://127.0.0.1:8888/project/images/';
      $nameErr = $priceErr = $bedroomErr = $locationErr = $imageErr = $imageFileTypeErr = $imageSizeErr = $descriptionErr = $typeErr = $areaErr = $bathroomErr = $garageErr =  "";
      if($_SERVER['REQUEST_METHOD'] == "POST") {
        //create form fields
        $name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
        $price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
        $bedrooms = htmlentities($_POST['bedrooms'], ENT_QUOTES, 'UTF-8');
        $location = htmlentities($_POST['location'], ENT_QUOTES, 'UTF-8');
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $type = htmlentities($_POST['type'], ENT_QUOTES, 'UTF-8');
        $area = htmlentities($_POST['area'], ENT_QUOTES, 'UTF-8');
        $garage = htmlentities($_POST['garage'], ENT_QUOTES, 'UTF-8');
        $bathroom = htmlentities($_POST['bathroom'], ENT_QUOTES, 'UTF-8');
        $image = $_FILES['image']['name'];
        $target = "../images/".basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        //get user id that is add a listing
        $user =  $_SESSION['user_id'];


        //if fields are empty, create validation errors
        if(empty($name)) {
          $nameErr = "Please enter name of listing";
        }

        if(empty($price)) {
          $priceErr = "Please enter price";
        }

        if(empty($bedrooms)) {
          $bedroomErr = "Enter no. of rooms";
        }

        if(empty($location)) {
          $locationErr = "Please enter location of listing";
        }

        if(empty($type)) {
          $typeErr = "Specify if house is for sale or rent";
        }

        if(empty($area)) {
          $areaErr = "Specify the measurement of property";
        }

        if(empty($garage)) {
          $garageErr = "Does property have a garage? if No type in 0";
        }

        if(empty($bathroom)) {
          $bathroomErr = "How many bathrooms are in the property?";
        }
        //check image upload size, dont allow if it is larger than 2mb. Then set upload ok to 0
        if($_FILES['image']['size'] > 200000) {
          $imageSizeErr = "Image is too large";
          $uploadOk = 0;
        }
        //check if image types are allowed, if not set uploadok to 0
        // if($imageFileType != 'jpg' || $imageFileType != 'JPG' || $imageFileType != 'jpeg' || $imageFileType != 'JPEG' || $imageFileType != 'png' || $imageFileType != 'PNG') {
        //   $imageFileTypeErr = "This is not a valid image type";
        //   $uploadOk = 0;
        // } 
        //if everything is ok and no errors 
        else {
          //move image file to target_dir
          if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $qry = "INSERT INTO listing(name, price, bedrooms, location, image, description, type, user_id, bathroom, area, garage) ";
            $qry .= "VALUES('$name', '$price', '$bedrooms', '$location', '$image', '$description', '$type', '$user', '$bathroom', '$area', '$garage')";
            $saveListing = mysqli_query($connection, $qry);
            if($saveListing) {
              //$_SESSION['success'] = "Listing added successfully";
              echo "Listing added successfully";
            } else {
              //$_SESSION['error'] = "An error occured" . mysqli_error($connection);
              echo "An error occured" . mysqli_error($connection);
            }
          } else {
            echo "Some kind of error has occurred" . mysqli_connect_error($connection);
          }
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
                <span>All fields are required *</span>
                <p></p>
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Name:">
                </div>
                <?php 
                  if($nameErr) {
                    echo "<strong style='color:red;'>".$nameErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <input type="text" class="form-control" name="price" placeholder="Price:">
                </div>
                <?php 
                  if($priceErr) {
                    echo "<strong style='color:red;'>".$priceErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <select class="form-control" name="bedrooms">
                    <option selected="selected">Number of bedrooms</option>
                    <?php 
                      foreach($rooms as $room){
                    ?>
                  <option value="<?php echo $room; ?>"><?php echo $room; ?></option>
                <?php } ?>
                  </select>
                </div>
                <?php 
                  if($bedroomErr) {
                    echo "<strong style='color:red;'>".$bedroomErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <select class="form-control" name="location">
                    <option selected="selected">Choose location</option>
                    <?php 
                      foreach($locations as $location){
                    ?>
                  <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
                <?php } ?>
                  </select>
                </div>
                <?php 
                  if($locationErr) {
                    echo "<strong style='color:red;'>".$locationErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <input type="text" value="" class="form-control" name="area" placeholder="Meaurement in square meter:">
                </div>
                <?php 
                  if($areaErr) {
                    echo "<strong style='color:red;'>".$areaErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <input type="text" value="" class="form-control" name="garage" placeholder="Garage:">
                </div>
                <?php 
                  if($garageErr) {
                    echo "<strong style='color:red;'>".$garageErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <input type="text" value="" class="form-control" name="bathroom" placeholder="Bathrooms:">
                </div>
                <?php 
                  if($bathroomErr) {
                    echo "<strong style='color:red;'>".$bathroomErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <input type="file" class="form-control" name="image">
                  <small>Allowed types: .jpg, .JPG, .jpeg, .JPEG, .png, .PNG *</small>
                </div>
                <?php 
                  if($imageErr) {
                    echo "<strong style='color:red;'>".$imageErr."</strong>";
                  } 
                  elseif($imageSizeErr) {
                    echo "<strong style='color:red;'>".$imageSizeErr."</strong>";
                  } 
                  // elseif($imageFileTypeErr) {
                  //   echo "<strong style='color:red;'>".$imageFileTypeErr."</strong>";
                  // }
                  else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <textarea name="description" class="form-control" placeholder="Description:"></textarea>
                </div>
                <?php 
                  if($descriptionErr) {
                    echo "<strong style='color:red;'>".$descriptionErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>
                <div class="form-group">
                  <select class="form-control" name="type">
                    <option selected="selected">Type of Listing</option>
                    <option value="Rent">For Rent</option>
                    <option value="Sale">For Sale</option>
                  </select>
                </div>
                <?php 
                  if($typeErr) {
                    echo "<strong style='color:red;'>".$typeErr."</strong>";
                  } else {
                    echo "";
                  }
                ?>

                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-primary" id="sendEmail" name="submit">Add
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
