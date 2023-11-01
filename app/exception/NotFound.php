<?php
	
	namespace Jesse\SimplifiedMVC\Exception;
	
	class NotFound extends \Exception
	{
		protected $code = 404;
		protected $message = "The page you're looking for couldn't be found";
	}