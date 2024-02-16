<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_STRING);
    $key = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);

    if ($msg !== false) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
        $enc_msg = openssl_encrypt($msg, 'aes-256-cbc', $key, 0, $iv);

        if ($enc_msg !== false) {
            
            $msg_to_pass = base64_encode($enc_msg.$iv);
            
            $final_msg = urlencode($msg_to_pass);
            header("Location: ../../msgencryption.php?encrypted_msg=$final_msg");
            exit();
        } else {
            echo "ERROR: Couldn't encrypt the message.";
        }
    } else {
        echo "ERROR: Input data is invalid.";
    }
} else {
    echo "ERROR: Request not accepted.";
}

?>
