<?php
require_once 'user.php';
require_once 'school.php';

class Student extends User
{
    private $studentId;
    private $firstName;
    private $lastName;
    private $school;
    private $emailId;
    private $bio;
    private $portfolioLink;
    private $certifications;

    /**
     * @return mixed
     */
    public function getStudentId() : int
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId): void
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getSchool() : School
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     */
    public function setSchool(School $school): void
    {
        $this->school = $school;
    }



    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param mixed $emailId
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getPortfolioLink()
    {
        return $this->portfolioLink;
    }

    /**
     * @param mixed $portfolioLink
     */
    public function setPortfolioLink($portfolioLink)
    {
        $this->portfolioLink = $portfolioLink;
    }

    /**
     * @return mixed
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param mixed $certifications
     */
    public function setCertifications($certifications)
    {
        $this->certifications = $certifications;
    }


}