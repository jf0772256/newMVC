<?php
	
	namespace Jesse\SimplifiedMVC\Facades\Router;
	
	use \Jesse\SimplifiedMVC\Router\Request as Request;
	
	class RequestFacade extends Request {
		public function __construct () {
			parent::__construct();
		}
	}