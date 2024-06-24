<?php
	
	namespace Jesse\SimplifiedMVC\Middleware;
	
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	
	class Auth
	{
		public function handle () : void
		{
			// do auth check... if not authenticated redirect to new location
			// Testing
			(new Response())->redirect('/login');
		}
	}