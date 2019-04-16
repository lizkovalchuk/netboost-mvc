<?php
require_once "models/teacher_DB.php";
require_once "models/teacher.php";
require_once "models/outline.php";
require_once "models/outline_DB.php";
require_once "models/project.php";
require_once "models/project_DB.php";
require_once 'models/user_DB.php';
require_once 'models/company.php';
class requestCollabController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }

        $model = new outline_DB();
        $company_id = $_SESSION['roleId'];
        $requestCollab = $model->getAllOutlinesForCompany($company_id);

        $this->View->requestsCollab = $requestCollab;


        $this->View->render("requestCollab/index", "dashboard");
    }



    public function details($id = null){

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }

        $model = new outline_DB();
        $requestCollabDetails = $model->getOutlineById($id);

        $this->View->requestCollab = $requestCollabDetails;


        $this->View->render("requestCollab/details", "dashboard");

    }


    public function addProject($id = null)
    {
        if(isset($_POST['sendRequest'])){
            $project = new Project();

            $company = new Company();
            $company->setCompanyId($_SESSION["roleId"]);

            $outline = new Outline();
            $outline->setId((int)$_POST['hidden_outline']);

            $project->setCompany($company);
            $project->setOutline($outline);
            $project->setName($_POST['name']);
            $project->setDescription($_POST['description']);

            //$this->add($project);
            $model = new project_DB();
            $requestCollabAddCount = $model->addProject($project);
            if($requestCollabAddCount > 0){
                $this->View->requestSent = "your request has been sent";
                $this->View->render("requestCollab/add", "dashboard");
                return;
            } else {
                $this->View->requestSent = "your request was not sent, please try again.";
                $this->View->render("requestCollab/add", "dashboard");
                return;
            }
            //$this->View->requestCollabAdd = $requestCollabAdd;

        }
        $this->View->id = $id;
        $this->View->render("requestCollab/add", "dashboard");

    }

    public function viewSentRequests()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }
        $model = new Project_DB();
        $sentRequests = $model->getSentRequestsByCompanyId($_SESSION['roleId']);
        $this->View->sentRequests = $sentRequests;
        $this->View->render("requestCollab/viewSentRequests", "dashboard");
    }




}
