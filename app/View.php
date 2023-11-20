<?php
	
	namespace Jesse\SimplifiedMVC;
	
	class View
	{
		public string $title = '';
		function renderView (string $view, array $parameters = []) : string
		{
			// load the page buffer and return the view
			$viewContent = $this->renderOnlyView($view, $parameters);
			$layoutData = $this->layoutContent($parameters);
			return str_replace("{{content}}", $viewContent, $layoutData);
		}
		function renderContent (string $content, array $params = []) : string
		{
			$layout = $this->layoutContent($params);
			return str_replace('{{content}}', $content, $layout);
		}
		protected function layoutContent (array $params = []) : string
		{
			$layout = Application::$app->layout;
			if (Application::$app->controller) $layout = Application::$app->controller->layout;
			foreach ($params as $key => $value) $$key = $value;
			ob_start();
			include_once Application::$RootPath . "/views/layouts/{$layout}.php";
			return ob_get_clean();
		}
		protected function renderOnlyView (string $view, array $params = []) : string
		{
			foreach ($params as $key => $value) $$key = $value;
			ob_start();
			include_once Application::$RootPath . "/views/{$view}.php";
			return ob_get_clean();
		}
	}