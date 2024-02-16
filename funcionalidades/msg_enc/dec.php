<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $enc_msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
    $key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);

    if ($enc_msg !== false && $key !== false) {

        $enc_msg_iv_base64 = urldecode($enc_msg);
        $enc_msg_iv = base64_decode($enc_msg_iv_base64);

        $enc_msg = substr($enc_msg_iv, 0, -openssl_cipher_iv_length("aes-256-cbc"));
        $iv = substr($enc_msg_iv, -openssl_cipher_iv_length("aes-256-cbc"));
        
        $dec_msg = openssl_decrypt($enc_msg, 'aes-256-cbc', $key, 0, $iv);

        if ($dec_msg !== false) {
            header("Location: ../../msgencryption.php?decrypted_msg=$dec_msg");
            exit();
        } else {
            echo "ERROR: Couldn't decrypt the message.";
        }
        
    } else {
        echo "ERROR: Input data is invalid.";
    }
} else {
    echo "ERROR: Request not accepted.";
}

?>
