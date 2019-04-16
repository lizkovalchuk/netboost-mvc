<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/user_DB.php';
require_once 'models/role_DB.php';
require_once 'models/userRole_DB.php';
require_once 'utils/validation.php';
require_once 'utils/validationError.php';
require_once 'models/teacher.php';
require_once 'models/teacher_DB.php';
require_once 'models/company.php';
require_once 'models/company_DB.php';
require_once 'models/student.php';
require_once 'models/student_DB.php';
require_once 'models/school.php';
require_once 'models/school_DB.php';

class signupController extends Controller {
//the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    private $userDB;
    private $userRoleDB;
    private $teacherDB;
    private $companyDB;
    private $studentDB;
    private $validationError;
    private $schoolDB;

    public function __construct(){
        parent::__construct();
        $this->userDB = new User_DB();
        $this->userRoleDB = new UserRole_DB();
        $this->teacherDB = new Teacher_DB();
        $this->companyDB = new Company_DB();
        $this->studentDB = new Student_DB();
        $this->schoolDB = new School_DB();

        $this->validationError = new ValidationError();
    }

    public function index() {
        $this->validationError->clearErrors();
        if(isset($_POST['createAccount'])) {

            $user = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $roleId = (int)$_POST['user-role'];
            $_SESSION['userRoleId'] = $_POST['user-role'];
            $user->setUsername($username);
            $user->setPassword($password);

            $this->validationError = Validation::isValidUser($user);

            $existingUser = $this->userDB->getUserByUsername($username);

            if($existingUser != null) {
                $this->validationError->addError(ValidationError::USER_EXISTS, "Seems like the username is already taken. Please choose a different username!");
            }

            if(!Validation::validatePasswordMatch($password, $confirmPassword)) {
                $this->validationError->addError(ValidationError::PASSWORD_MISMATCH, "Your passwords don't match. Please retype your password to confirm it.");
            }

            if(!Role_DB::isAllowedRole($roleId)) {
                $this->validationError->addError(ValidationError::INVALID_ROLE, "Please choose a valid role!");
            }

            if($this->validationError->hasErrors()) {
                $this->View->errors = $this->validationError->getErrors();
                $this->View->render('authentication/signup/signup', 'public');
                return;
            } else {
                //add user to users table
                $hashedPassword = GeneralUtils::hashPassword($password);
                $user->setPassword($hashedPassword);
                $userWithoutRoles = $this->userDB->addUser($user);
                $user = $this->userRoleDB->addUserRole($userWithoutRoles, $roleId);
                $_SESSION["username"] = $user->getUsername();
                $_SESSION["userId"] = $user->getId();

                header('location: '.BASE_PATH.'signup/success');
            }
        }

        $this->View->errors = $this->validationError->getErrors();
        $this->View->render('authentication/signup/signup', 'public');
    }

    public function success() {
        if (isset($_SESSION["username"])) {

            $roleId = $_SESSION['userRoleId'];
            $schools = $this->schoolDB->getAllSchools();
            if($roleId != "") {
                switch ($roleId) {
                    case "2" : $this->View->schools = $schools;
                                $this->View->render('profile/createStudentProfile', 'public');
                                break;
                    case "3" : $this->View->render('profile/createCompanyProfile', 'public');
                                break;
                    case "4" : $this->View->schools = $schools;
                                $this->View->render('profile/createTeacherProfile', 'public');
                                break;
                }
            } else {
                $this->View->render('authentication/signup/signup', 'public');
            }
        } else {
            header('location: '.BASE_PATH.'signup');
        }
    }

