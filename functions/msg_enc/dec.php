<?php
    include 'msgEncryption.php';

    if (isset($_POST['msg']) && isset($_POST['key'])) {
        $msg = $_POST['msg'];
        $key = $_POST['key'];
        

        $dec_msg = decryptMsg($msg, $key);

        if ($dec_msg) {
            header("Location: ../../msgencryption.php?decrypted_msg=".urlencode($dec_msg));
        } else {
            header("Location: ../../msgencryption.php?erro=1");
        }
        
    }
?>
