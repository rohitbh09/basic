<?php

$fileName     = $_FILES["uploadFileInp"]["name"]; // The file name
$fileTmpLoc   = $_FILES["uploadFileInp"]["tmp_name"]; // File in the PHP tmp folder
$fileType     = $_FILES["uploadFileInp"]["type"]; // The type of file it is
$fileSize     = $_FILES["uploadFileInp"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["uploadFileInp"]["error"]; // 0 for false... and 1 for true
$target_dir   = "uploads/".$fileName;

if (!$fileTmpLoc) { // if file not chosen

  $uploadError = array( 0=>"There is no error, the file uploaded with success",
                        1 =>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
                        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                        3=>"The uploaded file was only partially uploaded",
                        4=>"No file was uploaded",
                        6=>"Missing a temporary folder",
                        7 => 'Failed to write file to disk.',
                        8 => 'A PHP extension stopped the file upload.',
                      );

    if( isset( $uploadError[$fileErrorMsg] ) ){
        print_r($uploadError[$fileErrorMsg]);
    }
    else {
        echo "ERROR: Please browse for a file before clicking the upload button.";
    }

    exit();
}

if ( ! is_writable(dirname($target_dir))) {

    echo dirname( $target_dir ) . ' folder must writable!!!';
    exit();
}


if(move_uploaded_file( $fileTmpLoc, $target_dir.$fileName)){
    echo "$fileName upload is complete";
} else {
    echo "move_uploaded_file function failed";
}
?>
