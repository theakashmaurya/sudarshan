<?php

include('inc/autoload.php');

$instancedesc = new DatabaseLib();

$connStatusdesc = $instancedesc->createConnection();

if ($connStatusdesc == true) {

	$getResultsdesc= $instancedesc->getData("SELECT `description` FROM `pages` WHERE `slug`='home'");

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
	 	<title><?= base64_decode($sitename); ?> - <?= base64_decode($sitetagline); ?></title>
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

		<?php

          $instance = new DatabaseLib();

          $connStatus = $instance->createConnection();

          if ($connStatus == true) {

            $getResults= $instance->getData("SELECT * FROM `contents` WHERE `pageid`=".$pageid." ORDER BY `orderno` ASC");

            if($getResults != false){
              while ($getResults_row = mysqli_fetch_array($getResults)) {

              	if ($getResults_row['type']=="Slider") {

              		$sliderid=base64_decode($getResults_row['content']);
              		
              		?>

              		<div id="demo" class="carousel slide" data-ride="carousel">
					  <ul class="carousel-indicators">					    
					  </ul>
					  <div class="carousel-inner">
					  	<?php
					  	$getResults22= $instance->getData("SELECT * FROM `uploads` WHERE `widget_id`=".$sliderid."");

			            if($getResults != false){

			            	$countslider=0;

			              while ($getResults_row22 = mysqli_fetch_array($getResults22)) {

			              	$countslider=$countslider+1;
					  	?>
					    <div class="carousel-item <?php if($countslider==1){ echo 'active'; } ?>">
					      <img src="controlpanel/uploads_widget/<?= $getResults_row22['filename']; ?>" alt="<?= $getResults_row22['description']; ?>" width="100%">
					      <div class="carousel-caption">
					        <h5><?= $getResults_row22['description']; ?></h5>
					      </div>   
					    </div>

					    <?php
              	    		}
              	    	}
              	    	?>
					  </div>
					  <a class="carousel-control-prev" href="#demo" data-slide="prev">
					    <span class="carousel-control-prev-icon"></span>
					  </a>
					  <a class="carousel-control-next" href="#demo" data-slide="next">
					    <span class="carousel-control-next-icon"></span>
					  </a>
					</div>
					<?php
                }

              	elseif($getResults_row['type']=="Features") {

              		?>

              		<div style="background-color: <?= $getResults_row['bgcolor']; ?>; padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row">
	              				<div class="col-md-12"><h3 class="text-center"><?= base64_decode($getResults_row['heading']); ?><br></h3><div style="margin-top:35px;"></div></div>
	              			</div>
	              			<div class="row">
	              				<?php

	              				$features = explode(",", base64_decode($getResults_row['content']));

	              				foreach ($features as $key => $value) {
	              					?>
									<div class="col-md-3" style="margin-bottom: 20px">
										<div class="text-center" style="border: solid 2px #777; border-radius: 15px; padding-top: 50px; padding-bottom: 50px;"><span class="fa fa-check-circle-o" style="font-size:80px;"></span>
											<h5 class="text-center">
												<br>
												<?= $value; ?>
											</h5>
										</div>
									</div>

									<?php
								}

	              				?>
	              				
	              			</div>
	              		</div>
	              	</div>

              		<?php
              		
              	}

              	elseif ($getResults_row['type']=="Text With Image") {

              		?>

              		<div style="background-color: <?= $getResults_row['bgcolor']; ?>; padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row" style="color: <?= $getResults_row['fgcolor']; ?>;">
	              				<div class="col-md-6" style="padding-left: 10px; padding-right:10px; padding-bottom: 20px;">
	              						<img src="controlpanel/uploads/<?= $getResults_row['image']; ?>" alt="<?= base64_decode($getResults_row['heading']); ?>" class="img-fluid">
	              				</div>
	              				<div class="col-md-6">
	              						<h3><?= base64_decode($getResults_row['heading']); ?></h3>
	              						<h5><?= base64_decode($getResults_row['subheading']); ?></h5>
	              						<p class="text-justify"><?= base64_decode($getResults_row['content']); ?></p>
	              				</div>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              		
              	}

              	elseif ($getResults_row['type']=="Call to Action") {

              		?>

              		<div style="background-color: <?= $getResults_row['bgcolor']; ?>; padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row" style="color: <?= $getResults_row['fgcolor']; ?>;">
	              				<div class="col-md-9" style="padding-left: 10px; padding-right: :10px; padding-bottom: 20px;">
	              						<h3><?= base64_decode($getResults_row['heading']); ?></h3>
	              						<p><?= base64_decode($getResults_row['content']); ?></p>
	              				</div>
	              				<div class="col-md-3 text-center">
	              				<br>	              						
	              						<a href="<?= $getResults_row['image']; ?>" class="btn btn-lg" style="background-color: <?= $getResults_row['bgcolor']; ?>; color: <?= $getResults_row['fgcolor']; ?>; border-radius: 0px; border: solid 2px <?= $getResults_row['fgcolor']; ?>;"><?= base64_decode($getResults_row['subheading']); ?></a>
	              				</div>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              		
              	}

              	elseif ($getResults_row['type']=="Photo Gallery") {

              		$galleryid=base64_decode($getResults_row['content']);
              		
              		?>

              		<div style="padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row">
	              				<div class="col-md-10 offset-md-1">
	              					<h3 class="text-center"><?= base64_decode($getResults_row['heading']); ?></h3>
	              					<h5 class="text-center"><?= base64_decode($getResults_row['subheading']); ?></h5>
	              					<br>
	              					<div class="row">

	              						<?php
										  	$getResults22= $instance->getData("SELECT * FROM `uploads` WHERE `widget_id`=".$galleryid."");

								            if($getResults != false){

								            	$countslider=0;

								              while ($getResults_row22 = mysqli_fetch_array($getResults22)) {

								              	?>

								              	<div class="col-md-3" class="padding:10px;">
								              		<a href="controlpanel/uploads_widget/<?= $getResults_row22['filename']; ?>" target="_blank"><img src="controlpanel/uploads_widget/<?= $getResults_row22['filename']; ?>" alt="<?= $getResults_row22['description']; ?>" class="img-fluid img-thumbnail" style="width: 100%;"><p class="text-center"><?= $getResults_row22['description']; ?></p></a>
								              	</div>

								              	<?php

								              }

								          }

	              						?>
	              						
	              					</div>              					
	              				</div>
	              			</div>
	              		</div>
	              	</div>

					<?php
                }

                elseif ($getResults_row['type']=="Button") {

              		?>

              		<div style="padding-top: 30px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row">
	              				<div class="col-md-12 text-center">

	              						<a href="<?= base64_decode($getResults_row['content']); ?>" class="btn btn-lg" style="background-color: <?= $getResults_row['bgcolor']; ?>; color: <?= $getResults_row['fgcolor']; ?>; border-radius: 0px; border: solid 2px <?= $getResults_row['fgcolor']; ?>;"><?= base64_decode($getResults_row['heading']); ?></a>
	              				</div>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              	  }

              	  elseif ($getResults_row['type']=="Image") {

              		?>

              		<div style="padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row">
	              				<div class="col-md-8 offset-md-2">

	              						<img src="controlpanel/uploads/<?= $getResults_row['image']; ?>" alt="<?= base64_decode($getResults_row['content']); ?>" class="img-fluid">
	              						<p class="text-center"><?= base64_decode($getResults_row['content']); ?></p>
	              				</div>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              	  }

              	  elseif ($getResults_row['type']=="Page Cover") {

              		?>

              		<div style="padding-bottom: 30px;">

	              		<div style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('controlpanel/uploads/<?= $getResults_row['image']; ?>') no-repeat center;  background-size: cover; min-height: 550px;">
	              			<div class="container">
		              			<div class="row">
		              				<div class="col-md-6">
		              					<h1 style="margin-top:250px; color:#fff;"><?= base64_decode($getResults_row['heading']); ?></h1>
		              					<h5 style="color:#fff;"><?= base64_decode($getResults_row['subheading']); ?></h5>
		              				</div>
		              			</div>
		              		</div>
	              		</div>
	              	</div>

              		<?php
              	  }

              	  elseif ($getResults_row['type']=="HTML or Javascript") {

              		?>

              		<div style="padding-top:50px; padding-bottom: 30px;">

	              		<div>
	              			<div class="container">
		              			<div class="row">
		              				<div class="col-md-12">
		              					<h3 class="text-center"><?= base64_decode($getResults_row['heading']); ?></h3>
		              					<div>
		              						<?= base64_decode($getResults_row['content']); ?>
		              					</div>
		              				</div>
		              			</div>
		              		</div>
	              		</div>
	              	</div>

              		<?php
              	  }

              	  elseif ($getResults_row['type']=="Text") {

              		?>

              		<div style="background-color: <?= $getResults_row['bgcolor']; ?>; padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row" style="color: <?= $getResults_row['fgcolor']; ?>;">
	              				<div class="col-md-12">
	              						<h3 class="text-center"><?= base64_decode($getResults_row['heading']); ?></h3>
	              						<h5 class="text-center"><?= base64_decode($getResults_row['subheading']); ?></h5>
	              						<p class="text-justify"><?= base64_decode($getResults_row['content']); ?></p>
	              				</div>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              		
              	}

              	elseif ($getResults_row['type']=="Blog Post") {

              		?>

              		<div style="background-color: <?= $getResults_row['bgcolor']; ?>; padding-top: 50px; padding-bottom: 30px;">

	              		<div class="container">
	              			<div class="row">

	              				<div class="col-md-12 text-center"><h3><?= base64_decode($getResults_row['heading']); ?></h3><h5><?= base64_decode($getResults_row['subheading']); ?></h5><br></div>
	              					<?php

								  	$getResults22= $instance->getData("SELECT * FROM `posts` WHERE `status`='P' ORDER BY `id` DESC");

						            if($getResults22 != false){

						            	$countposts=0;

							              while ($getResults_row22 = mysqli_fetch_array($getResults22)) {

							              		$countposts=$countposts+1;

							              		if ($countposts > base64_decode($getResults_row['content'])) {
							              			break;
							              		}
							              		?>

							              		<div class="col-md-4 text-center" style="padding: 10px;">
								              		<img src="controlpanel/uploads/<?= $getResults_row22['image']; ?>" class="img-fluid"><br><br>
						              				<h4><?= base64_decode($getResults_row22['title']); ?></h4>
						              				<p><?= substr(base64_decode($getResults_row22['content']), 0, 145).'...'; ?></p>
						              				<p><a href="post.php?p=<?= $getResults_row22['slug']; ?>" class="btn btn-md btn-dark">Read More</a></p>
						              				<br>
						              			</div>
					              			<?php
					              			}
					              		}
					              	?>
	              			</div>
	              		</div>
	              	</div>

              		<?php
              		
              	}


               }

             }
           }

          ?>


		<?php include('inc/footer.php'); ?>
	</body>
</html>