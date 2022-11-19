<?php

  if (isset($_GET['p'])) {
    $slug=$_GET['p'];
  }
  else {
    $slug='home';
  }

  require_once('config/dblib.php');

  $instance1 = new DatabaseLib();

  $connStatus1 = $instance1->createConnection();

  if ($connStatus1 == true) {

    $getResults1= $instance1->getData("SELECT * FROM `settings`");

    if($getResults1 != false){
      while ($getResults_row1 = mysqli_fetch_array($getResults1)) {

        if ($getResults_row1['sett_option']=="sitename") {

          $sitename=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="sitetagline") {

          $sitetagline=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="headercode") {

          $headercode=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="whatsapp") {

          $whatsapp=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="phone") {

          $phone=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="navcolor") {

          $navcolor=$getResults_row1['sett_value'];
        }

        elseif ($getResults_row1['sett_option']=="paymentlink") {

          $paymentlink=$getResults_row1['sett_value'];
        }

      }
    }
  }

  if ($connStatus1 == true) {

    $getResults2= $instance1->getData("SELECT `id` FROM `pages` WHERE `slug`='".$slug."'");

    if($getResults2 != false){
      while ($getResults_row2 = mysqli_fetch_array($getResults2)) {

        $pageid=$getResults_row2['id'];

      }

    }

  }

