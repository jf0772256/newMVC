<?php
// we will provide this to do key generation
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR);
$args = getopt('s:k:', ['string:','key:']);
$toSign = $args['s'] ? (string)$args['s'] : $args['string'];
$key = $args['k'] ? (string)$args['k'] : $args['key'];

require_once dirname(__DIR__, 2) . "/vendor/autoload.php";
use Jesse\SimplifiedMVC\Utilities\Signature;

if (empty($toSign))
{
	throw new Exception("Must pass string to sign. Use -s=\{string to sign\} OR --string=\{string to sign\}");
}

if (empty($key))
{
	throw new Exception("Must pass key used to sign string. Use -k=\{key\} OR --key=\{key\}");
}
try
{
	Signature::setKey($key);
	echo "Generating Signature." . PHP_EOL;
	echo "Unsigned: {$toSign}" . PHP_EOL;
	echo "Signed: " . Signature::sign($toSign) . PHP_EOL;
	echo "Done...";
}
catch (\Throwable $e)
{
	echo "There was an error:" . PHP_EOL;
	print_r($e);
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// end code op
exit();