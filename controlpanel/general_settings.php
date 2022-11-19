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

        if ($getResults_row1['sett_option']=="sitename") {

          $sitename=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="sitetagline") {

          $sitetagline=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="headercode") {

          $headercode=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="whatsapp") {

          $whatsapp=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="phone") {

          $phone=$getResults_row1['sett_value'];
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
  <title>General Settings - Sudarshan</title>
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
          <a href="#">Customization</a>
        </li>
        <li class="breadcrumb-item active">General Settings</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <form action="action/update_sitename.php" method="POST">

            <div class="form-group">
              <label>Site Title*</label>
              <input class="form-control" type="text" name="title" value="<?= base64_decode($sitename); ?>" required="">
            </div>

            <div class="form-group">
              <label>Site Tagline</label>
              <input class="form-control" type="text" value="<?= base64_decode($sitetagline); ?>" name="tagline">
            </div>

            <div class="form-group">
              <label>Whatsapp Chat Number (Prefix Country Code 'i.e. 91')</label>
              <input class="form-control" type="text" value="<?= $whatsapp; ?>" name="whatsapp">
            </div>

            <div class="form-group">
              <label>Phone Number</label>
              <input class="form-control" type="text" value="<?= $phone; ?>" name="phone">
            </div>

            <div class="form-group">
              <label>Header Code</label>
              <textarea class="form-control" name="headercode"><?= base64_decode($headercode); ?></textarea>
            </div>

            <input type="submit" class="btn btn-success" value="Save Changes">

          </form>
        </div>
      </div>

       <div class="card mb-3">
        <div class="card-body">
          <form action="action/upload_logo.php" enctype="multipart/form-data" method="POST">

            <div class="form-group">
              <label>Logo.png (Max-size: 200px X 65px)</label>
              <input id='upload' class="form-control" name="fileToUpload" type="file">
            </div>

            <input type="submit" class="btn btn-success" value="Save Changes">

          </form>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-body">
          <form action="action/upload_favicon.php" enctype="multipart/form-data" method="POST">

            <div class="form-group">
              <label>Fevicon.png (Max-size: 128px X 128px)</label>
              <input id='upload' class="form-control" name="fileToUpload" type="file">
            </div>

            <input type="submit" class="btn btn-success" value="Save Changes">

          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('inc/footer.php'); ?>
  </div>
</body>

</html>
