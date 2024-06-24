<?php
	
	
	use Jesse\SimplifiedMVC\Application;
	
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	
	require_once __DIR__ . "/vendor/autoload.php";
	$config = require_once __DIR__ . "/app/config/config.php";
	
	
	$app = new Application($config);
	$db = $app->connection;
	
	
	function buildMigrationsTable (Connection $db) : void
	{
		$sql = "CREATE TABLE IF NOT EXISTS migrations ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, migration VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
		if ($db->connectionType === 'sqlite')
		{
			$sql = "CREATE TABLE IF NOT EXISTS migrations ( id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, migration TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP)";
		}
		$db->ExecuteQuery($sql);
	}
	
	function getAppliedMigrations (Connection $db) : array
	{
		return $db->ExecuteQuery("SELECT migration FROM migrations")->fetchALL(PDO::FETCH_COLUMN);
	}
	
	function prepToRun (Connection $db) : array
	{
		$appliedMigrations = getAppliedMigrations($db);
		$files = scandir(Application::$RootPath . '/migrations');
		return array_diff($files, $appliedMigrations);
	}
	
	function saveMigration (Connection $db, $migration) : void
	{
		$db->ExecuteQuery("INSERT INTO migrations (migration) VALUES (?)", [$migration]);
	}
	
	function logger (string $message) : void
	{
		echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
	}
	
	
	buildMigrationsTable($db);
	$toApplyMigrations = prepToRun($db);
	
	foreach ($toApplyMigrations as $migration)
	{
		if ($migration === '.' || $migration === '..') continue;
		require_once Application::$RootPath . "/migrations/{$migration}";
		$className = pathinfo($migration, PATHINFO_FILENAME);
		$instance = new $className;
		logger("Applying Migration {$migration} ...");
		$instance->up();
		logger("Applied Migration {$migration} ...");
		saveMigration($db, $migration);
	}
	
	logger("All migrations have been run");