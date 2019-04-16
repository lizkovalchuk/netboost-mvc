<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "models/project_DB.php";
require_once 'models/notification_DB.php';
require_once 'models/notification.php';

class ViewProjectRequestsController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)

    private $notificationDB;

    public function __construct(){
        parent::__construct();
        $this->notificationDB = new Notification_DB();
    }

    public function index() {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $model = new Project_DB();

        if(isset($_SESSION['notifications']) && count($_SESSION['notifications']['requestNotifications']) > 0) {
            $this->notificationDB->clearRequestNotificationsForUser((int)$_SESSION['userId']);
            $_SESSION['notifications']['requestNotifications'] = array();
        }
        
        //TODO: get teacher_id value through sessions.
        $requests = $model->getProjectRequestsByTeacherId($_SESSION['roleId']);
        $this->View->requests = $requests;
        $this->View->render("viewProjectRequests/index", "dashboard");
    }



    public function acceptProject($id = null) {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $project_DB = new project_DB();
        $project_DB->acceptProject($id);
        header('location: '.BASE_PATH.'viewProjectRequests/index');

    }

    public function declineProject($id = null) {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $project_DB = new project_DB();

        $project_DB->declineProject($id);
        header('location: '.BASE_PATH.'viewProjectRequests/index');

    }

    public function details($id = null) {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $model = new Project_DB();
        $requests = $model->getProjectbyId($id);
        $this->View->requests = $requests;
        $this->View->render("viewProjectRequests/details", "dashboard");
    }


}