<?php
	namespace Jesse\SimplifiedMVC\Controllers;
	
	use Jesse\SimplifiedMVC\Controller;
	
	class homeController extends Controller
	{
		function home(): string
		{
			return $this->render('home', []);
		}
	}