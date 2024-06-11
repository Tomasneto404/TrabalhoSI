<?php

include 'msgEncryption.php';

$msg = "A Maria disse olá";
$key = "Chama";


echo(encryptMsg($msg, $key));