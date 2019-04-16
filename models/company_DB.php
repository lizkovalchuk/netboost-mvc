<?php
require_once 'company.php';

class Company_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // ========= ADD ==================
    public function addCompany(Company $company) : int {
        $query = "INSERT INTO companies(name, user_id, contact_email, contact_fname, contact_lname, website, bio) 
                        VALUES(:name, :userId, :contactEmail, :contactFname, :contactLname, :website, :bio)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':name', $company->getName());
        $pdostm->bindValue(':userId', $company->getId());
        $pdostm->bindValue(':contactEmail', $company->getContactEmailId());
        $pdostm->bindValue(':contactFname', $company->getContactFirstName());
        $pdostm->bindValue(':contactLname', $company->getContactLastName());
        $pdostm->bindValue(':website', $company->getWebsite());
        $pdostm->bindValue(':bio', $company->getBio());

        return $pdostm->execute();
    }

    // ========= READ ==================
    public function getCompanyByUserId(int $id)  : ?Company {
        $query = "SELECT * FROM companies WHERE user_id = :id";
        $pdostm =  $this->db->prepare($query);
        $pdostm->bindValue(":id",$id,PDO::PARAM_INT);
        $pdostm->execute();
        $companyDB = $pdostm->fetch(PDO::FETCH_OBJ);

        if($companyDB == null) {
            return null;
        }
        // create an instance of teacher class
        $company = new Company();
        $company->setCompanyId($companyDB->id);
        $company->setName($companyDB->name);
        $company->setContactEmailId($companyDB->contact_email);
        $company->setContactFirstName($companyDB->contact_fname);
        $company->setContactLastName($companyDB->contact_lname);
        $company->setWebsite($companyDB->website);
        $company->setBio($companyDB->bio);

        return $company;
    }

    // ========= UPDATE ==================

    public function updateCompanyProfile($id, Company $company): int {
        $query ="UPDATE companies SET 
                name = :name,
                contact_email = :email,
                contact_fname  = :contact_firstName,
                contact_lname = :contact_lastName,
                website = :website, 
                bio = :bio
                WHERE id = :id ";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":name",$company->getName(), PDO::PARAM_STR);
        $pdostm->bindValue(":email", $company->getContactEmailId(), PDO::PARAM_STR);
        $pdostm->bindValue(":contact_firstName",$company->getContactFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(":contact_lastName",$company->getContactLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(":website",$company->getWebsite(), PDO::PARAM_STR);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->bindValue(":bio",$company->getBio(),PDO::PARAM_STR);
        return $pdostm->execute();
//        $companyDB = $pdostm->fetch(PDO::FETCH_OBJ);
//
//        // create an instance of company class
//        $company = new Company();
//        $company->setCompanyId($companyDB->id);
//        $company->setName($companyDB->name);
//        $company->setContactFirstName($companyDB->contact_fname);
//        $company->setContactLastName($companyDB->contact_lname);
//        $company->setWebsite($companyDB->website);
//        $company->setBio($companyDB->bio);
//        $company->setContactEmailId($companyDB->contact_email);
//
//        return $company;

    }

}