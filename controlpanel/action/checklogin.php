<?php

session_start();
ob_start();

require_once('../../config/dblib.php');

if (isset($_POST['email']) && isset($_POST['password'])) {

	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {
		
		$getResults= $instance->getData("SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."'");

		if($getResults != false){
			while ($getResults_row = mysqli_fetch_array($getResults)) {
				$_SESSION['userid'] = $getResults_row['id'];
				$_SESSION['fullname'] = $getResults_row['fullname'];
				$_SESSION['actype'] = $getResults_row['type'];
				$_SESSION['active'] = $getResults_row['active'];
			}

			header('location:../dashboard.php');
		}
		else{
			header('location:../index.php?msgtype=text-danger&msg=You entered wrong credentials');
		}
	}
	else{
		header('location:../index.php?msgtype=text-danger&msg=Unable to establish server connection!');
	}
}

?>