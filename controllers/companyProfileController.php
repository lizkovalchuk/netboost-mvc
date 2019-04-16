<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "models/company_DB.php";
require_once "models/company.php";
require_once 'models/user.php';
require_once 'models/user_DB.php';
require_once 'models/notification_DB.php';
require_once 'utils/notificationEvents.php';

class companyProfileController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
        $this->notificationDB = new Notification_DB();
    }

    // ========= READ ==================

    public function index(){

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }

        $company_DB = new Company_DB();
        $loggedInUserId = $_SESSION['userId'];
        $companyProfDetails = $company_DB->getCompanyByUserId($loggedInUserId); // get the company profile based on username n p/w
        $this->View->companyProfile = $companyProfDetails;
        $this->View->render('profile/companyIndex','dashboard');

    }

    // ========= UPDATE ==================

    public function update() {

        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }

        $company_DB = new Company_DB();
        $company = $company_DB->getCompanyByUserId($_SESSION['userId']);
//        var_dump($company);

        $this->View->updateCompany = $company;

        if(isset($_POST['updateCompany']))   // if update form is filled and the update button is clicked
        {
            $company = new Company();

           // var_dump($company);

            $companyId = (int)$_POST['companyId'];
            $companyName = $_POST['companyName'];
            $contact_fname = $_POST['contactFname'];
            $contact_lname = $_POST['contactLname'];
            $contact_email = $_POST['companyEmail'];
            $bio = $_POST['companyBio'];
            $website = $_POST['companyWebsite'];

//            $company->setCompanyId($companyId);
            $company->setName($companyName);
            $company->setContactFirstName($contact_fname);
            $company->setContactLastName($contact_lname);
            $company->setContactEmailId($contact_email);
            $company->setBio($bio);
            $company->setWebsite($website);

            //var_dump($company);

            $count = $company_DB->updateCompanyProfile($companyId, $company);

            if($count > 0 ){
                header('location: '.BASE_PATH. 'companyProfile');
            }
            else {
                echo  "Update failed";
            }

        }
        $this->View->render('profile/companyUpdate', 'dashboard');
    }

    // ========= DELETE ==================

    public function delete()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['company']])){
            return;
        }

        $company_DB = new Company_DB();
        $company = $company_DB->getCompanyByUserId($_SESSION['userId']);

        $this->View->deactivate = $company;
//var_dump($company);
        if($company != null) {
            if(isset($_POST['deactivateCompany']))
            {
                $user = new User_DB();

                $user->deactivateUser($_SESSION['userId']); // this will change the user account active status from 1 to 0

                // redirect the user to home page and clear session variables
                $this->View->render('profile/profileDeactivatedIndex', 'public');
                session_destroy();
               // header('location: '.BASE_PATH. 'home');
            }

        }
        
        $this->View->render('profile/companyprofileDeactivate', 'dashboard');
    }



}