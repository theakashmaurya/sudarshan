<nav class="navbar navbar-expand-lg <?php if($navcolor=='dark'){ echo 'navbar-dark bg-dark'; } else{ echo 'navbar-light bg-light'; } ?>">
  <a class="navbar-brand" href="index.php"><img src="controlpanel/site_files/logo.png" style="max-height : 60px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">

      <?php

       $instancenav = new DatabaseLib();

       $connStatusnav = $instancenav->createConnection();

        if ($connStatusnav == true) {

          $getResultsnav= $instancenav->getData("SELECT * FROM `pages` WHERE `parent`=0 AND `status`='P' ORDER BY `orderno` ASC");

          if($getResultsnav != false){
            while ($getResults_rownav = mysqli_fetch_array($getResultsnav)) {

              $founds=0;

              $getResultsdrpdn= $instancenav->getData("SELECT * FROM `pages` WHERE `parent`=".$getResults_rownav['id']);

              if($getResultsdrpdn != false){

                $founds = mysqli_num_rows($getResultsdrpdn);
              }

              if($founds < 1){

              ?>

              <li class="nav-item">
                <a class="nav-link" href="<?php if($getResults_rownav['slug']=='home') { echo 'index.php'; } elseif($getResults_rownav['slug']=='blog') { echo 'blog.php'; } else { echo 'page.php?p='.$getResults_rownav['slug']; } ?>"><?= base64_decode($getResults_rownav['title']); ?></a>
              </li>
              <?php
              }

              else{
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  <?= base64_decode($getResults_rownav['title']); ?>
                </a>
                <div class="dropdown-menu">

                  <?php

                   $getResultsdrpdn1= $instancenav->getData("SELECT * FROM `pages` WHERE `parent`=".$getResults_rownav['id']." ORDER BY `orderno` ASC");

                  if($getResultsdrpdn1 != false){

                    while ($getResultsdrpdn1_row = mysqli_fetch_array($getResultsdrpdn1)) {
                      ?>

                      <a class="dropdown-item" href="page.php?p=<?= $getResultsdrpdn1_row['slug']; ?>"><?= base64_decode($getResultsdrpdn1_row['title']); ?></a>

                      <?php
                      }                    
                  }

                  ?>
                </div>
              </li>

              <?php

              }

            }

          }

        }


      ?>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <a class="nav-link" style="<?php if($navcolor=='dark'){ echo 'color:#fff !important;'; } else{ echo 'color:#000 !important;'; } ?>" href="tel:<?= $phone; ?>"><span class="fa fa-phone-square"></span> <?= $phone; ?></a>
    </div>
  </div>
</nav>