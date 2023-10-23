<?php
// we will provide this to do key generation
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR);
$args = getopt('l:', ['keyLength:']);
$keyLen = $args['l'] ? (int)$args['l'] : $args['keyLength'];

$key = bin2hex(openssl_random_pseudo_bytes($keyLen));

echo "Generated key successfully:" . PHP_EOL;
echo "update your env fields with the following values:" . PHP_EOL;
echo "ENCODER_KEY_LENGTH={$keyLen}" . PHP_EOL;
echo "ENCODER_KEY={$key}" . PHP_EOL;



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// end code op
exit();