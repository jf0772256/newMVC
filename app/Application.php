<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Jesse\SimplifiedMVC\Database\Connection;
	
	class Application
	{
		public static Application $app;
		
		
		public Connection $connection;
		
		function __construct(array $config = ["database" => 'pdo'])
		{
			// do initialization stuff...
			$this->connection = new Connection($config['database']);
			// set the constant var $app to this instance
			Application::$app = $this;
		}
	}