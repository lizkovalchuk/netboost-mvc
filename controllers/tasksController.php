<?php
class tasksController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
    }

// ============================================================
// ===================== SHOW TASKS ===========================
// ============================================================

    public function showTasks($id)
    {
        require_once 'models/task_DB.php';
        $model = new Task_DB();
        $this->View->project_id = $id;
        try
        {
            $this->View->tasks = $model->getAll($id);
        }
        catch(Exception $e)
        {
            //UPDATE THE ERROR TO GO TO ERROR PAGE (& make an error page)
            error("Sorry, something went wrong", 'tasks/index');
            return;
        }
        $this->View->render('tasks/index','dashboard');
    }


// ============================================================
// ===================== CREATE PAGE ==========================
// ============================================================


    public function create($id)
    {
        require_once "models/task_DB.php";

        $this->View->project_id = $id;
        $this->View->render('tasks/create', 'dashboard');
    }

    public function createPost($id){
        require_once 'models/task_DB.php';
        $model = new Task_DB();

        if(true)
        // check for constraints here
        {
            try
            {
                $success = $model->insert();
                if($success)
                {
                    header('location:'.BASE_PATH.'tasks/showTasks/'.$id,'dashboard');
                }
                else
                {
                    //redirect to error page
                    $this->index();
                }
            }
            catch(Exception $e)
            {
                var_dump($e);
                $this->create($id);
            }
        }
    }

// ============================================================
// ===================== UPDATE PAGE ==========================
// ============================================================

    public function update($id = null)
    {
        require_once "models/task_DB.php";
        $model = new Task_DB();
        $tasks = $model->getById($id);
        $this->View->task = $tasks;
        $this->View->render('tasks/update','dashboard');
    }


    public function updateTask($id)
    {
        require_once 'models/task_DB.php';
        $model = new Task_DB();
        try
        {
            $success = $model->update();
            if($success)
            {
                $this->showTasks($id);
                return;
            }
            else
            {
                $this->index();
            }
        }
        catch(Exception $e)
        {
            return;
        }
    }

// ============================================================
// ===================== DELETE PAGE ==========================
// ============================================================


    public function delete($id = null)
    {
        require_once "models/task_DB.php";
        $model = new Task_DB();
        $tasks = $model->getById($id);
        $this->View->task = $tasks;
        $this->View->render('tasks/delete','dashboard');
    }

    public function deleteTask()
    {
//        echo 1;
//        return;
        if(true
            // check for constraints here
        )
        {
            require_once 'models/task_DB.php';
            $model = new Task_DB();
            try
            {
                $success = $model->delete();
                if($success)
                {
//                    echo "hello1";
  //                  header('location:index','dashboard');
                }
                else
                {
                    //redirect to error page
                    $this->index();
                }
            }
            catch(Exception $e)
            {
                $this->delete();
                return;
            }
            $this->index();
        }


    }


// ============================================================
// ===================== INDEX ================================
// ============================================================


    public function index(){

        $id = $_SESSION['roleId'];

        if($_SESSION['loggedInUserRole'] == 'student'){
            $this->indexForStudent($id);
        }
        else{
            $this->indexForTeacher($id);
        }
    }

    public function indexForStudent($id){

        require_once "models/task_DB.php";
        $model = new Task_DB();
        $msGetGroup = $model->DBgetGroupsByStudentId($id);
        $msGetProName = $model->DBgetDistinctProNamesStu($id); //gets name and id

        $this->View->StuGroups = $msGetGroup;
        $this->View->ProNames = $msGetProName; // ADD ID TO THIS FUNCTION

        $this->View->render('tasks/groupList', 'dashboard');
    }

    public function indexForTeacher($id){
        require_once "models/task_DB.php";
        $model = new Task_DB();

        //change it to teacher id
        $msGetGroup = $model->DBgetGroupsByTeacherId($id);
        $msGetProName = $model->DBgetDistinctProNamesTea($id); //gets name and id

        $this->View->StuGroups = $msGetGroup;
        $this->View->ProNames = $msGetProName; // ADD ID TO THIS FUNCTION
        //   $this->View->AllStuInGroups = $msStuInGroups;
        $this->View->render('tasks/groupList', 'dashboard');
    }



}