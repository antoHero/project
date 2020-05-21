<?php 
  include "db/db.php";
?>
<?php
session_start();
  $email = $password = "";
  $emailErr = $passwordErr = "";
  //sanitize data
  function sanitize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;

  }
//Check if register button is set
if($_SERVER['REQUEST_METHOD'] == 'POST') {

  //if errors exists
  if(empty($_POST['email'])) {
    $emailErr = "Please enter your firstname";
  } else {
    $email = sanitize_data($_POST['email']);
  }
  if(empty($_POST['password'])) {
    $passwordErr = "Please enter your password";
  } else {
    $password = $_POST['password'];
  }
  //if no errors exists, check if the email address is correct
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($connection, $sql) or die(mysql_error());

  //if email address is found
  if(mysqli_num_rows($result) == 1) {
    //store all user details in an array
    $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row['password'])) 
        if($row['user_type'] == 1) {
        if(!session_id())
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['lastname'];
        $_SESSION['logon'] = 'admin';
        header('location: admin/users.php');
        exit();
      } else {
        if(!session_id())
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['lastname'];
        $_SESSION['logon'] = 'owner';
        header('location: houseowner');
        exit();
      }
      
    } 
   else {
    echo "<p class='alert alert-danger'>Email/Password Combination Incorrect</p>" . $connection->error;
  }

  

}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>HMS</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Log into your account</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <?php
        if($emailErr) {
          echo "<strong style='color:red;'>".$emailErr."</strong>";
        } else {
          echo "";
        }
      ?>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <?php
        if($passwordErr) {
          echo "<strong style='color:red;'>".$passwordErr."</strong>";
        } else {
          echo "";
        }
      ?>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Keep me signed in
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="register.php" class="text-center">I don't have an account</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
