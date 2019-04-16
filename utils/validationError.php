<?php

class ValidationError
{
    const INVALID_USERNAME = "USERNAME";
    const INVALID_PASSWORD = "PASSWORD";
    const PASSWORD_MISMATCH = "PASSWORD_MISMATCH";
    const INVALID_ROLE = "INVALID_ROLE";
    const INVALID_COMPANYNAME = "COMPANY_NAME";
    const INVALID_FIRSTNAME = "FIRSTNAME";
    const INVALID_LASTNAME = "LASTNAME";
    const INVALID_EMAIL = "EMAIL";
    const INVALID_BIO = "BIO";
    const INVALID_WEBSITE = "WEBSITE";
    const INVALID_TITLE = "TITLE";
    const INVALID_SCHOOL = "SCHOOL";
    const USER_EXISTS = "EXISTING_USER";
    const EMPTY_OUTLINE_DESC = "INVALID_DESC";

    private $error = array();

    function addError($key, $value) {
        $this->error[$key] = $value;
    }

    function getErrors() : array {
        return $this->error;
    }

    function clearErrors() {
        $this->error = array();
    }

    function hasErrors() : bool {
        return count($this->error) > 0;
    }
}