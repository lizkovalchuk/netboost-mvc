<?php
require_once 'teacher.php';

class Teacher_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }


    // ========= ADD ==================

    public function addTeacher(Teacher $teacher) : int {
        $query = "INSERT INTO teachers(first_name, last_name, school_id, user_id, email, bio, title) 
                        VALUES(:firstName, :lastName, :schoolId, :userId, :email, :bio, :title)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':firstName', $teacher->getFirstName());
        $pdostm->bindValue(':lastName', $teacher->getLastName());
        $pdostm->bindValue(':schoolId', $teacher->getSchool()->getId());
        $pdostm->bindValue(':userId', $teacher->getId());
        $pdostm->bindValue(':email', $teacher->getEmailId());
        $pdostm->bindValue(':bio', $teacher->getBio());
        $pdostm->bindValue(':title', $teacher->getTitle());

        return $pdostm->execute();
    }

    // ========= READ ==================

    public function getTeacherByUserId(int $id)  : ?Teacher {
        $query = "SELECT t.id,t.first_name,t.last_name,t.email,t.bio, t.title, t.school_id, s.name 
                  FROM teachers t 
                  JOIN schools s 
                  ON t.school_id = s.id 
                  WHERE user_id = :id";
//        $query = "SELECT * FROM teachers
//                  WHERE user_id = :id";
        $pdostm =  $this->db->prepare($query);
        $pdostm->bindValue(":id",$id,PDO::PARAM_INT);
        $pdostm->execute();
        $teacherDB = $pdostm->fetch(PDO::FETCH_OBJ);
        // create an instance of teacher class
        if($teacherDB == null) {
            return null;
        }

        $teacher = new Teacher();
        $school = new School();
        $school->setId($teacherDB->school_id);
        $school->setName($teacherDB->name);


        $teacher->setTitle($teacherDB->title);
        $teacher->setTeacherId($teacherDB->id);
        $teacher->setFirstName($teacherDB->first_name);
        $teacher->setLastName($teacherDB->last_name);
        $teacher->setEmailId($teacherDB->email);
        $teacher->setBio($teacherDB->bio);
        $teacher->setSchool($school);

        return $teacher;
    }

    // ========= UPDATE ==================

    public function updateTeacherProfile($id, Teacher $teacher): int {
        $query ="UPDATE teachers SET 
                title = :title,
                first_name = :f_name,
                last_name  = :l_name,
                email = :email,
                bio = :bio,
                school_id = :schoolId
                WHERE id = :id ";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":title",$teacher->getTitle(), PDO::PARAM_STR);
        $pdostm->bindValue(":f_name", $teacher->getFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(":l_name",$teacher->getLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(":email",$teacher->getEmailId(), PDO::PARAM_STR);
        $pdostm->bindValue(":bio",$teacher->getBio(), PDO::PARAM_STR);
        $pdostm->bindValue(":schoolId",$teacher->getSchool()->getId(), PDO::PARAM_INT);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        return $pdostm->execute();

    }


}
