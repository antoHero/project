<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>
<?php
session_start();
if(isset($_SESSION['type']) != 1) {
  die('You do not have access to this page');
}
?>
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
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-stripped">
              <thead>
                <tr>
                  <th>S/No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Type</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Delete</th>
                </tr>
          
        
                <tbody>
                    <?php
                      $i = 1; //to increment the S/NO

                      $houseowner = "Houseowner";
                      $admin = "Admin";
                      //fetch all the users
                      $qry = "SELECT * FROM users ORDER BY id DESC";
                      $result = mysqli_query($connection, $qry);
                      if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $name = $row['firstname'] ." ". $row['lastname'];
                          $email = $row['email'];
                          $phone = $row['phone'];
                          $type = $row['user_type'];
                          $image = $row['image'];
                          $address = $row['address'];

                          if($type == 2)  {
                            $type = $houseowner;
                          }
                          if($type == 1) {
                            $type = $admin;
                          }

                      
                          echo "<tr>";
                          echo "<td>".$i++."</td>";
                          echo "<td>".$name."</td>";
                          echo "<td> ".$email."</td>";
                          echo "<td>".$phone."</td>";
                          echo "<td>".$type."</td>";
                          echo "<td>".$address."</td>";
                          echo "<td><img src='../images/".$image."' alt='$name' width='100'></td>";
                          echo "<td><a href='users.php?delete=$id' type='submit' class='btn btn-danger'>Delete</a></td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </thead>
            </table> 
            <?php }
              else {
                echo "<p class='alert alert-danger'>No users have registered </p>";
              }
            ?> 
            <?php
              if(isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete = "DELETE FROM users WHERE id='$id'";
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
