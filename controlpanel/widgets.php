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

  if(isset($_POST['id'])){

    $_SESSION['curr_page_id']=$_POST['id'];

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
  <title>Widgets - Sudarshan</title>
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
          <a href="widgets.php">Widgets</a>
        </li>
        <li class="breadcrumb-item active">manage</li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <p>Sliders</p></div>
        <div class="card-body">
          <div>
             <form action="action/add_widget.php" method="POST">

              <input type="hidden" name="type" value="Slider">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="title" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add New Slider">

            </form>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Widget ID</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Widget ID</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `widgets` WHERE `type`='Slider'");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        <tr>
                          <td><?= $getResults_row['id']; ?></td>
                          <td><strong><?= base64_decode($getResults_row['title']); ?></strong></td>
                          <td>
                            <form action="widget_uploads.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="hidden" name="type" value="Slider">
                              <input type="hidden" name="title" value="<?= base64_decode($getResults_row['title']); ?>">
                              <input type="submit" class="btn btn-success" value="Add Slides">
                            </form>
                            &nbsp;
                            <form action="action/del_widget_group.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <select name="del_response">
                                <option value="no" selected>NO</option>
                                <option value="yes">Yes</option>
                              </select>

                              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                          </td>
                        </tr>

                        <?php

                      }
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


      <div class="card mb-3">
        <div class="card-header">
          <p>Photo Galleries</p></div>
        <div class="card-body">
          <div>
             <form action="action/add_widget.php" method="POST">

              <input type="hidden" name="type" value="Photo Gallery">

              <div class="form-group">
                <label>Title*</label>
                <input class="form-control" type="text" name="title" required="">
              </div>

              <input type="submit" class="btn btn-success" value="Add New Photo Gallery">

            </form>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Widget ID</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Widget ID</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `widgets` WHERE `type`='Photo Gallery'");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        <tr>
                          <td><?= $getResults_row['id']; ?></td>
                          <td><strong><?= base64_decode($getResults_row['title']); ?></strong></td>
                          <td>
                            <form action="widget_uploads.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="hidden" name="type" value="Slider">
                              <input type="hidden" name="title" value="<?= base64_decode($getResults_row['title']); ?>">
                              <input type="submit" class="btn btn-success" value="Add Photos">
                            </form>
                            &nbsp;
                            <form action="action/del_widget_group.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <select name="del_response">
                                <option value="no" selected>NO</option>
                                <option value="yes">Yes</option>
                              </select>

                              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                          </td>
                        </tr>

                        <?php

                      }
                    }
                  }
                ?>
              </tbody>
            </table>
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
