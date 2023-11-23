<?php
ini_set("display_errors", "Off");
ini_set("display_startup_errors", "Off");
error_reporting(0);

$banner = require_once "__banner.php";

echo $banner;

$args = getopt('a:hc:', ['action:','help','command']);
$commands = ["build", "up", "down", "create"];
$action = $args['a'] ?: $args['action'];

//for help
$help = isset($args['h']) || isset($args['help']);
$helpCommand = $args['c'] ?: $args['command'];

//help screen
if (empty($action) || $help && empty($helpCommand))
{
	// help data to screen
	echo  PHP_EOL . PHP_EOL . "Simple MVC migration help screen." . PHP_EOL;
	echo "For help with commands type `php migration -h|--help [-c|--command={commandName}]`" . PHP_EOL;
	echo "Command List:" . PHP_EOL;
	echo "build    ::::::::: Builds and sets up system for migration runs." . PHP_EOL;
	echo "up       ::::::::: Runs all the migrations that you have created." . PHP_EOL;
	echo "down     ::::::::: Runs the down methods for the migrations that you have created." . PHP_EOL;
	echo "create   ::::::::: Creates a new empty migration file." . PHP_EOL . PHP_EOL;
	if(empty($helpCommand)) exit();
}

if ($help && !empty($helpCommand))
{
	// command specific help
	echo PHP_EOL . PHP_EOL;
	switch ($helpCommand)
	{
		case "build":
			echo "Runs a small script to set up the system for generating the structure needed for migrations, \nas well as the database table.\nThis needs to be set up before running the other commands.";
			break;
		case "up":
			echo "Runs through the migrations in the migration file and runs them against the database. Then will save the script name to the migrations table so that it wont be run again while the modifications exist.";
			break;
		case "down":
			echo "Running down undoes the migrations from the database table for the migrations, this walks them backwards so that \nthere shouldn't be an error, it will also disable FK while this process is running.\nThis will result in all data being lost as well.";
			break;
		case "create":
			echo "Creates a new php migration class file in the migrations folder that then you'll need to populate with teh actual commands. You then can run the up or down command to create the data or drop the data.";
			break;
	}
	echo PHP_EOL . PHP_EOL;
	exit();
}

echo PHP_EOL . PHP_EOL;
switch ($action)
{
	case "build":
		require 'subCommand/mig_build.php';
		break;
	case "up":
		break;
	case "down":
		break;
	case "create":
		break;
}
echo PHP_EOL . PHP_EOL;

ini_set("display_errors", "On");
ini_set("display_startup_errors", "On");
error_reporting(E_ALL);

// end code op
exit();