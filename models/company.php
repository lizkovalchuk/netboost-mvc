<?php
require_once 'user.php';

class Company extends User
{
    private $companyId;
    private $name;
    private $contactEmailId;
    private $contactFirstName;
    private $contactLastName;
    private $website;
    private $bio;

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId): void
    {
        $this->companyId = $companyId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContactEmailId()
    {
        return $this->contactEmailId;
    }

    /**
     * @param mixed $contactEmailId
     */
    public function setContactEmailId($contactEmailId)
    {
        $this->contactEmailId = $contactEmailId;
    }

    /**
     * @return mixed
     */
    public function getContactFirstName()
    {
        return $this->contactFirstName;
    }

    /**
     * @param mixed $contactFirstName
     */
    public function setContactFirstName($contactFirstName)
    {
        $this->contactFirstName = $contactFirstName;
    }

    /**
     * @return mixed
     */
    public function getContactLastName()
    {
        return $this->contactLastName;
    }

    /**
     * @param mixed $contactLastName
     */
    public function setContactLastName($contactLastName)
    {
        $this->contactLastName = $contactLastName;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
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


}