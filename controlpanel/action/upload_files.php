<?php

require_once('../../config/dblib.php');

if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "../uploads_widget/" . $shortname;

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                    $instance = new DatabaseLib();

                    $connStatus = $instance->createConnection();

                    if ($connStatus == true) {

                        $result = $instance->runQuery("INSERT INTO `uploads`(`description`, `filename`, `widget_id`) VALUES('', '".$shortname."', ".$_POST['widget_id'].")");

                        if($result == true){
                            
                            header('location:../widgets.php?msgtype=text-success&msg=New files has been added successfully');
                        }

                        else{

                            header('location:../widgets.php?msgtype=text-danger&msg=Unable to add new files');
                        }
                    }
                    else{

                        header('location:../widgets.php?msgtype=text-danger&msg=Server lost connectivity!');
                    }

                }
            }
        }
    }
}
?>
