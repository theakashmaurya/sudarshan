<?php

session_start();
ob_start();


require_once('../../config/dblib.php');

if (isset($_POST['title'])) {

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `settings` SET `sett_value`='".base64_encode($_POST['title'])."' WHERE `sett_option`='sitename'");

		$result2 = $instance->runQuery("UPDATE `settings` SET `sett_value`='".base64_encode($_POST['tagline'])."' WHERE `sett_option`='sitetagline'");

		$result2 = $instance->runQuery("UPDATE `settings` SET `sett_value`='".$_POST['whatsapp']."' WHERE `sett_option`='whatsapp'");

		$result3 = $instance->runQuery("UPDATE `settings` SET `sett_value`='".base64_encode($_POST['headercode'])."' WHERE `sett_option`='headercode'");

		$result4 = $instance->runQuery("UPDATE `settings` SET `sett_value`='".$_POST['phone']."' WHERE `sett_option`='phone'");

		if($result == true){
			
			header('location:../general_settings.php?msgtype=text-success&msg=Changes saved successfully');
		}

		else{

			header('location:../general_settings.php?msgtype=text-danger&msg=Unable to save changes');
		}
	}
	else{

		header('location:../general_settings.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../general_settings.php?msgtype=text-danger&msg=Please fill all required fields and Real Master-Code');
}

?>