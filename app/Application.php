<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Jesse\SimplifiedMVC\Http\Models\User;
	use Jesse\SimplifiedMVC\Utilities\DotEnv;
	use Jesse\SimplifiedMVC\Database\Connection;
	use Jesse\SimplifiedMVC\Exception\BadRequest;
	use Jesse\SimplifiedMVC\Exception\Forbidden;
	use Jesse\SimplifiedMVC\Exception\NotFound;
	use Exception;
	use Jesse\SimplifiedMVC\Utilities\Signature;
	use Jesse\SimplifiedMVC\Utilities\SimpleEncoder;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	use Jesse\SimplifiedMVC\Facades\Router\RouterFacade as Router;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	
	class Application
	{
		public static Application $app;
		public static string $RootPath;
		public Connection $connection;
		
		public Response $response;
		public Request $request;
		public Router $router;
		public SimpleEncoder $encoder;
		public Controller $controller;
		public View $view;
		public User $user;
		public Session $session;
		public string $layout = "main";
		
		function __construct(array $config)
		{
			// do initialization stuff...
			Application::$RootPath = $config['rootPath'];
			// if running in a native application server
			// DotEnv::load($config['envPath']);
			// if using docker containers use this file...
			DotEnv::load($config['dockerSiteEnvPath']);
			$this->connect();
			$this->session = new Session();
			if (!$this->session->hasValue('user')) $this->session->setValue('user', null);
			if (!$this->session->hasValue('authenticated')) $this->session->setValue('authenticated', false);
			$this->response = new Response();
			$this->request = new Request();
			$this->router = new Router($this->request, $this->response, $config['routesPath']);
			$this->controller = new Controller();
			$this->view = new View();
			if (!empty($_ENV['SIGNATURE_KEY'])) Signature::setKey($_ENV['SIGNATURE_KEY']);
			$this->encoder = new SimpleEncoder($_ENV['ENCODER_KEY']);
			// set the constant var $app to this instance
			Application::$app = $this;
			$this->user = (!empty($this->session->getValue('user'))) ? User::find(['id' => $this->session->getValue('user')]) : new User();
			$this->user->password = "Removed For Safety";
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
			
			//Utility::dieAndDumpPretty($this->connection);
			
			$this->connection->connect();
		}
		
		/**
		 * Run the application and route any routes!
		 * @return void
		 */
		function run (): void
		{
			try
			{
				echo $this->router->resolve();
			}
			catch (NotFound $e)
			{
				$this->response->statusCode($e->getCode());
				echo $this->view->renderView('_error', ['exception' => $e]);
			}
			catch (Forbidden $f)
			{
				$this->response->statusCode($f->getCode());
				echo $this->view->renderView('_error', ['exception' => $f]);
			}
			catch (BadRequest $b)
			{
				$this->response->statusCode($b->getCode());
				echo  $this->view->renderView('_error', ['exception' => $b]);
			}
			catch (Exception $ex)
			{
				$this->response->statusCode($ex->getCode());
				echo  $this->view->renderView('_error', ['exception' => $ex]);
			}
		}
	}