<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use Exception;
	
	class Controller
	{
		public string $layout = "main";
		public string $action = "";
		
		function render(string $view, array $params) : string
		{
			return Application::$app->view->renderView($view, $params);
		}
		
		/**
		 * @throws Exception
		 */
		function getBody(): array
		{
			return Application::$app->request->getRequestBody();
		}
		function setLayout (string $layout) : void
		{
			$this->layout = $layout;
		}
	}