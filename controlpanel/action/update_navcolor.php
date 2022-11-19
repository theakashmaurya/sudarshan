<?php

session_start();
ob_start();


require_once('../../config/dblib.php');

if (isset($_POST['navcolor'])) {

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `settings` SET `sett_value`='".$_POST['navcolor']."' WHERE `sett_option`='navcolor'");

		if($result == true){
			
			header('location:../nav_settings.php?msgtype=text-success&msg=Changes saved successfully');
		}

		else{

			header('location:../nav_settings.php?msgtype=text-danger&msg=Unable to save changes');
		}
	}
	else{

		header('location:../nav_settings.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../nav_settings.php?msgtype=text-danger&msg=Please fill all required fields and Real Master-Code');
}

?>