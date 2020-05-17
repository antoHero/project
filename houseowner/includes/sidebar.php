 <!-- Left side column. contains the logo and sidebar -->
 <?php
  session_start();
 ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php
        if(isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
        }
          $user = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id'");
          while($row = mysqli_fetch_assoc($user)) {
            $image = $row['image'];

          }            
      ?>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/<?php echo $image;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user'])) {

              


              ?>
              <span class="hidden-xs"><?php echo $_SESSION['user'];?></span>
            <?php } ?>
            <p></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Property</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_property.php"><i class="fa fa-circle-o"></i> Add Listing</a></li>
            <li><a href="mylistings.php"><i class="fa fa-circle-o"></i> My Listings </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile.php"><i class="fa fa-circle-o"></i> View </a></li>
            <li><a href="edit.php"><i class="fa fa-circle-o"></i> Edit</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>