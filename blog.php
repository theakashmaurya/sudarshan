<?php

include('inc/autoload.php');

$instancedesc = new DatabaseLib();

$connStatusdesc = $instancedesc->createConnection();

if ($connStatusdesc == true) {

	$getResultsdesc= $instancedesc->getData("SELECT `description` FROM `pages` WHERE `slug`='blog'");

	if($getResultsdesc != false){
	  while ($getResults_rowdesc = mysqli_fetch_array($getResultsdesc)) {

	  	$pagesdescription = $getResults_rowdesc['description'];

	  }

	}

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	 	<title>Blog - <?= base64_decode($sitename); ?></title>
	 	<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<meta name="description" content="<?= base64_decode($pagesdescription); ?>">
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	 	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	 	<link rel="icon" href="controlpanel/site_files/favicon.png" sizes="96x96" type="image/png">

	 	<?= base64_decode($headercode); ?>
	</head>
	<body>

		<?php include('inc/nav.php'); ?>

		<div class="container" style="padding: 50px">
  			<div class="row">

  					<?php

  					$instance = new DatabaseLib();

					$connStatus = $instance->createConnection();

				  	$getResults22= $instance->getData("SELECT * FROM `posts` WHERE `status`='P' ORDER BY `id` DESC");

		            if($getResults22 != false){

			              while ($getResults_row22 = mysqli_fetch_array($getResults22)) {

			              		?>

			              		<div class="col-md-4 text-center" style="padding: 10px;">
				              		<img src="controlpanel/uploads/<?= $getResults_row22['image']; ?>" class="img-fluid"><br><br>
		              				<h4><?= base64_decode($getResults_row22['title']); ?></h4>
		              				<p><?= substr(base64_decode($getResults_row22['content']), 0, 165).'...'; ?></p>
		              				<p><a href="post.php?p=<?= $getResults_row22['slug']; ?>" class="btn btn-md btn-dark">Read More</a></p>
		              				<br>
		              			</div>
	              			<?php
	              			}
	              		}
	              	?>
  			</div>
  		</div>

		<?php include('inc/footer.php'); ?>
	</body>
</html>