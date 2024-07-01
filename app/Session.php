<?php
	
	namespace Jesse\SimplifiedMVC;
	
	class Session
	{
		private const string FLASH_KEY = "Session_Flash_Key";
		
		function __construct ()
		{
			// session not created... lets create one
			if(session_status() === PHP_SESSION_NONE)
			{
				session_start();
			}
		}
		function destroy ()
		{
			session_destroy();
		}
		
		function clear(?string $key = null) : void
		{
			if (!empty($key))
				$_SESSION[$key] = null;
			else
				$_SESSION = [];
		}
		
		function setValue (string $key, $value) : void
		{
			$_SESSION[$key] = $value;
		}
		
		function setFlash ($value) : void
		{
			$_SESSION[self::FLASH_KEY] = $value;
		}
		
		function getFlash()
		{
			$temp =  $_SESSION[self::FLASH_KEY];
			$_SESSION[self::FLASH_KEY] = null;
			return $temp;
		}
		
		public function getValue (string $key)
		{
			return $_SESSION[$key];
		}
		
		public function hasValue (string $key) : bool
		{
			return isset($_SESSION[$key]);
		}
	}