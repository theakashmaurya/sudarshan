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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Add New Post - Sudarshan</title>
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
          <a href="posts.php">Posts</a>
        </li>
        <li class="breadcrumb-item active">Add New</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <form action="action/add_post.php" enctype="multipart/form-data" method="POST">

            <div class="form-group">
              <label>Post Title*</label>
              <input class="form-control" type="text" name="title" required="">
            </div>

            <div class="form-group">
              <label>Featured Image* (Max file size: 5 MB)</label>
              <input id='upload' class="form-control" name="fileToUpload" type="file">
            </div>

            <div class="form-group">
              <label>Content</label>
              <textarea class="form-control" id="content" name="content"></textarea>
            </div>

            <div class="form-group">
              <label>Status*</label>
              <select class="form-control" name="status">
                <option value="P">Publish Post</option>
                <option value="D">Save as Draft</option>
              </select>
            </div>

            <input type="submit" class="btn btn-success" value="Add">

          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('inc/footer.php'); ?>
  </div>
  <script src="assets/ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'content' );
  </script>
</body>

</html>
