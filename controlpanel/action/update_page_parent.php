<?php

require_once('../../config/dblib.php');


if (isset($_POST['pageid']) && isset($_POST['parentid'])) {


	$pageid=$_POST['pageid'];
	$parentid=$_POST['parentid'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `pages` SET `parent`=".$parentid." WHERE `id`=".$pageid."");


		if($result == true){

			echo "Parent has been updated!";
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