<?php
require_once 'student.php';

class Student_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // ========= READ ==================

    public function getStudentByUserId(int $id)  : ?Student {
        $query = "SELECT s.id,s.first_name,s.last_name,s.school_id,s.email,s.bio,s.portfolio_link, s.certifications,sch.name 
                  FROM students s 
                  JOIN schools sch 
                  ON s.school_id = sch.id 
                  WHERE user_id = :id";
        $pdostm =  $this->db->prepare($query);
        $pdostm->bindValue(":id",$id,PDO::PARAM_INT);
        $pdostm->execute();
        $studentDB = $pdostm->fetch(PDO::FETCH_OBJ);

        if($studentDB == null) {
            return null;
        }

        $student = new Student();
        $school = new School();
        $school->setName($studentDB->name);

        $student->setStudentId($studentDB->id);
        $student->setFirstName($studentDB->first_name);
        $student->setLastName($studentDB->last_name);
        $student->setPortfolioLink($studentDB->portfolio_link);
        $student->setCertifications($studentDB->certifications);
        $student->setEmailId($studentDB->email);
        $student->setBio($studentDB->bio);
        $student->setSchool($school);

        return $student;
    }

    public function addStudent(Student $student) : int {
        $query = "INSERT INTO students(first_name, last_name, school_id, user_id, email, bio, portfolio_link, certifications) 
                        VALUES(:firstName, :lastName, :schoolId, :userId, :email, :bio, :portfolioLink, :certifications)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':firstName', $student->getFirstName());
        $pdostm->bindValue(':lastName', $student->getLastName());
        $pdostm->bindValue(':schoolId', $student->getSchool()->getId());
        $pdostm->bindValue(':userId', $student->getId());
        $pdostm->bindValue(':email', $student->getEmailId());
        $pdostm->bindValue(':bio', $student->getBio());
        $pdostm->bindValue(':portfolioLink', $student->getPortfolioLink());
        $pdostm->bindValue(':certifications', $student->getCertifications());

        return $pdostm->execute();
    }

    // ========= UPDATE ==================

    public function updateStudentProfile($id, Student $student): int {
        $query ="UPDATE students SET
                first_name = :f_name,
                last_name  = :l_name,
                email = :email,
                bio = :bio, 
                portfolio_link = :p_link, 
                certifications = :certification
                WHERE id = :id ";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":f_name", $student->getFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(":l_name",$student->getLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(":email",$student->getEmailId(), PDO::PARAM_STR);
        $pdostm->bindValue(":bio",$student->getBio(), PDO::PARAM_STR);
        $pdostm->bindValue(":p_link",$student->getPortfolioLink(), PDO::PARAM_STR);
        $pdostm->bindValue(":certification",$student->getCertifications(), PDO::PARAM_STR);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        return $pdostm->execute();

    }

    //===========READ ALL ================
    public function getAllStudents(){
        $query = "SELECT * FROM students";
        $pdostm =  $this->db->prepare($query);
        $pdostm->execute();
        return $pdostm->fetchAll(PDO::FETCH_OBJ);
    }
}
