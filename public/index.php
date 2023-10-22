<?php
	
	use Jesse\SimplifiedMVC\Application;
	
	require_once __DIR__ . "/../vendor/autoload.php";
	$config = require_once "../app/config/config.php";
	// [
	// 	"rootPath" => dirname(__DIR__, 1),
	// 	"envPath" => dirname(__DIR__, 1) . "/.env"
	// ];
	
	$app = new Application($config);
	
	$data = Application::$app->connection->ExecuteQuery("SELECT 'Hello World! Using Static' as text_col", [])->fetchObject()->text_col;
	echo "does this show: {$data}";