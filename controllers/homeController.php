<?php

class homeController extends Controller{
	public function __construct(){
		parent::__construct();
    }
    public function index(){
        $this->View->render('home/index');
    }
    public function error($error = null){
        $this->View->msg = homeController::correspondingMessage($error);
        $this->View->render('home/error',homeController::correspondingLayout());
    }
    public function login(){
        $this->View->render('authentication/login');
    }

    public function logout() {
        session_destroy();
        $this->View->render('home/index');
    }



//=================== STATIC FUNCTIONS ==================

    public static function correspondingLayout(){
        $layout = 'public';
        if(isset($_SESSION['loggedInUserRole']))
            $layout = 'dashboard';
        return $layout;
    }

    public static function correspondingMessage($error = null){
        if(is_null($error)){
            return "Something went wrong";
        }
        switch ($error) {
            case 'data':
                return HomeError::DATA_ERROR;     
                break;
            case 'privilages':
                return HomeError::PRIVILEGE_ERROR;
            default:
                return HomeError::DEFAULT_ERROR;
        } 
    }
}