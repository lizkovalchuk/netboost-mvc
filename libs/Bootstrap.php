<?php
class Bootstrap{
	const publicControllers = ['home','login','signup','articles','ratings'];

	function __construct() {
		session_start();
		$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
		$url = rtrim($url, '/');
		$url = explode('/',$url);
		

		if(!isset($url[0])){
			$url[0]='home';
			$url[1]='index';
		}

		$file = 'controllers/'.$url[0].'Controller.php';
		if(file_exists($file)){
			require $file;
		}
		else{
			$url[0] = 'home';
			$url[1] = 'error';
			require 'controllers/'.$url[0].'Controller.php';
			//throw new Exception("The file: $bool doesn't exist.");
		}
		
		if(!isset($_SESSION['loggedInUserRole'])&&!in_array($url[0], Bootstrap::publicControllers)){;

			$url[0] = 'login';
			$url[1] = 'index';
			require 'controllers/'.$url[0].'Controller.php';
		}

		$controller = $url[0].'Controller';
		$controller = new $controller;
		if($url[0]!='home')
			$controller->loadModel($url[0]);
		
		if(isset($url[2])&& method_exists($controller, $url[1])	){
			$controller->{$url[1]}($url[2]);
		}
		else {
			if(isset($url[1])&& method_exists($controller, $url[1])) {
				$controller->{$url[1]}();
			}
			else {
				$controller->{'index'}();
			}
		}
		

	}

}