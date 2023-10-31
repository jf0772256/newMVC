<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\Utilities\DotEnv;
	
	class Application
	{
		public static Application $app;
		public static string $RootPath;
		
		public Connection $connection;
		public Response $response;
		public Request $request;
		public Router $router;
		
		function __construct(array $config)
		{
			// do initialization stuff...
			Application::$RootPath = $config['rootPath'];
			DotEnv::load($config['envPath']);
			$this->connect();
			$this->response = new Response();
			$this->request = new Request();
			$this->router = new Router($this->request, $this->response);
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