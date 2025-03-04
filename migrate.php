<?php
	
	
	use Jesse\SimplifiedMVC\Application;
	
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	
	require_once __DIR__ . "/vendor/autoload.php";
	$config = require_once __DIR__ . "/app/config/config.php";
	
	try
	{
		$app = new Application($config);
	}
	catch (Exception $e)
	{
		logger("Migration failed to run" . $e->getMessage());
		die();
	}
	$app->connection;
	
	//function buildMigrationsTable (Connection $db) : void
	function buildMigrationsTable () : void
	{
		global $app;
		$app->builder->build($app->builder->builder()
			->createTable('migrations')
			->primary()
			->string('migration', 255)
			->dateTime('created_at')
			->defaults('CURRENT_TIMESTAMP')
		);
		// $sql = "CREATE TABLE IF NOT EXISTS migrations ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, migration VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
		// if ($db->connectionType === 'sqlite')
		// {
		// $sql = "CREATE TABLE IF NOT EXISTS migrations ( id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, migration TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP)";
		// }
		// $db->ExecuteQuery($sql);
	}
	//function getAppliedMigrations (Connection $db) : array
	function getAppliedMigrations () : array
	{
		global $app;
		return $app->builder->build($app->builder->builder()->select('migrations', ['migration']))->fetchAll(PDO::FETCH_COLUMN);
		// return $db->ExecuteQuery("SELECT migration FROM migrations")->fetchALL(PDO::FETCH_COLUMN);
	}
	
	//function prepToRun (Connection $db) : array
	function prepToRun () : array
	{
		$appliedMigrations = getAppliedMigrations();
		$files = scandir(Application::$RootPath . '/migrations');
		return array_diff($files, $appliedMigrations);
	}
	
	//function saveMigration (Connection $db, $migration) : void
	function saveMigration ($migration) : void
	{
		global $app;
		$app->builder->build($app->builder->builder()
			->insert('migrations', ['migration' => $migration])
		);
		// $db->ExecuteQuery("INSERT INTO migrations (migration) VALUES (?)", [$migration]);
	}
	
	function logger (string $message) : void
	{
		echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
	}
	
	
	buildMigrationsTable();
	$toApplyMigrations = prepToRun();
	// go through the array and make sure undesirable values are not present, such as ., .., .gitignore, .gitkeep
	$tempArray = [];
	foreach ($toApplyMigrations as $filename)
	{
		if ($filename !== '.' && $filename !== '..' && $filename !== '.gitignore' && $filename !== '.gitkeep')
		{
			$tempArray[] = $filename;
			continue;
		}
		continue;
	}
	$toApplyMigrations = $tempArray;
	$tempArray = [];
	if (count ($toApplyMigrations) === 0)
	{
		logger("No migrations needing run were found");
		die();
	}
	foreach ($toApplyMigrations as $migration)
	{
		if ($migration === '.' || $migration === '..') continue;
		require_once Application::$RootPath . "/migrations/{$migration}";
		$className = pathinfo($migration, PATHINFO_FILENAME);
		$instance = new $className;
		logger("Applying Migration {$migration} ...");
		$instance->up();
		logger("Applied Migration {$migration} ...");
		saveMigration($migration);
	}
	
	logger("All migrations have been run");