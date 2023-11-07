<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Jesse\SimplifiedMVC\Utilities\DotEnv;
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\Exception\BadRequest;
	use Jesse\SimplifiedMVC\Exception\Forbidden;
	use Jesse\SimplifiedMVC\Exception\NotFound;
	use Exception;
	use Jesse\SimplifiedMVC\Utilities\Signature;
	use Jesse\SimplifiedMVC\Utilities\SimpleEncoder;
	
	class Application
	{
		public static Application $app;
		public static string $RootPath;
		
		public Connection $connection;
		public Response $response;
		public Request $request;
		public Router $router;
		public SimpleEncoder $encoder;
		
		function __construct(array $config)
		{
			// do initialization stuff...
			Application::$RootPath = $config['rootPath'];
			DotEnv::load($config['envPath']);
			$this->connect();
			$this->response = new Response();
			$this->request = new Request();
			$this->router = new Router($this->request, $this->response);
			Signature::setKey($_ENV['SIGNATURE_KEY']);
			$this->encoder = new SimpleEncoder($_ENV['ENCODER_KEY']);
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
		
		/**
		 * Run the application and route any routes!
		 * @return void
		 */
		function run () {
			try
			{
				echo $this->router->resolve();
			}
			catch (NotFound $e)
			{
				$this->response->statusCode($e->getCode());
				echo "<h1>Page Not Found</h1>"; // $this->view->renderView('_error', ['exception' => $e]);
			}
			catch (Forbidden $f)
			{
				$this->response->statusCode($f->getCode());
				echo "<h1>Unauthorized Access</h1>"; // $this->view->renderView('_error', ['exception' => $e]);
			}
			catch (BadRequest $b)
			{
				$this->response->statusCode($b->getCode());
				echo "<h1>400: Unable to process request</h1>";
			}
			catch (Exception $e)
			{
				die($e);
			}
		}
	}