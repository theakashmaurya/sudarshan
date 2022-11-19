<?php

require_once('../../config/dblib.php');

if ($_POST['del_response']=="yes") {
	

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("DELETE FROM `contents` WHERE `id`=".$_POST['id']);

		if($result == true){

			unlink("../uploads/".$_POST['image']);
			
			header('location:../page_edit_contents.php?msgtype=text-success&msg=Selected content has been deleted successfully');
		}

		else{

			header('location:../page_edit_contents.php?msgtype=text-danger&msg=Unable to delete');
		}
	}
	else{

		header('location:../page_edit_contents.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../page_edit_contents.php?msgtype=text-danger&msg=Selected content was not deleted');
}

?>