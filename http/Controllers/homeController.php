<?php
	namespace Jesse\SimplifiedMVC\Http\Controllers;
	
	use Jesse\SimplifiedMVC\Application;
	use Jesse\SimplifiedMVC\Controller;
	use Jesse\SimplifiedMVC\Utilities\Utility;
	
	class homeController extends Controller
	{
		function home(): string
		{
			return $this->render('home', []);
		}
		
		function about() : string
		{
			return $this->render('about', ['title'=>'About']);
		}
		
		function contact() : string
		{
			$contact = new \Jesse\SimplifiedMVC\Http\Models\Contact();
			if (Application::$app->request->isPost())
			{
				$contact->loadData(Application::$app->request->getRequestBody());
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