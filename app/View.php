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
		
		/**
		 * Mostly used for specific one use type layouts are expected
		 * @param string $view view name
		 * @param string $layout layout name
		 * @param array  $parameters parameter array
		 *
		 * @return string rendered content
		 */
		function renderOneTimeViewOnLayout(string $view, string $layout, array $parameters = []) : string
		{
			$viewContent = $this->renderOnlyView($view, $parameters);
			$layoutData = $this->oneTimeLayoutContent($layout, $parameters);
			return str_replace("{{content}}", $viewContent, $layoutData);
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
		protected function oneTimeLayoutContent (string $layout, array $params = []) : string
		{
			foreach ($params as $key => $value) $$key = $value;
			ob_start();
			include_once Application::$RootPath . "/views/layouts/{$layout}.php";
			return ob_get_clean();
		}
	}