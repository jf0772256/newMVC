<?php
	namespace Jesse\SimplifiedMVC\Http\Controllers;
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Controller;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	use Jesse\SimplifiedMVC\Facades\Router\ResponseFacade as Response;
	use Jesse\SimplifiedMVC\Facades\Router\RequestFacade as Request;
	
	class homeController extends Controller
	{
		function home(): string
		{
			$this->setLayout('main');
			//Utility::dieAndDump(Application::$app);
			return $this->render('home', []);
		}
		
		function about() : string
		{
			$this->setLayout('main');
			return $this->render('about', ['title'=>'About']);
		}
		
		function contact(Request $request) : string
		{
			$this->setLayout('main');
			$contact = new \Jesse\SimplifiedMVC\Http\Models\Contact();
			if(!empty(Application::$app->session->getValue('authenticated')) && !$request->isPost())
			{
				//Utility::dieAndDump(Application::$app);
				$contact->firstName = Application::$app->user->firstName;
				$contact->lastName = Application::$app->user->lastName;
				$contact->email = Application::$app->user->email;
			}
			if (Application::$app->request->isPost())
			{
				$contact->loadData($this->getBody());
				// Utility::dieAndDump($contact);
				if ($contact->validate() && $contact->save())
				{
					Application::$app->session->setFlash('success', 'Your message has been sent.');
					Application::$app->response->redirect('/');
					exit();
				}
				return $this->render('contact', ['title'=>'Contact', 'model'=>$contact]);
			}
			return $this->render('contact', ['title'=>'Contact', 'model'=>$contact]);
		}
	}