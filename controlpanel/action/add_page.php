<?php

require_once('../../config/dblib.php');


if (isset($_POST['title']) && isset($_POST['description'])) {
	
	$title=$_POST['title'];
	$description=$_POST['description'];
	$status=$_POST['status'];

	$slug1=strtolower(substr($title, 0, 70));

	$slug2=str_replace("'", "", $slug1);

	$slug3=str_replace('"', '', $slug2);

	$slug4=str_replace('(', '', $slug3);

	$slug5=str_replace(')', '', $slug4);

	$slug = str_replace(' ', '-', $slug5).'-'.date("Y-m-d");

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("INSERT INTO `pages`(`slug`,`title`, `description`, `status`, `parent`, `orderno`) VALUES('".$slug."', '".base64_encode($title)."', '".base64_encode($description)."', '".$status."', 0, 1)");


		if($result == true){

			header('location:../pages.php?msgtype=text-success&msg=New page has been created!');
		}

		else{

			header('location:../pages.php?msgtype=text-danger&msg=Unable to add new page');
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
