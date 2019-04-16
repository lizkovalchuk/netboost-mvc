<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

require_once 'models/user.php';
require_once 'models/user_DB.php';
require_once 'models/teacher_DB.php';
require_once 'models/school_DB.php';
require_once 'models/company_DB.php';
require_once 'models/student_DB.php';
require_once 'utils/validation.php';
require_once 'utils/validationError.php';
require_once 'utils/generalUtils.php';
require_once 'utils/emailHelper.php';
require_once 'models/notification.php';
require_once 'models/notification_DB.php';
require_once 'utils/notificationEvents.php';

class loginController extends Controller {
//the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    private $teacherDB;
    private $companyDB;
    private $studentDB;
    private $userDB;
    private $schoolDB;
    private $validationError;
    private $notificationDB;

    public function __construct(){
        parent::__construct();
        $this->teacherDB = new Teacher_DB();
        $this->userDB = new User_DB();
        $this->schoolDB = new School_DB();
        $this->companyDB = new Company_DB();
        $this->studentDB = new Student_DB();
        $this->validationError = new ValidationError();
        $this->notificationDB = new Notification_DB();
    }

    public function index() {

        $this->View->render('authentication/login/login');
    }

    public function loginSuccess() {
        if(isset($_POST['login'])){
            $loginUser = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];

            $loginUser->setUsername($username);
            $loginUser->setPassword($password);
            $_SESSION['username'] = $username;

            $loggedInUser = $this->userDB->getUserByUsername($username);
            if($loggedInUser == null) {
                $this->validationError->addError(ValidationError::INVALID_USERNAME, 'Invalid username. Please try again!');
            } else if(!GeneralUtils::isValidPassword($password, $loggedInUser->getPassword())) {
                $this->validationError->addError(ValidationError::INVALID_PASSWORD, 'Invalid password. Please try again!');
            }

            if($this->validationError->hasErrors()) {
                $this->View->errors = $this->validationError->getErrors();
                $this->View->render('authentication/login/login', 'public');
                return;
            }

            $loggedInUserRole = $loggedInUser->getRoles()[0];
            $loggedInUserId = $loggedInUser->getId();

            $_SESSION['loggedInUserRole'] = $loggedInUserRole->getName();
            $_SESSION['userId'] = $loggedInUserId;
            $notifications = $this->notificationDB->getUnreadNotificationsForUser($loggedInUserId);
            $projectReqNotifications = array();
            $messageNotifications = array();

            if(count($notifications) != 0) {
                foreach ($notifications as $n) {
                    if($n->getNotifyEvent() == NotificationEvents::NEW_PROJECT_REQ) {
                        array_push($projectReqNotifications, $n);
                    } else {
                        array_push($messageNotifications, $n);
                    }
                }
                $_SESSION['notifications'] = [
                    'requestNotifications' => $projectReqNotifications,
                    'messageNotifications' => $messageNotifications
                ];
            }

            if($loggedInUserRole->getName() == 'teacher') {
                $teacher = $this->teacherDB->getTeacherByUserId($loggedInUserId);
                $_SESSION['roleId'] = $teacher->getTeacherId();
                if($teacher == null) {
                    $schools = $this->schoolDB->getAllSchools();
                    $this->View->errors = $this->validationError->getErrors();
                    $this->View->schools = $schools;
                    $this->View->render('profile/createTeacherProfile', 'public');
                    return;
                } else {
                    header('Location: '.BASE_PATH.'teacherProfile');
                }
            }

            if($loggedInUserRole->getName() == 'company') {
                $company = $this->companyDB->getCompanyByUserId($loggedInUserId);
                $_SESSION['roleId'] = $company->getCompanyId();
                if($company == null) {
                    $this->View->errors = $this->validationError->getErrors();
                    $this->View->render('profile/createCompanyProfile', 'public');
                    return;
                } else {
                    header('Location: '.BASE_PATH.'companyProfile');
                }
            }

            if($loggedInUserRole->getName() == 'student') {
                $student = $this->studentDB->getStudentByUserId($loggedInUserId);
                $_SESSION['roleId'] = $student->getStudentId();
                if($student == null) {
                    $schools = $this->schoolDB->getAllSchools();
                    $this->View->errors = $this->validationError->getErrors();
                    $this->View->schools = $schools;
                    $this->View->render('profile/createStudentProfile', 'public');
                    return;
                } else {
                    header('Location: '.BASE_PATH.'studentProfile');
                }
            }

            if($loggedInUserRole->getName() == 'admin') {
                header('Location: '.BASE_PATH.'articles');
            }
        }
        $this->View->render('authentication/login/login');
    }

    public function forgotPassword() {

        //generate token
        $token = GeneralUtils::generateUniqueID();

        if(isset($_POST['sendEmail'])) {
            $email = $_POST['email'];

            if(!Validation::validateEmail($email)) {
                $this->validationError->addError(ValidationError::INVALID_EMAIL, "Please enter a valid email address!");
                $this->View->errors = $this->validationError->getErrors();
                $this->View->render('authentication/login/forgotPassword', 'public');
                return;
            }

            //update database
            $didUpdatePasswordResetToken = $this->userDB->updateResetPasswordToken($email, $token);
            if ($didUpdatePasswordResetToken) {
                $mailSent = EmailHelper::sendResetPasswordEmail($email, $token);
                if(!$mailSent) {
                    $this->View->mailNotSent = "The email could not be sent. Please try again.";
                    $this->View->render('authentication/login/forgotPassword', 'public');
                    return;
                } else {
                    $this->View->emailSent = "The email has been sent. Please check your inbox.";
                    $this->View->render('authentication/login/forgotPassword');
                    return;
                }
            } else {
                $this->validationError->addError(ValidationError::INVALID_EMAIL, 'Enter the email you use for NetBoost, and we’ll help you create a new password.');
                $this->View->errors = $this->validationError->getErrors();
                $this->View->render('authentication/login/forgotPassword', 'public');
                return;
            }
        }

        $this->View->render('authentication/login/forgotPassword');
    }

    public function resetPasswordLink($token = null) {
        $_SESSION['token'] = $token;

        $this->View->render('authentication/login/resetPassword');
    }

    public function resetPassword() {
        if (!isset($_POST['resetPassword'])) {
            header('Location: ' . BASE_PATH. 'login');
            return;
        }

        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $token = $_SESSION['token'];

        if (!Validation::validatePassword($password)) {
            $this->validationError->addError(ValidationError::INVALID_PASSWORD, "Your password must be 8 characters or longer, contain letters, special characters and numbers, and must not contain spaces, or emoji.");
        }

        if (!Validation::validatePasswordMatch($password, $confirmPassword)) {
            $this->validationError->addError(ValidationError::PASSWORD_MISMATCH, "Your passwords don't match. Please retype your password to confirm it.");
        }

        if ($this->validationError->hasErrors()) {
            $this->View->errors = $this->validationError->getErrors();
            $this->View->render('authentication/login/resetPassword', 'public');
            return;
        } else {
            $hashedPassword = GeneralUtils::hashPassword($password);
            $resetSuccess = $this->userDB->resetPassword($token, $hashedPassword);
            if($resetSuccess) {
                $_SESSION['token'] = "";
                header('Location: ' . BASE_PATH. 'login');
                return;
            } else {
                $this->View->updateFailMessage = "Seems like the link is expired. Please try resetting the password again.";
                $this->View->render('authentication/login/resetPassword', 'public');
                return;
            }
        }
    }
}