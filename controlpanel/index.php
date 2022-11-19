<?php

session_start();
ob_start();

if(isset($_SESSION['userid'])){

   header('location:dashboard.php');
}

if (!isset($_GET['msgtype'])) {
  $msgtype="";
}
else {
  $msgtype=$_GET['msgtype'];
}

if (!isset($_GET['msg'])) {
  $msg="";
}
else{
  $msg=$_GET['msg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login - Sudarshan</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="icon" href="assets/images/fevicon.png" sizes="96x96" type="image/png">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><a href="http://labs.codebrother.in/p/cb-placemento.html" target="_blank"><img src="assets/images/logo-dark.png" height="60px" class="mx-auto d-block"></a></div>
      <div class="card-body">
        <p class="<?= $msgtype; ?>"><?= $msg; ?></p>
        <form action="action/checklogin.php" method="POST">
          <div class="form-group">
            <label>Email address</label>
            <input class="form-control" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="" target="_blank"><i class="fa fa-question-circle"></i> Forgot Password?</a>
        </div>
        <!--<div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>-->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
