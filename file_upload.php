<?php

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen

  $uploadError = array( 0=>"There is no error, the file uploaded with success",
                        1 =>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
                        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                        3=>"The uploaded file was only partially uploaded",
                        4=>"No file was uploaded",
                        6=>"Missing a temporary folder"
                      );

    if( isset( $uploadError[$fileErrorMsg] ) ){
        print_r($uploadError[$fileErrorMsg]);
    }
    else {
        echo "ERROR: Please browse for a file before clicking the upload button.";
    }

    exit();
}
if(move_uploaded_file($fileTmpLoc, $fileName)){
    echo "$fileName upload is complete";
} else {
    echo "move_uploaded_file function failed";
}
?>
