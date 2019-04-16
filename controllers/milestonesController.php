<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/milestone.php';

class milestonesController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct()
    {
        parent::__construct();
//        $this->load->model('milestones_DB');
    }

// ============================================================
// ===================== SHOW MILESTONES PAGE ===========================
// ============================================================

    public function showMilestones($project_id){
        require_once "models/milestone_DB.php";
        $MSmodel = new Milestone_DB();
        $MSnameP = $MSmodel->getNameandPerc($project_id);
        $PDataArray = $MSmodel->getPercentage($project_id);
        $PKeysArray = $MSmodel->getMSname($project_id);
        $TLDatesArray = $MSmodel->getDates($project_id);

//        $milestones = array();
//
//        array_push($milestones, ['Tasks','Percentage']);
//        foreach($MSnameP as $item)
//        {
//            array_push($milestones, [$item['name'], (int)$item['percentage']]);
//        }


        $this->View->temp1 = $MSnameP;
        $this->View->temp2 = $PDataArray;
        $this->View->temp3 = $PKeysArray;
        $this->View->temp4 = $TLDatesArray;

//        $milestonesJSarray = json_encode($milestones);
//        $this->View->msNameP = $milestonesJSarray;
        $this->View->project_id = $project_id;

        $this->View->PCountName = $MSmodel->getNameCount($project_id);
        $this->View->msPerc = $MSmodel->getPercentage($project_id);
        $this->View->render('milestones/index','dashboard');
    }

// ============================================================
// ===================== CREATE PAGE ===========================
// ============================================================

    public function create($project_id){
        require_once 'models/milestone_DB.php';
        $model = new Milestone_DB();
        $this->View->milestones = $model->getAll((int)$project_id);
        $this->View->project_id = $project_id;
        $this->View->render('milestones/create', 'dashboard');
    }

    public function createM(){
        require_once 'models/milestone_DB.php';
        $project_id = (int)$_POST['hidden_project_id'];
        $model = new Milestone_DB();
        try
        {
            $success = $model->DBcreateMS($project_id);
            if($success)
            {
                $this->showMilestones($project_id);
                return;
            }
            else
            {
                echo "oops";
                //$this->index();
            }
        }
        catch (Exception $e)
        {
            var_dump($e);
            return;
        }
    }


// ============================================================
// ===================== UPDATE PAGE ==========================
// ============================================================

    public function updateIndex($project_id)
    {
        require_once 'models/milestone_DB.php';
        $model = new Milestone_DB();
        try
        {
            $this->View->milestones = $model->getAll((int)$project_id);
        }
        catch(Exception $e)
        {
            var_dump($e);
            return;
        }
        $this->View->project_id = $project_id;
        $this->View->render('milestones/updateIndex', 'dashboard');
    }


    public function update($id = null)
    {
        require_once "models/milestone_DB.php";
        $model = new Milestone_DB();
        $milestones = $model->getById($id);

        $this->View->milestone = $milestones;
        $this->View->render('milestones/update', 'dashboard');
    }

    public function updateMS(){
        require_once 'models/milestone_DB.php';
        $project_id = (int)$_POST['hidden_project_id'];
        $model = new Milestone_DB();
        try
        {
            $success = $model->DBupdateMS();
            if($success)
            {
                $this->showMilestones($project_id);
                return;
            }
            else
            {
                var_dump($_POST);
                echo "hello";
                //$this->updateIndex();
            }
        }
        catch(Exception $e)
        {
            var_dump($e);
            return;
        }
    }

// ============================================================
// ===================== DELETE PAGE ==========================
// ============================================================



    public function delete($id = null)
    {
        require_once "models/milestone_DB.php";
        $model = new Milestone_DB();
        $msId = $model->getById($id);
        $this->View->milestone = $msId;
        $this->View->render('milestones/delete', 'dashboard');
    }
    public function deleteMS()
    {
        require_once "models/milestone_DB.php";
        $project_id = (int)$_POST['hidden_project_id'];
        $model = new Milestone_DB();
        try
        {
            $sucess = $model->DBdeleteMS();
            if($sucess)
            {
                $this->showMilestones($project_id);
                return;
            }
            else
            {
                $this->updateIndex($project_id);
            }
        }
        catch (Exception $e)
        {
            var_dump($e);
            return;
        }
    }

// ============================================================
// ===================== INDEX PAGE ==========================
// ============================================================

    public function index(){


        $id = $_SESSION['roleId'];
        if($_SESSION['loggedInUserRole'] == 'student'){
            $this->indexForStudent($id);
        }
        else{
            $this->indexForTeacher($id);
        }
 //       $id = $_POST['hidden_input'];
    }

    public function indexForStudent($id){
  //      $groupName = 'Tribal Scale website';

        require_once "models/milestone_DB.php";
        $model = new Milestone_DB();
        $msGetGroup = $model->DBgetGroupsByStudentId($id);
        $msGetProName = $model->DBgetDistinctProNamesStu($id); //gets name and id
        //  $msGetProName = $model->DBgetStuNameProName();
    //    $msStuInGroups = $model->DBgetAllStudentsinGroups($groupName);



        $this->View->StuGroups = $msGetGroup;
        $this->View->ProNames = $msGetProName; // ADD ID TO THIS FUNCTION
     //   $this->View->AllStuInGroups = $msStuInGroups;
        $this->View->render('milestones/groupList', 'dashboard');
    }

    public function indexForTeacher($id){
        require_once "models/milestone_DB.php";
        $model = new Milestone_DB();


        $msGetGroup = $model->DBgetGroupsByTeacherId($id);
        $msGetProName = $model->DBgetDistinctProNamesTea($id); //gets name and id

        $this->View->StuGroups = $msGetGroup;
        $this->View->ProNames = $msGetProName; // ADD ID TO THIS FUNCTION

        $this->View->render('milestones/groupList', 'dashboard');
    }


} //end of controller



