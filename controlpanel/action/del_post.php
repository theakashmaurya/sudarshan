<?php

require_once('../../config/dblib.php');

if ($_POST['del_response']=="yes") {
	

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("DELETE FROM `posts` WHERE `id`=".$_POST['id']);

		if($result == true){

			unlink("../uploads/".$_POST['image']);
			
			header('location:../posts.php?msgtype=text-success&msg=Selected post has been deleted successfully');
		}

		else{

			header('location:../posts.php?msgtype=text-danger&msg=Unable to delete');
		}
	}
	else{

		header('location:../posts.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../posts.php?msgtype=text-danger&msg=Selected post was not deleted');
}

?>