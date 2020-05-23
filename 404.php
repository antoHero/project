<?php require("includes/locations.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Real Estate Management</title>
<?php include('includes/header.php');?>

	

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin: 10px 50px 0 50px; padding: 50px;">

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="index.php">go back to home</a> or try using the search form.
          </p>

          <form class="search-form" action="search_results.php" method="POST">
            <div class="input-group">
              <input type="text" name="location" class="form-control" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" name="search" name="submit" class="btn btn-warning">Search
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
          <?php
            if(isset($_GET['search'])) {
              $location = $_GET['location'];
              // $name = $_POST['search'];
              $search_query = mysqli_query($connection, "SELECT * FROM listing WHERE location LIKE '%".$location."%'");
              if(mysqli_num_rows($search_query) > 0) {
                while ($search_row = mysqli_fetch_assoc($search_query)) {

                  echo "<div><a href='property.php?id=".$search_row['id']."&user=".$search_row['user_id']."'> ".$search_row['name']." </a></div>";
                }
              } else {
                header('location: 404.php');
              }
            } else {
              header('location: index.php');
            }
          ?>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>

	<!-- Footer -->

	