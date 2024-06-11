<?php
include 'msgEncryption.php';

if (isset($_POST['msg']) && isset($_POST['key'])) {
    $msg = $_POST['msg'];
    $key = $_POST['key'];
   

    $enc_msg = encryptMsg($msg, $key);

    header("Location: ../../msgencryption.php?encrypted_msg=".urlencode($enc_msg));
}

?>
