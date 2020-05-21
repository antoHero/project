<?php 
  include "db/db.php";
?>
<?php
  $firstnameErr = $lastnameErr = $addressErr = $phoneErr = $emailErr = $passwordErr = $confirmErr = $typeErr = "";

  //sanitize form inputs
  function sanitize_data($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

//Check if register button is set
if(isset($_POST['submit'])) {
  //create form fields
  

  //if errors exists
  if(empty($_POST['firstname'])) {
    $firstnameErr = "Please enter your firstname";
  } else {
    $firstname = sanitize_data($_POST['firstname']);
  }
  if(empty($_POST['lastname'])) {
    $lastnameErr = "Please enter your lastname";
  } else {
    $lastname = sanitize_data($_POST['lastname']);
  }
  if(empty($_POST['address'])) {
    $addressErr = "Please enter a valid address";
  } else {
    $address = sanitize_data($_POST['address']);
  }
  if(empty($_POST['phone'])) {
    $phoneErr = "Please enter your phone number";
  } else {
    $phone = sanitize_data($_POST['phone']);
  }
  if(empty($_POST['email'])) {
    $emailErr = "Please enter your email address";
  } else {
    $email = sanitize_data($_POST['email']);
  }
  if(empty($_POST['password'])) {
    $passwordErr = "Please enter your password";
  } else {
    $password = sanitize_data($_POST['password']);
    $hashFormat = "$2y$10$";
    $salt = 'iusesomecrazystrings22';
    $hashF_and_salt = $hashFormat . $salt;
    $password = crypt($password, $hashF_and_salt);
  }
  if(empty($_POST['confirm_password']) || $_POST['confirm_password'] != $_POST['password']) {
    $confirmErr = "Passwords do not match";
  } else {
    $confirm_password = sanitize_data($_POST['confirm_password']);
  } 

  //if no errors exists check if email is already registered
    $qry = mysqli_query($connection, "SELECT * FROM users WHERE email ='$email'");
    //if found
    if(mysqli_num_rows($qry) > 0) {
      echo "<p class='alert alert-danger'>Email has already been reegistered.</p>";
    }
    //if email address has not been registered, proceed with registration. 
  else {
    $sql = "INSERT INTO users(firstname, lastname, email, phone, password, address) VALUES('$firstname', '$lastname', '$email', '$phone', '$password', '$address')";
    // $insert_user = mysqli_query($connection, $sql);
    if($connection->query($sql) === TRUE) {
      echo "<p class='alert alert-success text-center'>Congratulations, You have successfully registered</p>";
    } else {
       echo "<p class='alert alert-danger text-center'>Sorry, your registration was not successful</p>" . mysqli_error($connection);
    }
  }

}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registration Page</title>
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
    <p class="login-box-msg">Register a new membership</p>

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="firstname" placeholder="First Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="address" placeholder="User Address">
        <span class="glyphicon glyphicon-house form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="phone" placeholder="Phone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="confirm_password" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

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
