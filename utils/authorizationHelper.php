<?php
Class AuthorizationHelper{
	//receives an array of the following structure:
	//array("loggedInUserRole"=>"admin","")
	//the key represents the name in the session and the value represents the value that is going to be looks in. the value is going to be an array as well
	public static function checkAuthorization($rolesAuthorized){
		$isAuthorized = true;
		//$role = $_SESSION['loggedInUserRole'];
		foreach ($rolesAuthorized as $key => $values) {
			$isThisAuthorized = false;
			foreach ($values as $value) {
				if ($_SESSION[$key] == $value) {
					$isThisAuthorized = true;
					break;
				}
			}
			$isAuthorized = $isAuthorized && $isThisAuthorized;
		}

		if(!$isAuthorized){
			header('location:'.BASE_PATH.'home/error/privilages');
			return false;
		}
		else{
			return true;
		}
	}
}