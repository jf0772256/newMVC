<?php
// we will provide this to do key generation
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ERROR);
$args = getopt('s:u:k:', ['known:', 'userSupplied:','key:']);
$signed = $args['s'] ? (string)$args['s'] : $args['string'];
$userProv = $args['u'] ? (string)$args['u'] : $args['userSupplied'];
$key = $args['k'] ? (string)$args['k'] : $args['key'];

require_once dirname(__DIR__, 2) . "/vendor/autoload.php";
use Jesse\SimplifiedMVC\Utilities\Signature;

if (empty($signed))
{
	throw new Exception("Must pass string to sign. Use -s=\{string to sign\} OR --string=\{string to sign\}");
}

if (empty($userProv))
{
	throw new Exception("Must pass string to sign. Use -u=\{string to verify\} OR --string=\{string to verify\}");
}

if (empty($key))
{
	throw new Exception("Must pass key used to sign string. Use -k=\{key\} OR --key=\{key\}");
}
try
{
	Signature::setKey($key);
	echo "Checking Signature." . PHP_EOL;
	echo "Signed: " . (Signature::verify($signed, $userProv) ? 'Is Valid' . PHP_EOL : 'Is INVALID!' . PHP_EOL);
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