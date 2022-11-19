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

    $getResults1= $instance1->getData("SELECT * FROM `posts` WHERE `id`=".$_POST['id']);

    if($getResults1 != false){
      while ($getResults_row1 = mysqli_fetch_array($getResults1)) {

        $id=$getResults_row1['id'];
        $title=$getResults_row1['title'];
        $slug=$getResults_row1['slug'];
        $content=$getResults_row1['content'];
        $image=$getResults_row1['image'];
        $status=$getResults_row1['status'];
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
  <title>Edit Post - Sudarshan</title>
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
        <li class="breadcrumb-item active">Edit</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <form action="action/edit_post.php" enctype="multipart/form-data" method="POST">

            <input type="hidden" value="<?= $image; ?>" name="oldimage">

            <input type="hidden" value="<?= $id; ?>" name="id">

            <div class="form-group">
              <label>Post Title*</label>
              <input class="form-control" type="text" name="title" value="<?= base64_decode($title); ?>" required="">
            </div>

            <div class="form-group">
              <label>Featured Image* (Max file size: 5 MB)</label>
              <input id='upload' class="form-control" name="fileToUpload" type="file">
            </div>

            <div class="form-group">
              <label>Current image</label>
              <p><img src="uploads/<?= $image; ?>" width="250px"></p>
            </div>

            <div class="form-group">
              <label>Content</label>
              <textarea class="form-control" id="content" name="content"><?= base64_decode($content); ?></textarea>
            </div>

            <div class="form-group">
              <label>Status*</label>
              <select class="form-control" name="status">
                <option value="P" <?php if($status=="P"){ echo 'selected'; } ?>>Publish Post</option>
                <option value="D" <?php if($status=="D"){ echo 'selected'; } ?>>Save as Draft</option>
              </select>
            </div>

            <input type="submit" class="btn btn-success" value="Save Changes">

          </form>
        </div>
      </div>

      <div class="card mb-3" style="background-color:#ff9696 !important;">
          <div class="card-header">
            <i class="fa fa-trash"></i> Delete</div>
          <div class="card-body">
              <form action="action/del_post.php" method="POST">
                <input type="hidden" value="<?= $_POST['id']; ?>" name="id">
                <input type="hidden" value="<?= $image; ?>" name="image">
                <div class="form-group">
                <label>Do you want to remove this post permanently?</label>
                <select class="form-control" name="del_response">
                  <option value="no" selected>NO</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
