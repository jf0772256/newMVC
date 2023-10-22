<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\utilities\DotEnv;
	
	class Application
	{
		public static Application $app;
		public static string $RootPath;
		
		public Connection $connection;
		
		function __construct(array $config)
		{
			// do initialization stuff...
			Application::$RootPath = $config['rootPath'];
			DotEnv::load($config['envPath']);
			$this->connect();
			// set the constant var $app to this instance
			Application::$app = $this;
		}
		
		function connect() : void
		{
			$this->connection = new Connection($_ENV['DATABASE_CONNECTOR']);
			$this->connection->type = $_ENV['DATABASE_TYPE'];
			$this->connection->name = $_ENV['DATABASE_NAME'];
			$this->connection->user = $_ENV['DATABASE_USER'];
			$this->connection->pass = $_ENV['DATABASE_PASS'];
			$this->connection->port = $_ENV['DATABASE_PORT'];
			$this->connection->host = $_ENV['DATABASE_HOST'];
			
			$this->connection->connect();
		}
	}