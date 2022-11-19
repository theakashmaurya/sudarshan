<?php

require_once('../../config/dblib.php');

if ($_POST['del_response']=="yes") {
	

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("DELETE FROM `widgets` WHERE `id`=".$_POST['id']);

		if($result == true){
			
			header('location:../widgets.php?msgtype=text-success&msg=Selected element has been deleted successfully');
		}

		else{

			//header('location:../widgets.php?msgtype=text-danger&msg=Unable to delete');
		}
	}
	else{

		header('location:../widgets.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../widgets.php?msgtype=text-danger&msg=Selected element was not deleted');
}

?>