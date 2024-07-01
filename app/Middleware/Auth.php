<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	
	class Auth
	{
		public function handle () : void
		{
			// do auth check... if not authenticated redirect to new location
			if (!Application::$app->session->getValue('authenticated'))
			{
				// Testing
				(new Response())->redirect('/login');
			}
		}
	}