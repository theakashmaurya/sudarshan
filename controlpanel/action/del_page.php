<?php

require_once('../../config/dblib.php');

if ($_POST['del_response']=="yes") {
	

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("DELETE FROM `pages` WHERE `id`=".$_POST['id']);

		if($result == true){
			
			header('location:../pages.php?msgtype=text-success&msg=Selected page has been deleted successfully');
		}

		else{

			header('location:../pages.php?msgtype=text-danger&msg=Unable to delete');
		}
	}
	else{

		header('location:../pages.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../pages.php?msgtype=text-danger&msg=Selected page was not deleted');
}

?>