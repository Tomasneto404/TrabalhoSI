<?php

function encryptMsg($msg, $key) {
    $cipher = "aes-256-cbc";
    $options = OPENSSL_RAW_DATA;
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $encrypted = openssl_encrypt($msg, $cipher, $key, $options, $iv);

    return base64_encode($iv . $encrypted);
}

function decryptMsg($encryptedMsg, $key) {
    $cipher = "aes-256-cbc";
    $options = OPENSSL_RAW_DATA;
    $ivLength = openssl_cipher_iv_length($cipher);
    $data = base64_decode($encryptedMsg);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);

    return openssl_decrypt($encrypted, $cipher, $key, $options, $iv);
}

