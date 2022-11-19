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
  <title>Uploads - Sudarshan</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="icon" href="assets/images/fevicon.png" sizes="96x96" type="image/png">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <li class="breadcrumb-item active">Upload</li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <h6><?= $_POST['title']; ?></h6></div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <form action="action/upload_files.php" enctype="multipart/form-data" method="POST">

            <input type="hidden" name="widget_id" value="<?= $_POST['id']; ?>">

            <div class="form-group">
              <label>Select Files*</label>
              <input id='upload' class="form-control" name="upload[]" type="file" multiple="multiple" />
            </div>

            <input type="submit" class="btn btn-primary" value="Upload Files" name="submit">

          </form>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header"></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>File ID</th>
                  <th>Preview</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>File ID</th>
                  <th>Preview</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `uploads` WHERE `widget_id`=".$_POST['id']."");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        <tr>
                          <td><?= $getResults_row['id']; ?></td>
                          <td><img src="uploads_widget/<?= $getResults_row['filename']; ?>" width="250px"></td>
                          <td>
                            <textarea id="description<?=$getResults_row['id']; ?>"><?= $getResults_row['description']; ?></textarea>
                            <input type="hidden" id="fileid<?=$getResults_row['id']; ?>" value="<?=$getResults_row['id']; ?>">
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary" id="btn<?=$getResults_row['id']; ?>">Update Description</button>
                            <script>
                                $(document).ready(function(){
                                   $("#btn<?=$getResults_row['id']; ?>").click(function(){
                                       var description=$("#description<?=$getResults_row['id']; ?>").val();
                                       var fileid=$("#fileid<?=$getResults_row['id']; ?>").val();
                                       $.ajax({
                                           url:'action/update_file_description.php',
                                           method:'POST',
                                           data:{
                                               description:description,
                                               fileid:fileid
                                           },
                                          success:function(data){
                                              alert(data);
                                          }
                                       });
                                   });
                               });

                            </script>
                          </td>
                          <td>
                            <form action="action/del_widget.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="hidden" value="<?= $getResults_row['filename']; ?>" name="filename">
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
