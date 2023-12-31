<?php
	
	namespace Jesse\SimplifiedMVC\Http\Controllers;
	
	use Jesse\SimplifiedMVC\Controller;
	use Jesse\SimplifiedMVC\Exception\BadRequest;
	use Jesse\SimplifiedMVC\Http\Models\User;
	use Jesse\SimplifiedMVC\Request;
	use Jesse\SimplifiedMVC\Response;
	
	class userController extends Controller
	{
		function guestUserView(Request $request) : string
		{
			$params = ['title' => 'Users Page'];
			foreach ($request->params as $key => $value) $params[$key] = $value;
			return $this->render('userList', $params);
		}
		function authUserView(Request $request) : string
		{
			$params = ['title' => 'Auth Users Page'];
			foreach ($request->params as $key => $value) $params[$key] = $value;
			return $this->render('authUserList', $params);
		}
		
		/**
		 * @throws BadRequest
		 */
		function create (Request $request, Response $response) : string
		{
			// create a new user here...
			$userId = 0;
			try
			{
				$request->requestExpects('application/json');
				$body = $request->getRequestBody();
				$user = new User();
				$user->loadData($body);
				$user->validate();
				if (count($user->errors) > 0)
				{
					$response->customErrorCode("Request body contains errors. Please see the errors object for details.", 400);
					header("Content-Type: application/json; charset: utf-8");
					return json_encode($user);
				}
				
			}
			catch (\Throwable $e)
			{
				$exception = new BadRequest("REQUEST.BODY.INVALID", 400, $e);
				$respData = ["message" => "REQUEST.BODY.INVALID", "code" => 400, "previousError" => ["message" => $e->getMessage() ?? "NO.PREVIOUS.ERROR", "code" => $e->getCode() ?? "NO.PREVIOUS.ERROR"]];
				$response->statusCode($exception->getCode());
				header("Content-Type: application/json; charset: utf-8");
				die(json_encode($respData));
			}
			$response->customErrorCode("Data Accepted & Processed Successfully, OK.", 200);
			return json_encode(['result' => true, 'userId' => $userId, 'message' => 'User was created successfully']);
		}
	}