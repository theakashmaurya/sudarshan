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

  $instance1 = new DatabaseLib();

  $connStatus1 = $instance1->createConnection();

  if ($connStatus1 == true) {

    $getResults1= $instance1->getData("SELECT * FROM `contents` WHERE `id`=".$_POST['id']);

    if($getResults1 != false){
      while ($getResults_row1 = mysqli_fetch_array($getResults1)) {

        $id=$getResults_row1['id'];
        $type=$getResults_row1['type'];
        $image=$getResults_row1['image'];
        $heading=$getResults_row1['heading'];
        $subheading=$getResults_row1['subheading'];
        $content=$getResults_row1['content'];
        $bgcolor=$getResults_row1['bgcolor'];
        $fgcolor=$getResults_row1['fgcolor'];
        $pageid=$getResults_row1['pageid'];
        $orderno=$getResults_row1['orderno'];
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
  <title>Edit Page Content - Sudarshan</title>
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
        <li class="breadcrumb-item active">Edit Page Content</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">

          <?php

          if ($type == "Button") {

            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="subheading" value="<?= base64_decode($subheading) ?>">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <div class="form-group">
                <label>Button Text*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading) ?>" required="">
              </div>

              <div class="form-group">
                <label>Link*</label>
                <input class="form-control" type="text" name="content" value="<?= base64_decode($content) ?>" required="">
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="<?= $fgcolor; ?>" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php
            
          }
          elseif ($type == "Blog Post") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading) ?>" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" value="<?= base64_decode($subheading) ?>" required="">
              </div>

              <div class="form-group">
                <label>Number of Posts*</label>
                <input class="form-control" type="number" name="content" value="<?= base64_decode($content) ?>" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Call to Action") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea class="form-control" name="content"><?= base64_decode($content); ?></textarea>
              </div>

              <div class="form-group">
                <label>Button Text*</label>
                <input class="form-control" type="text" name="subheading" value="<?= base64_decode($subheading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Button Link*</label>
                <input class="form-control" type="text" name="image" value="<?= $image; ?>" required="">
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="<?= $fgcolor; ?>" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }
          elseif ($type == "Features") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="subheading" value="<?= base64_decode($subheading); ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Features (Seprate by comma)*</label>
                <textarea class="form-control" name="content"><?= base64_decode($content); ?></textarea>
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "HTML or Javascript") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="subheading" value="<?= base64_decode($subheading); ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="bgcolor" value="<?= $bgcolor; ?>">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>HTML or Javascript Snippet*</label>
                <textarea class="form-control" name="content"><?= base64_decode($content); ?></textarea>
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Image") {
            ?>

            <form action="action/edit_page_content.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="subheading" value="<?= base64_decode($subheading); ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="bgcolor" value="<?= $bgcolor; ?>">

              <input type="hidden" name="content" value="<?= base64_decode($content); ?>">

              <div class="form-group">
                <label>Current Image</label>
                <div>
                  <img src="uploads/<?= $image; ?>" width="450px">
                </div>
              </div>

              <div class="form-group">
                <label>Choose New File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>Caption*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Page Cover") {
            ?>

            <form action="action/edit_page_content.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="bgcolor" value="<?= $bgcolor; ?>">

              <input type="hidden" name="content" value="<?= base64_decode($content); ?>">

              <div class="form-group">
                <label>Current Image</label>
                <div>
                  <img src="uploads/<?= $image; ?>" width="450px">
                </div>
              </div>

              <div class="form-group">
                <label>Choose File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>heading*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" value="<?= base64_decode($subheading); ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Photo Gallery") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="bgcolor" value="<?= $bgcolor; ?>">

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

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Slider") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <input type="hidden" name="fgcolor" value="<?= $fgcolor; ?>">

              <input type="hidden" name="bgcolor" value="<?= $bgcolor; ?>">

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

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Text") {
            ?>

            <form action="action/edit_page_content.php" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" value="<?= base64_decode($subheading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea id="contentbox" class="form-control" name="content" required=""><?= base64_decode($content); ?></textarea>
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="<?= $fgcolor; ?>" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

            </form>

          <?php

          }

          elseif ($type == "Text With Image") {
            ?>

            <form action="action/edit_page_content.php" enctype="multipart/form-data" method="POST">

              <input type="hidden" name="wid" value="<?= $id; ?>">

              <input type="hidden" name="orderno" value="<?= $orderno; ?>">

              <input type="hidden" name="type" value="<?= $type; ?>">

              <input type="hidden" name="image" value="<?= $image; ?>">

              <div class="form-group">
                <label>Current Image</label>
                <div>
                  <img src="uploads/<?= $image; ?>" width="450px">
                </div>
              </div>

              <div class="form-group">
                <label>Choose New File*</label>
                <input id='upload' class="form-control" name="fileToUpload" type="file">
              </div>

              <div class="form-group">
                <label>Heading*</label>
                <input class="form-control" type="text" name="heading" value="<?= base64_decode($heading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Sub Heading*</label>
                <input class="form-control" type="text" name="subheading" value="<?= base64_decode($subheading); ?>" required="">
              </div>

              <div class="form-group">
                <label>Content*</label>
                <textarea id="contentbox" class="form-control" name="content" required=""><?= base64_decode($content); ?></textarea>
              </div>

              <div class="form-group">
                <label>Text Color*</label>
                <input type="color" name="fgcolor" value="<?= $fgcolor; ?>" required="">
              </div>

              <div class="form-group">
                <label>Background Color*</label>
                <input type="color" name="bgcolor" value="<?= $bgcolor; ?>" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Save Changes">

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
