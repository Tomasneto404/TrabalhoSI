<?php

function encryptFile($inputFile, $outputFile, $key) {
    $cipher = "aes-256-cbc";
    $inputData = file_get_contents($inputFile);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $encryptedData = openssl_encrypt($inputData, $cipher, $key, 0, $iv);
    file_put_contents($outputFile, base64_encode($encryptedData) . '|' . base64_encode($iv));
}

function decryptFile($inputFile, $outputFile, $key) {
    $cipher = "aes-256-cbc";
    $data = file_get_contents($inputFile);
    list($encryptedData, $iv) = explode('|', $data);
    $encryptedData = base64_decode($encryptedData);
    $iv = base64_decode($iv);
    $decryptedData = openssl_decrypt($encryptedData, $cipher, $key, 0, $iv);
    file_put_contents($outputFile, $decryptedData);
}

?>