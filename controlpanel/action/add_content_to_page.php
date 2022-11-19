<?php

require_once('../../config/dblib.php');


if (isset($_POST['pageid']) && isset($_POST['type'])) {
	
	$type=$_POST['type'];
	$image=$_POST['image'];
	$heading=base64_encode($_POST['heading']);
	$subheading=base64_encode($_POST['subheading']);
	$content=base64_encode($_POST['content']);
	$bgcolor=$_POST['bgcolor'];
	$fgcolor=$_POST['fgcolor'];
	$pageid=$_POST['pageid'];
	$orderno=$_POST['orderno'];

	if(strlen(basename($_FILES["fileToUpload"]["name"]))>=4){

		$image = rand(99, 9999999).basename($_FILES["fileToUpload"]["name"]);
	
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

	$instance = new DatabaseLib();

	$connStatus = $instance->createConnection();

	if ($connStatus == true) {

		$result = $instance->runQuery("INSERT INTO `contents`(`type`,`image`, `heading`, `subheading`, `content`, `bgcolor`, `fgcolor`, `pageid`, `orderno`) VALUES('".$type."', '".$image."', '".$heading."', '".$subheading."', '".$content."', '".$bgcolor."', '".$fgcolor."', ".$pageid.", ".$orderno.")");


		if($result == true){

			header('location:../page_edit_contents.php?msgtype=text-success&msg=New content has been added!');
		}

		else{

			header('location:../page_edit_contents.php?msgtype=text-danger&msg=Unable to add new content');
		}
	}
	else{

		header('location:../page_edit_contents.php?msgtype=text-danger&msg=Server lost connectivity!');
	}

}
else{
	header('location:../page_edit_contents.php?msgtype=text-danger&msg=Please fill all required fields');
}

?>
