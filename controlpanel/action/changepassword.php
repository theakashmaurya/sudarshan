<?php

session_start();
ob_start();


require_once('../../config/dblib.php');

if (isset($_POST['newpassword']) && $_POST['mastercode']=="QAZwsx@789") {
	
	$newpassword=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];
	$mastercode=$_POST['mastercode'];
    
    if($newpassword == $confirmpassword){

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `users` SET `password`='".$newpassword."' WHERE `id`=".$_SESSION['userid']);

		if($result == true){
			
			header('location:../change-password.php?msgtype=text-success&msg=Changes saved successfully');
		}

		else{

			//header('location:../change-password.php?msgtype=text-danger&msg=Unable to save changes');
		}
	}
	else{

		header('location:../change-password.php?msgtype=text-danger&msg=Server lost connectivity!');
	}
        
  }
    
else{

		header('location:../change-password.php?msgtype=text-danger&msg=Passwords do not match!');
	}

}
else{
	header('location:../change-password.php?msgtype=text-danger&msg=Please fill all required fields and Real Master-Code');
}

?>