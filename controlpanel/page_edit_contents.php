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
  <title>Edit Page Contents - Sudarshan</title>
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
          <a href="pages.php">Pages</a>
        </li>
        <li class="breadcrumb-item active">Edit Page Contents</li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <p>Add New Content / Widget</p></div>
        <div class="card-body">
          <form action="page_add_content.php" method="POST">
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type">
                  <option value="Button">Button</option>
                  <option value="Blog Post">Blog Post</option>
                  <option value="Call to Action">Call to Action</option>
                  <option value="Features">Features</option>
                  <option value="HTML or Javascript">HTML or Javascript</option>
                  <option value="Image">Image</option>
                  <option value="Page Cover">Page Cover</option>
                  <option value="Photo Gallery">Photo Gallery</option>
                  <option value="Slider">Slider</option>
                  <option value="Text">Text</option>
                  <option value="Text With Image">Text With Image</option>
                </select>
              </div>

              <input type="submit" class="btn btn-success" value="Add">
            </form>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Content Order</th>
                  <th>Content ID</th>
                  <th>Type</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Content Order</th>
                  <th>Content ID</th>
                  <th>Type</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `contents` WHERE `pageid`=".$_SESSION['curr_page_id']." ORDER BY `orderno` ASC");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        <tr>
                          <td>
                            <strong>[<?= $getResults_row['orderno']; ?>]</strong>
                            <br><br>
                            <input type="number" id="neworder<?=$getResults_row['id']; ?>" placeholder="New Order">
                            <button type="submit" class="btn btn-sm btn-primary" id="btn<?=$getResults_row['id']; ?>">Update Order</button>
                            <script>
                                $(document).ready(function(){
                                   $("#btn<?=$getResults_row['id']; ?>").click(function(){
                                       var neworder=$("#neworder<?=$getResults_row['id']; ?>").val();
                                       var id="<?=$getResults_row['id']; ?>";
                                       $.ajax({
                                           url:'action/update_content_order.php',
                                           method:'POST',
                                           data:{
                                               neworder:neworder,
                                               id:id
                                           },
                                          success:function(data){
                                              alert(data);
                                          }
                                       });

                                       $(document).ajaxStop(function(){
                                          window.location.reload();
                                      });
                                   });
                               });

                            </script>
                            </td>
                          <td><?= $getResults_row['id']; ?></td>
                          <td><strong><?= $getResults_row['type']; ?></strong></td>
                          <td><?= base64_decode($getResults_row['heading']); ?></td>
                          <td>
                            <form action="page_edit_content_edit.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="submit" class="btn btn-primary" value="Edit">
                            </form>
                            <br>
                            <form action="action/del_page_content.php" method="POST">
                              <input type="hidden" name="image" value="<?= $getResults_row['image']; ?>">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <select name="del_response">
                                <option value="no" selected>NO</option>
                                <option value="yes">Yes</option>
                              </select>

                              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                          </td>
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
