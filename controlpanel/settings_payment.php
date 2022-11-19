<?php

  session_start();
  ob_start();

  require_once('../config/dblib.php');

  if(!isset($_SESSION['userid'])){

     header('location:index.php');

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

  $instance1 = new DatabaseLib();

  $connStatus1 = $instance1->createConnection();

  if ($connStatus1 == true) {

    $getResults1= $instance1->getData("SELECT * FROM `settings`");

    if($getResults1 != false){
      while ($getResults_row1 = mysqli_fetch_array($getResults1)) {

        if ($getResults_row1['sett_option']=="paymentlink") {

          $paymentlink=$getResults_row1['sett_value'];
        }

      }
    }
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
  <title>Payment Setting - Sudarshan</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="icon" href="assets/images/fevicon.png" sizes="96x96" type="image/png">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('inc/nav.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Settings</a>
        </li>
        <li class="breadcrumb-item active">All</li>
      </ol>

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="settings.php"><i class="fa fa-info-circle"></i> About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="settings_sms.php"><i class="fa fa-info-envelope"></i> SMS Notifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="settings_payment.php"><i class="fa fa-info-money"></i>Payment Setting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="change-password.php"><i class="fa fa-info-lock"></i> Change Password</a>
        </li>
      </ul>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p>
        </div>
        <div class="card-body">
          <form action="action/update_paymentlink.php" method="POST">

            <div class="form-group">
              <label>Enter Payment Link*</label>
              <input class="form-control" type="text" name="paymentlink" value="<?= $paymentlink; ?>" required="">
            </div>

            <button class="btn btn-primary">Save Changes</button>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('inc/footer.php'); ?>
  </div>
</body>
</html>
