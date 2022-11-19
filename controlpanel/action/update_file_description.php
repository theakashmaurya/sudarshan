<?php

require_once('../../config/dblib.php');


if (isset($_POST['fileid']) && isset($_POST['description'])) {


	$id=$_POST['fileid'];
	$description=$_POST['description'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `uploads` SET `description`='".$description."' WHERE `id`=".$id."");


		if($result == true){

			echo "Description has been updated!";
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