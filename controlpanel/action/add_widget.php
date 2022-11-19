<?php

require_once('../../config/dblib.php');


if (isset($_POST['title']) && isset($_POST['type'])) {
	
	$title=$_POST['title'];
	$type=$_POST['type'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("INSERT INTO `widgets`(`type`,`title`) VALUES('".$type."', '".base64_encode($title)."')");


		if($result == true){

			header('location:../widgets.php?msgtype=text-success&msg=New widget has been created!');
		}

		else{

			header('location:../widgets.php?msgtype=text-danger&msg=Unable to add new widget');
		}
	}
	else{

		header('location:../widgets.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../widgets.php?msgtype=text-danger&msg=Please fill all required fields');
}

?>
