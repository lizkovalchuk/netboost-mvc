<?php
require_once 'models/user.php';
require_once 'validationError.php';
require_once 'models/company.php';

class Validation
{
    public static function validateEmail($emailInput) : bool {
        $emailPattern = "/([A-Za-z0-9_\-.]){1,}@([A-Za-z0-9_\-.]){1,}\.([A-Za-z]){2,4}/";
        return (preg_match($emailPattern, $emailInput));
    }

    public static function validateWebsite($websiteInput) : bool {
        $websitePattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        return (preg_match($websitePattern, $websiteInput));
    }

    public static function checkMinCharacters(string $textInput, int $maxCharCount) : bool {
        return (strlen($textInput) <= $maxCharCount);
    }

    public static function validateName($name) : bool {
        $namePattern = '/^[a-zA-Z-\'\s]+$/';
        return (preg_match($namePattern, $name));
    }

    public static function validateDropdown($dropdownName) : bool {
        return filter_input(INPUT_POST, $dropdownName);
    }

    public static function validateCheckbox($checkboxName) : bool {
        return !empty($_POST[$checkboxName]);
    }

    public static function validatePhone($phone) : bool {
        $phonePattern = "/(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}/";
        return (preg_match($phonePattern, $phone));
    }
    public static function validateRadioButton($radioName) : bool {
        return isset($_POST[$radioName]);
    }

    public static function validatePassword($password) : bool {
        $passwordPattern = "/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*\z/";

        return preg_match($passwordPattern, $password);
    }

    public static function validateUsername($username) : bool {
        $usernamePattern = "/^[a-zA-Z0-9_'\s]+$/";

        return preg_match($usernamePattern, $username);
    }

    public static function validatePasswordMatch($password, $confirmPassword) : bool {
        return strcmp($password, $confirmPassword) == 0;
    }

    public static function isValidUser(User $user) : ValidationError {
        $validationError = new ValidationError();

        if(!Validation::validateUsername($user->getUsername())) {
            $validationError->addError(ValidationError::INVALID_USERNAME, "Only letters, numbers and underscore(_)");
        }

        if(!Validation::validatePassword($user->getPassword())) {
            $validationError->addError(ValidationError::INVALID_PASSWORD, "Your password must be 8 characters or longer, contain letters, special characters and numbers, and must not contain spaces, or emoji.");
        }

        return $validationError;
    }

    public static function isValidCompany(Company $company) : ValidationError {
        $validationError = new ValidationError();

        if(!Validation::validateName($company->getName())) {
            $validationError->addError(ValidationError::INVALID_COMPANYNAME, "Check your information and try again!");
        }

        if(!Validation::validateName($company->getContactFirstName())) {
            $validationError->addError(ValidationError::INVALID_FIRSTNAME, "Check your information and try again!");
        }

        if(!Validation::validateName($company->getContactLastName())) {
            $validationError->addError(ValidationError::INVALID_LASTNAME, "Check your information and try again!");
        }

        if(!Validation::validateEmail($company->getContactEmailId())) {
            $validationError->addError(ValidationError::INVALID_EMAIL, "Please enter a valid email address!");
        }

        if(!Validation::validateWebsite($company->getWebsite())) {
            $validationError->addError(ValidationError::INVALID_WEBSITE, "Please enter a valid website link!");
        }

        if(!Validation::checkMinCharacters($company->getBio(), 300)) {
            $validationError->addError(ValidationError::INVALID_BIO, "Please limit within 150 words!");
        }

        return $validationError;
    }

    public static function isValidStudent(Student $student) : ValidationError {
        $validationError = new ValidationError();

        if(!Validation::validateName($student->getFirstName())) {
            $validationError->addError(ValidationError::INVALID_FIRSTNAME, "Check your information and try again!");
        }

        if(!Validation::validateName($student->getLastName())) {
            $validationError->addError(ValidationError::INVALID_LASTNAME, "Check your information and try again!");
        }

        if(!Validation::validateEmail($student->getEmailId())) {
            $validationError->addError(ValidationError::INVALID_EMAIL, "Please enter a valid email address!");
        }

        if(!Validation::validateWebsite($student->getPortfolioLink())) {
            $validationError->addError(ValidationError::INVALID_WEBSITE, "Please enter a valid website link!");
        }

        if(!Validation::checkMinCharacters($student->getBio(), 150)) {
            $validationError->addError(ValidationError::INVALID_BIO, "Please limit within 150 words!");
        }

        if($student->getSchool()->getId() == "") {
            $validationError->addError(ValidationError::INVALID_SCHOOL, "Please choose a school!");
        }

        return $validationError;
    }

    public static function isValidTeacher(Teacher $teacher) : ValidationError {
        $validationError = new ValidationError();

        if(!Validation::validateName($teacher->getFirstName())) {
            $validationError->addError(ValidationError::INVALID_FIRSTNAME, "Check your information and try again!");
        }

        if(!Validation::validateName($teacher->getLastName())) {
            $validationError->addError(ValidationError::INVALID_LASTNAME, "Check your information and try again!");
        }

        if(!Validation::validateEmail($teacher->getEmailId())) {
            $validationError->addError(ValidationError::INVALID_EMAIL, "Please enter a valid email address!");
        }

        if(!Validation::validateName($teacher->getTitle())) {
            $validationError->addError(ValidationError::INVALID_TITLE, "Please enter a valid title!");
        }

        if(!Validation::checkMinCharacters($teacher->getBio(), 150)) {
            $validationError->addError(ValidationError::INVALID_BIO, "Please limit within 150 words!");
        }

        if($teacher->getSchool()->getId() == "") {
            $validationError->addError(ValidationError::INVALID_SCHOOL, "Please choose a school!");
        }

        return $validationError;
    }
}