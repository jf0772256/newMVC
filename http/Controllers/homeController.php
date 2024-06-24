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
	}