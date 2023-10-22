<?php
	
	namespace Jesse\SimplifiedMVC;
	
	class Application
	{
		public static Application $app;
		function __construct()
		{
			// do initialization stuff...
			// set the constant var $app to this instance
			Application::$app = $this;
		}
	}