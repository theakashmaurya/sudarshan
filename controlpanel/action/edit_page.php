<?php

require_once('../../config/dblib.php');

$addmsg="";


if (isset($_POST['title']) && isset($_POST['id'])) {


	$title=$_POST['title'];
	$description=$_POST['description'];
	$status=$_POST['status'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `pages` SET `title`='".base64_encode($title)."', `description`='".base64_encode($description)."', `status`='".$status."' WHERE `id`=".$_POST['id']."");


		if($result == true){

			header('location:../pages.php?msgtype=text-success&msg=Changes has been saved!');
		}

		else{

			header('location:../pages.php?msgtype=text-danger&msg=Unable to save new changes');
		}
	}
	else{

		header('location:../pages.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../pages.php?msgtype=text-danger&msg=Please fill all required fields');
}

?>
