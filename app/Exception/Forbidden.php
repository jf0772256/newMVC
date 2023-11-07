<?php
	
	namespace Jesse\SimplifiedMVC\Exception;
	use Exception;
	class Forbidden extends Exception
	{
		protected $code = 403;
		protected $message = "You are not allowed to view this page";
	}