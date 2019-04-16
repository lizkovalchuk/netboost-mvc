<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/student_DB.php';
require_once 'models/student.php';
require_once 'models/user_DB.php';
require_once 'models/user.php';
require_once 'models/school_DB.php';
require_once 'models/school.php';
require_once 'models/notification_DB.php';
require_once 'utils/notificationEvents.php';


class studentProfileController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
    }

    // ========= READ ==================

    public function index(){

        // this checks for any user who is loge
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['student']])){
            return;
        }

        $student_DB = new Student_DB();
        $studentProfDetails = $student_DB->getStudentByUserId($_SESSION['userId']);
        $this->View->profile = $studentProfDetails;
        $this->View->render('profile/studentIndex','dashboard');

    }

    // ========= UPDATE ==================

    public function update(){

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['student']])){
            return;
        }

        $student_DB = new Student_DB();
        $school_DB = new School_DB();

        $student = $student_DB->getStudentByUserId($_SESSION['userId']);

        $schools = $school_DB->getAllSchools();
        $this->View->schools = $schools;

        $this->View->studentUpdate = $student;


        if(isset($_POST['updateStudent']))   // if update form is filled and the update button is clicked
        {
            $student = new Student();

            $studentId = (int)$_POST['studentId'];
            $f_name = $_POST['firstName'];
            $l_name = $_POST['lastName'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $portfolio = $_POST['portfolio'];
            $certifications = $_POST['certification'];
            $schoolId = $_POST['school'];

            $student->setFirstName($f_name);
            $student->setLastName($l_name);
            $student->setEmailId($email);
            $student->setBio($bio);
            $student->setPortfolioLink($portfolio);
            $student->setCertifications($certifications);

            $count = $student_DB->updateStudentProfile($studentId, $student);


            if($count > 0 ){

            header('location: '.BASE_PATH. 'studentProfile');
                }
                else {
                echo  "Update failed";
                }
        }

        $this->View->render('profile/studentUpdate', 'dashboard');

    }


    // ========= DEACTIVATE ==================

    public function delete()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['student']])){
            return;
        }

        $student_DB = new Student_DB();
        $student = $student_DB->getStudentByUserId($_SESSION['userId']);


        $this->View->deactivate = $student;

        if(isset($_POST['deactivateStudent']))
        {
            $user = new User_DB();

            $user->deactivateUser($_SESSION['userId']); // this will change the user account active status from 1 to 0
            $this->View->render('profile/profileDeactivatedIndex', 'public');
            session_destroy();

            // redirect the user to home page and clear session variables
        }

        $this->View->render('profile/studentprofileDeactivate', 'dashboard');
    }

}