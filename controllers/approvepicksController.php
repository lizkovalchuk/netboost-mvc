<?php
class approvepicksController extends Controller{

    public function __construct(){
        parent::__construct();
    }

// ============================================================
// ===================== INDEX PAGE ===========================
// ============================================================


    public function index(){

        require_once 'models/approvePicks_DB.php';
        $model = new ApprovePicks_DB();

        $this->View->studentsFromPicks = $model->groupByStuID();
        $this->View->topRating = $model->topRatings();
        $this->View->lowestRating = $model->lowestRating();
        $this->View->assignment = $model->getAssignedName();

        $this->View->render('approvePicks/index','dashboard');


    }


// ============================================================
// ===================== ASSIGN PAGE ==========================
// ============================================================

    public function assign($id = null)
    {
        require_once "models/approvePicks_DB.php";
        $model = new ApprovePicks_DB();
    //    $this->View->apPicks = $model->getById($id);
    //    $this->View->stuId = $model->getStudentId();
        $this->View->topRating = $model->topRatingsAssign($id);
        $this->View->lowestRating = $model->lowestRatingAssign($id);
        $this->View->student = $model->groupByStuID();
        $this->View->projectNames = $model->projectNames();
        $this->View->studentId = $id;
        $this->View->render('approvePicks/assign', 'dashboard');
    }

    public function assignPick()
    {
        require_once 'models/approvePicks_DB.php';
        $model = new ApprovePicks_DB();
        try
        {
            $success = $model->updateAssign();
            if($success)
            {
                header("location:".BASE_PATH."approvepicks");
                //$this->index();
                return;
            }
            else
            {
                $this->index();
            }
        }
        catch (Exception $e)
        {
            var_dump($e);
            return;
        }
    }

} //end of controller



