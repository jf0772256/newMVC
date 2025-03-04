<?php
	
	namespace Jesse\SimplifiedMVC\Http\Controllers;
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Controller;
	use Jesse\SimplifiedMVC\Exception\BadRequest;
	use Jesse\SimplifiedMVC\Http\Models\LoginForm;
	use Jesse\SimplifiedMVC\Http\Models\User;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	
	class userController extends Controller
	{
		function guestUserView(Request $request) : string
		{
			$this->setLayout('main');
			$params = ['title' => 'Users Page'];
			foreach ($request->params as $key => $value) $params[$key] = $value;
			return $this->render('userList', $params);
		}
		function authUserView(Request $request) : string
		{
			$this->setLayout('main');
			$params = ['title' => 'Auth Users Page'];
			foreach ($request->params as $key => $value) $params[$key] = $value;
			$user = User::find(['id' => $params['id']]) ?? new User();
			if ($user->firstName === "") $params["id"] = null;
			$params['model'] = $user;
			return $this->render('authUserList', $params);
		}
		
		/**
		 * @throws \Exception
		 */
		function register (Request $request) : string
		{
			$this->setLayout('noauth');
			$user = new User();
			if (Application::$app->request->isPost())
			{
				$user->loadData($this->getBody());
				if ($user->validate() && $user->save())
				{
					Application::$app->session->setFlash(['success', "You've successfully have been registered."]);
					Application::$app->response->redirect('/login');
					exit();
				}
			}
			return $this->render('register', ['title' => 'Register User', 'model' => $user]);
		}
		
		/**
		 * @throws \Jesse\SimplifiedMVC\Router\Exception\BadRequest
		 * @throws \Exception
		 */
		function login (Request $request) : string
		{
			$this->setLayout('noauth');
			$login = new LoginForm();
			if ($request->isPost())
			{
				$login->loadData($this->getBody());
				if ($login->validate() && $login->login())
				{
					// set session and redirect
					Application::$app->user = User::find(['email' => $login->email]);
					Application::$app->session->setValue('authenticated', true);
					Application::$app->session->setValue('user', Application::$app->user->id);
					Application::$app->response->redirect('/');
				}
			}
			return $this->render('login', ['title' => 'Log In', 'model' => $login]);
		}
		
		function logout(Request $request) : string
		{
			Application::$app->session->clear('authenticated');
			Application::$app->session->clear('user');
			Application::$app->user = new User();
			Application::$app->response->redirect('/');
		}
	}