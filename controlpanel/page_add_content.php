<?php

  session_start();
  ob_start();

  require_once('../config/dblib.php');

  if(!isset($_SESSION['userid'])){

     header('location:index.php');

  }

  if(!isset($_SESSION['curr_page_id'])){

     header('location:pages.php');

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

  if (!isset($_POST['type'])) {

    header('location:pages.php');
  }
  else{

    $widget_type=$_POST['type'];
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
  <title>Add Content to Page - Sudarshan</title>
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
          <a href="pages.php">Pages</a>
        </li>
        <li class="breadcrumb-item active">Add Content</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">

          <?php

          if ($widget_type == "Button") {

            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="subheading" value="">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <div class="form-group">
                <label>Button Text*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Link*</label>
                <input class="form-control" type="text" name="content" required="">
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php
            
          }
          elseif ($widget_type == "Blog Post") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <div class="form-group">
                <label>Number of Posts*</label>
                <input class="form-control" type="number" name="content" value="3" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Call to Action") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea class="form-control" name="content"></textarea>
              </div>

              <div class="form-group">
                <label>Button Text*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <div class="form-group">
                <label>Button Link*</label>
                <input class="form-control" type="text" name="image" required="">
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }
          elseif ($widget_type == "Features") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="subheading" value="">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Features (Seprate by comma)*</label>
                <textarea class="form-control" name="content"></textarea>
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="#ffffff" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "HTML or Javascript") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="subheading" value="">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="bgcolor" value="">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>HTML or Javascript Snippet*</label>
                <textarea class="form-control" name="content"></textarea>
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Image") {
            ?>

            <form action="action/add_content_to_page.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="subheading" value="">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="bgcolor" value="">

              <input type="hidden" name="content" value="">

              <div class="form-group">
                <label>Choose File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>Caption*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Page Cover") {
            ?>

            <form action="action/add_content_to_page.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="bgcolor" value="">

              <input type="hidden" name="content" value="">

              <div class="form-group">
                <label>Choose File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Photo Gallery") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="bgcolor" value="">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <div class="form-group">
                <label>Select Gallery*</label>
                <select class="form-control" name="content">
                  <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `widgets` WHERE `type`='Photo Gallery'");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        
                        <option value="<?= $getResults_row['id']; ?>"><?= base64_decode($getResults_row['title']); ?></option>

                        <?php

                      }
                    }
                  }
                ?>
                </select>
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Slider") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="image" value="">

              <input type="hidden" name="fgcolor" value="">

              <input type="hidden" name="bgcolor" value="">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Select Slider*</label>
                <select class="form-control" name="content">
                  <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `widgets` WHERE `type`='Slider'");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        
                        <option value="<?= $getResults_row['id']; ?>"><?= base64_decode($getResults_row['title']); ?></option>

                        <?php

                      }
                    }
                  }
                ?>
                </select>
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Text") {
            ?>

            <form action="action/add_content_to_page.php" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="image" value="">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea id="contentbox" class="form-control" name="content" required=""></textarea>
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="#000000" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="#ffffff" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }

          elseif ($widget_type == "Text With Image") {
            ?>

            <form action="action/add_content_to_page.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="pageid" value="<?= $_SESSION['curr_page_id']; ?>">

              <input type="hidden" name="orderno" value="1">

              <input type="hidden" name="type" value="<?= $widget_type; ?>">

              <input type="hidden" name="image" value="">

              <div class="form-group">
                <label>Choose File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea id="contentbox" class="form-control" name="content" required=""></textarea>
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="#000000" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="#ffffff" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add">

            </form>

          <?php

          }



          ?>


        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('inc/footer.php'); ?>
  </div>

   <script src="assets/ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'contentbox' );
  </script>
</body>

</html>
