<?php

include('inc/autoload.php');

$instance = new DatabaseLib();

$connStatus = $instance->createConnection();

if ($connStatus == true) {

	$getResults22= $instance->getData("SELECT * FROM `posts` WHERE `slug`='".$_GET['p']."' AND `status`='P'");

	if($getResults22 != false){

	  while ($getResults_row22 = mysqli_fetch_array($getResults22)) {

	  	$title=$getResults_row22['title'];

	  	$image=$getResults_row22['image'];

	  	$content=$getResults_row22['content'];
	  }
  }

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	 	<title><?= base64_decode($title); ?> - <?= base64_decode($sitename); ?></title>
	 	<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<meta name="description" content="<?= substr(base64_decode($content), 3, 160); ?>">
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	 	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	 	<link rel="icon" href="controlpanel/site_files/favicon.png" sizes="96x96" type="image/png">

	 	<?= base64_decode($headercode); ?>
	</head>
	<body>

		<?php include('inc/nav.php'); ?>

		<div style="padding-bottom: 30px;">

      		<div style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('controlpanel/uploads/<?= $image; ?>') no-repeat center;  background-size: cover; min-height: 450px;">
      			<div class="container">
          			<div class="row">
          				<div class="col-md-12 text-center">
          					<h1 style="margin-top:200px; color:#fff;"><?= base64_decode($title); ?></h1>
          				</div>
          			</div>
          		</div>
      		</div>
      		<br>
      		<div class="container">
      			<div class="row">
      				<div class="col-md-8 offset-md-2 text-justify">
      					<p><?= base64_decode($content); ?></p>
      				</div>
      			</div>
      		</div>
      	</div>

		<?php include('inc/footer.php'); ?>
	</body>
</html>