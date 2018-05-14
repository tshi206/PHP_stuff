<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    print_r($file);
    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $str_array = explode('.', $filename);
    $fileExt = strtolower(end($str_array));

    $allowedExt = array('jpg', 'jpeg', 'png', 'ico', 'pdf');

    if (in_array($fileExt, $allowedExt)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) { // file size in Bytes
                $fileNameNew = uniqid('file', true); // unique id based on current time in microsecond
                $fileNameNew = $fileNameNew.".".$fileExt;
                $fileDestination = './uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?upload=success");
            } else {
                echo 'Your file is too big!';
            }
        } else {
            echo 'There was an error uploading your file!';
        }
    } else {
        echo 'you cannot upload files of this type!';
    }
}