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
  <title>All Pages - Sudarshan</title>
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
        <li class="breadcrumb-item active">All Pages</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <p class="<?= $msgtype; ?>"><?= $msg; ?></p></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Order No.</th>
                  <th>Page ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Parent</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Order No.</th>
                  <th>Page ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Parent</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php

                  $instance = new DatabaseLib();

                  $connStatus = $instance->createConnection();

                  if ($connStatus == true) {

                    $getResults= $instance->getData("SELECT * FROM `pages`");

                    if($getResults != false){
                      while ($getResults_row = mysqli_fetch_array($getResults)) {

                        ?>
                        <tr>
                          <td><strong><?= $getResults_row['orderno']; ?></strong>
                            <br>
                            <input type="number" id="orderno<?=$getResults_row['id']; ?>" style="width:55px;" value="<?=$getResults_row['orderno']; ?>">
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary" id="btnorder<?=$getResults_row['id']; ?>">Update Order</button>
                            <script>
                                $(document).ready(function(){
                                   $("#btnorder<?=$getResults_row['id']; ?>").click(function(){
                                       var orderno=$("#orderno<?=$getResults_row['id']; ?>").val();
                                       var pageid="<?=$getResults_row['id']; ?>";
                                       $.ajax({
                                           url:'action/update_page_order.php',
                                           method:'POST',
                                           data:{
                                               pageid:pageid,
                                               orderno:orderno
                                           },
                                          success:function(data){
                                              alert(data);
                                          }
                                       });

                                       
                                   });
                               });

                            </script>
                          </td>
                          <td><?= $getResults_row['id']; ?></td>
                          <td>
                            <h6><?= base64_decode($getResults_row['title']); ?></h6>
                            <?php

                              if ($getResults_row['status']=="P") {
                                echo '<p class="bg-success text-light">Published Post</p>';
                              }
                              else{
                                echo '<p class="bg-primary text-light">Saved As Draft</p>';
                              }

                            ?>                            
                          </td>
                          <td><?= base64_decode($getResults_row['description']); ?></td>
                          <td>
                            <div>

                              <select id="parent<?= $getResults_row['id']; ?>">

                                <option value="0">None</option>
                              <?php

                              if ($connStatus == true) {

                                $getResults1= $instance->getData("SELECT * FROM `pages`");

                                if($getResults != false){
                                  while ($getResults_row1 = mysqli_fetch_array($getResults1)) {

                                    ?>

                                    <option value="<?= $getResults_row1['id']; ?>" <?php if($getResults_row['parent']==$getResults_row1['id']){ echo 'selected'; } ?>><?= base64_decode($getResults_row1['title']); ?></option>

                                    <?php

                                  }
                                }
                              }

                              ?>
                              </select>
                              <button type="submit" class="btn btn-sm btn-primary" id="btn<?= $getResults_row['id']; ?>">Update Parent</button>

                                <script>
                                    $(document).ready(function(){
                                       $("#btn<?=$getResults_row['id']; ?>").click(function(){
                                           var parentid=$("#parent<?=$getResults_row['id']; ?>").val();
                                           var pageid="<?= $getResults_row['id']; ?>";
                                           $.ajax({
                                               url:'action/update_page_parent.php',
                                               method:'POST',
                                               data:{
                                                   parentid:parentid,
                                                   pageid:pageid
                                               },
                                              success:function(data){
                                                  alert(data);
                                              }
                                           });
                                       });
                                   });

                                </script>

                            </div>
                          </td>
                          <td>
                            <form action="page_edit.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="submit" class="btn btn-primary" value="Edit / Delete">
                            </form>

                            <?php
                            if ($getResults_row['slug'] != "blog") {
                            
                            ?>
                            <form action="page_edit_contents.php" method="POST">
                              <input type="hidden" value="<?= $getResults_row['id']; ?>" name="id">
                              <input type="submit" class="btn btn-dark" value="Edit Contents">
                            </form>
                            <?php
                            }
                            ?>
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
