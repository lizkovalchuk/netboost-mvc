<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "models/teacher_DB.php";
require_once "models/teacher.php";
require_once 'models/user_DB.php';
require_once 'models/school_DB.php';
require_once 'models/notification_DB.php';
require_once 'utils/notificationEvents.php';

class teacherProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // ========= READ ==================

    public function index()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $teacher_DB = new Teacher_DB();
        $loggedInUserId = $_SESSION['userId'];

        $teacherProfDetails = $teacher_DB->getTeacherByUserId($loggedInUserId); // get the teacher profile based on username n p/w

        $this->View->profile = $teacherProfDetails;
        $this->View->render('profile/teacherIndex', 'dashboard');
    }

    // ========= UPDATE ==================

    public function update() {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }
        $teacher_DB = new Teacher_DB();

        $school_DB = new School_DB();

        $teacher = $teacher_DB->getTeacherByUserId($_SESSION['userId']);

        $schools = $school_DB->getAllSchools();
        $this->View->schools = $schools;

        $teacher = $teacher_DB->getTeacherByUserId($_SESSION['userId']);
        $this->View->update = $teacher;

        if (isset($_POST['updateTeacher']))   // if update form is filled and the update button is clicked
        {
            $teacher = new Teacher();
            $school = new School();
           // var_dump($_POST['school']);
            $school->setId((int)$_POST['school']);

            $teacher->setSchool($school);
            $schools = $school_DB->getAllSchools();
            $this->View->schools = $schools;


            $teacherId = (int)$_POST['teacherId'];
            $title = $_POST['title'];
            $f_name = $_POST['firstName'];
            $l_name = $_POST['lastName'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $school = $_POST['school'];

            $teacher->setTitle($title);
            $teacher->setFirstName($f_name);
            $teacher->setLastName($l_name);
            $teacher->setEmailId($email);
            $teacher->setBio($bio);


            $count = $teacher_DB->updateTeacherProfile($teacherId, $teacher);

            if($count > 0 ){
                header('location: '.BASE_PATH. 'teacherProfile');
            }
            else {
                echo  "Update failed";
            }

        }

        $this->View->render('profile/teacherUpdate', 'dashboard');

    }

    // ========= DEACTIVATE PROFILE ==================

    public function delete()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher']])){
            return;
        }

        $teacher_DB = new Teacher_DB();
        $loggedInUserId = $_SESSION['userId'];  //get the user ID from session

        $teacher = $teacher_DB->getTeacherByUserId($loggedInUserId);

        $this->View->deactivate = $teacher;

        if(isset($_POST['deactivateTeacher']))
        {
            $user = new User_DB();

            // redirect the user to home page and clear session variables
            $user->deactivateUser($loggedInUserId);

            $this->View->render('profile/profileDeactivatedIndex', 'public');
            session_destroy();
        }

        $this->View->render('profile/teacherprofileDeactivate', 'dashboard');
    }

}





