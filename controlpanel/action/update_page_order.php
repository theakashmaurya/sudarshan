<?php

require_once('../../config/dblib.php');


if (isset($_POST['pageid']) && isset($_POST['orderno'])) {


  $pageid=$_POST['pageid'];
  $orderno=$_POST['orderno'];

  $instance = new DatabaseLib();

  $connStatus = $instance->createConnection();

  if ($connStatus == true) {

    $result = $instance->runQuery("UPDATE `pages` SET `orderno`=".$orderno." WHERE `id`=".$pageid."");


    if($result == true){

      echo "Order has been updated!";
    }

    else{

      echo "Unable to save new changes";
    }
  }
  else{

    echo "Server lost connectivity!";
  }

}
else{
  echo "Please fill all required fields";
}

?>