<?php
	
	namespace Jesse\SimplifiedMVC\Exception;
	use Exception;
	class MiddlewareNotFound extends Exception
	{
		protected $code = 436;
		protected $message;
		public function __construct (string $key)
		{
			$this->message = "The middleware that you attempted to load was not found ('{$key}'). Make sure that you have created the class and have added the class to the lookup MAP constant in Middleware.php";
			parent::__construct($this->message, $this->code);
		}
	}