<?php

require_once('../../config/dblib.php');


if (isset($_POST['id']) && isset($_POST['neworder'])) {


	$id=$_POST['id'];
	$orderno=$_POST['neworder'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `contents` SET `orderno`='".$orderno."' WHERE `id`=".$id."");


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