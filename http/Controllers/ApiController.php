<?php
namespace Jesse\SimplifiedMVC\Http\Controllers;

use Jesse\SimplifiedMVC\Controller;
use Jesse\SimplifiedMVC\Exception\BadRequest;
use Jesse\SimplifiedMVC\Http\Models;
use \Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
use \Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
use Jesse\SimplifiedMVC\Http\Models\User;
use PDO;

class ApiController extends Controller
{
	function __construct() {
		// no layouts or views, all are specific
		$this->setLayout('');
	}
	
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
	
	function users(Request $request, Response $response) : string
	{
		switch ($request->isGet())
		{
			case true:
				$result = ['request_type' => 'all_users', 'date' => date('Y-m-d'), 'time' => date('H:i:s'), 'error' => null];
				$result['data'] = Models\User::fetchAll()->fetchAll( PDO::FETCH_ASSOC);
				foreach ($result['data'] as $user)
				{
					$user['password'] = "Sensitive Password Removed";
				}
				return json_encode($result);
				break;
			default:
				// toss error back at the request
				$response->statusCode(405);
				$result = ['request_type' => 'all_users', 'date' => date('Y-m-d'), 'time' => date('H:i:s'), 'data' => null, 'error' => 'METHOD.NOT.SUPPORTED'];
				return json_encode($result);
		}
	}
	
	function user(Request $request, Response $response) : string
	{
		switch ($request->isGet())
		{
			case true:
				$result = ['request_type' => 'single_user', 'date' => date('Y-m-d'), 'time' => date('H:i:s'), 'error' => null];
				$result['data'] = Models\User::findOne(['id' => $request->params['id']])->fetch( PDO::FETCH_ASSOC);
				$result['data']['password'] = "Sensitive Password Removed";
				return json_encode($result);
				break;
			default:
				// toss error back at the request
				$response->statusCode(405);
				$result = ['request_type' => 'single_user', 'date' => date('Y-m-d'), 'time' => date('H:i:s'), 'data' => null, 'error' => 'METHOD.NOT.SUPPORTED'];
				return json_encode($result);
		}
	}
}
?>