    public function createTeacher() {

        if(isset($_POST['createTeacher'])) {

            $teacher = new Teacher();
            $teacher->setFirstName($_POST['firstName']);
            $teacher->setLastName($_POST['lastName']);
            $teacher->setEmailId($_POST['email']);
            $teacher->setId($_SESSION["userId"]);
            $teacher->setTitle($_POST['title']);
            $teacher->setBio($_POST['bio']);

            $school = new School();
            $school->setId((int)$_POST['school']);
            $teacher->setSchool($school);
            $schools = $this->schoolDB->getAllSchools();

            $this->validationError = Validation::isValidTeacher($teacher);
            if($this->userDB->doesUserExistsWith($teacher->getEmailId())) {
                $this->validationError->addError(ValidationError::INVALID_EMAIL, "Email already in use. Please use a different email.");
            }

            if($this->validationError->hasErrors()) {
                $this->View->errors = $this->validationError->getErrors();
                $this->View->schools = $schools;
                $this->View->render('profile/createTeacherProfile', 'public');
                return;
            } else {
                $teacherAddedCount = $this->teacherDB->addTeacher($teacher);

                if($teacherAddedCount == 0) {
                    echo "Teacher not added!";

                } else {
                    $this->View->message = "Hi " . $_SESSION["username"] . ", Thank you for registering.";
                    $this->View->render('authentication/login/login');
                    return;
                }

            }
        }
        $this->View->schools = $schools;
        $this->View->render('profile/createTeacherProfile', 'public');
    }

    public function createCompany() {

        if(isset($_POST['createCompany'])) {

            $company = new Company();
            $company->setName($_POST['companyName']);
            $company->setId($_SESSION["userId"]);
            $company->setContactFirstName($_POST['firstName']);
            $company->setContactLastName($_POST['lastName']);
            $company->setContactEmailId($_POST['email']);
            $company->setWebsite($_POST['website']);
            $company->setBio($_POST['bio']);

            $this->validationError = Validation::isValidCompany($company);
            if($this->userDB->doesUserExistsWith($company->getContactEmailId())) {
                $this->validationError->addError(ValidationError::INVALID_EMAIL, "Email already in use. Please use a different email.");
            }

            if($this->validationError->hasErrors()) {
                $this->View->errors = $this->validationError->getErrors();
                $this->View->render('profile/createCompanyProfile', 'public');
                return;
            } else {
                $companyAddedCount = $this->companyDB->addCompany($company);

                if($companyAddedCount == 0) {
                    echo "Company not added!";

                } else {
                    $this->View->message = "Hi " . $_SESSION["username"] . ", Thank you for registering.";
                    $this->View->render('authentication/login/login');
                    return;
                }

            }
        }

        $this->View->render('profile/createCompanyProfile', 'public');
    }

    public function createStudent() {

        if(isset($_POST['createStudent'])) {

            $student = new Student();
            $student->setFirstName($_POST['firstName']);
            $student->setLastName($_POST['lastName']);
            $student->setEmailId($_POST['email']);
            $student->setId($_SESSION["userId"]);//
            $student->setPortfolioLink($_POST['portfolio']);
            $student->setBio($_POST['bio']);
            $student->setCertifications($_POST['certifications']);

            $school = new School();
            $school->setId((int)$_POST['school']);
            $student->setSchool($school);

            $schools = $this->schoolDB->getAllSchools();

            $this->validationError = Validation::isValidStudent($student);
            if($this->userDB->doesUserExistsWith($student->getEmailId())) {
                $this->validationError->addError(ValidationError::INVALID_EMAIL, "Email already in use. Please use a different email.");
            }

            if($this->validationError->hasErrors()) {
                $this->View->errors = $this->validationError->getErrors();
                $this->View->schools = $schools;
                $this->View->render('profile/createStudentProfile', 'public');
                return;
            } else {
                $studentAddedCount = $this->studentDB->addStudent($student);

                if($studentAddedCount == 0) {
                    echo "Student not added!";

                } else {
                    $this->View->message = "Hi " . $_SESSION["username"] . ", Thank you for registering.";
                    $this->View->render('authentication/login/login');
                    return;
                }

            }
        }
        $this->View->schools = $schools;
        $this->View->render('profile/createStudentProfile', 'public');
    }
}