<?php

require_once('../../config/dblib.php');

$addmsg="";


if (isset($_POST['title']) && isset($_POST['id'])) {

	if(strlen(basename($_FILES["fileToUpload"]["name"]))>=4){

		$image = rand(99, 9999999).basename($_FILES["fileToUpload"]["name"]);

		unlink("../uploads/".$_POST['oldimage']);
	
		$target_dir = "../uploads/";
		$target_file = $target_dir . $image;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    $addmsg = "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    $addmsg = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $addmsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $addmsg = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $addmsg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        $addmsg = "Sorry, there was an error uploading your file.";
		    }
		}

	}
	else{

		$image = $_POST['oldimage'];
	}


	$title=$_POST['title'];
	$content=$_POST['content'];
	$status=$_POST['status'];

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("UPDATE `posts` SET `title`='".base64_encode($title)."', `image`='".$image."', `content`='".base64_encode($content)."', `status`='".$status."' WHERE `id`=".$_POST['id']."");


		if($result == true){

			header('location:../posts.php?msgtype=text-success&msg=Changes has been saved! '.$addmsg);
		}

		else{

			header('location:../posts.php?msgtype=text-danger&msg=Unable to save new changes '.$addmsg);
		}
	}
	else{

		header('location:../posts.php?msgtype=text-danger&msg=Server lost connectivity! '.$addmsg);
	}

}
else{
	header('location:../posts.php?msgtype=text-danger&msg=Please fill all required fields '.$addmsg);
}

?>
