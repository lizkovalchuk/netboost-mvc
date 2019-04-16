<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "models/teacher_DB.php";
require_once "models/teacher.php";
require_once "models/outline.php";
require_once "models/outline_DB.php";
require_once 'models/user_DB.php';
require_once 'models/pick_DB.php';

class outlinesController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
    }


/* ===================== INDEX PAGE =========================== */


    public function index($msg = null) {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $this->View->msg = $msg;

        $model = new outline_DB();
        $projects = $model->getOutlineByTeacherId((int)$_SESSION['roleId']);

        $this->View->projects = $projects;

        $this->View->render('outlines/index', 'dashboard');
    }


/*===================== ADD - CREATE OUTLINE ==========================*/

    public function add() {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $this->View->outline = Outline::getOutlinesFromPost();
        $this->View->render('outlines/add', 'dashboard');
    }


    public function addOutline(){
        if(true) {
            $model = new Outline_DB();
            try
            {
                $success = $model->insert((int)$_SESSION['roleId']);
                if(!$success)
                {
                    $this->add();
                }
                else
                {
                    $this->index();
                }
            }
            catch(Exception $e)
            {
                $this->add();
            }
        }
    }


    /*===================== DETAILS ==========================*/
    public function details($id = null){

       if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $model = new outline_DB();
        $projectDetails = $model->getOutlineById($id);

        $this->View->projectdetails = $projectDetails;


        $this->View->render("outlines/details", "dashboard");
        //var_dump($requestCollab);
    }


// ===================== DELETE OUTLINE ==========================
    public function delete($id = null)
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $model = new outline_DB();


        $outline = $model->getOutlineById($id);

        if(true){
            try{
                $this->View->outline = $outline;
            }
            catch(Exception $e){
                return;

            }
            $this->View->render('outlines/delete','dashboard');
        }
        else{
            header('location:index');
        }


    }

    public function deleteOutline()
    {

        if(true)
        {

            $model = new outline_DB();
        }
        try
        {
            $id = (int)$_POST['hidden_id'];
            $model->delete($id);

        }
        catch(Exception $e)
        {
            $this->delete();
            return;

        }
        header('location:'.BASE_PATH.'outlines/index');

    }


    public function updateOutline($id = null) {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $outline_DB = new outline_DB();
        $outline = $outline_DB->getOutlineById($id);

        $this->View->update = $outline;
        $this->View->render('outlines/update', 'dashboard');

    }

    // ===================== UPDATE OUTLINE ==========================
    public function update() {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $outline_DB = new outline_DB();
        $user_DB = new User_DB();


        if(isset($_POST['btn_update_outline']))   // if update form is filled and the update button is clicked
        {
            $outline = new Outline();

            $id = (int)$_POST['hidden_id'];
            //$teacher_id = $_POST['teacher_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $technologies = $_POST['technologies'];
            $course = $_POST['course'];
            $min_members = $_POST['min_members'];
            $max_members = $_POST['max_members'];
            $start_date = $_POST['start_date'];
            $due_date = $_POST['due_date'];
            $published = $_POST['published'];


            $outline->setId($id);
            $outline->setName($name);
            $outline->setDescription($description);
            $outline->setCourse($course);
            $outline->setTechnologies($technologies);
            $outline->setMinMembers($min_members);
            $outline->setMaxMembers($max_members);
            $outline->setStartDate($start_date);
            $outline->setDueDate($due_date);
            $outline->setPublished($published);


            $outline_DB->updateOutline($id, $outline);


            header('location: '.BASE_PATH.'outlines/index');

        }
        $this->View->render('outlines/update', 'dashboard');

    }

    function closeOutline($id = null){
        $model = new Pick_DB();
        $closeOutline = $model->createAllPicksByOutlineId($id);
        $this->View->closeoutline = $closeOutline;
        if($closeOutline){
            $this->index("Outline successfully closed!");
        }
        else{
            $this->index("Sorry, outline can't be closed!");
        }

    }


}

