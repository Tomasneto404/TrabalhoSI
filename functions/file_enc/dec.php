<?php

include 'fileEncryption.php';

CONST MSG_UPLOAD_ERROR = "Houve um erro no upload do ficheiro.";
CONST MSG_FILE_OVERSIZED = "Ficheiro é demasiado grande.";
CONST UPLOAD_FOLDER = "../../uploads/";
CONST MAX_FILE_SIZE = 100000000;

if (isset($_POST['upload'])) {

    $key = $_POST['key'];
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    if ($fileError === 0) {

        if ($fileSize < MAX_FILE_SIZE) {

            $fileNewName = uniqid('', true).".".$fileActualExt;
            
            if (move_uploaded_file($fileTmpName, UPLOAD_FOLDER.$fileNewName)) {

                $decFile = $fileNewName;
                
                decryptFile(UPLOAD_FOLDER.$decFile, UPLOAD_FOLDER.$decFile, $key);
                
                header("Location: ../../fileencryption.php?file=".$decFile);

            } else {
                header("Location: ../../fileencryption.php?success=0");
            }        

        } else {
            echo MSG_FILE_OVERSIZED;
        }

    } else {
        echo MSG_UPLOAD_ERROR;
    }

}