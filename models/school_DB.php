<?php
require_once 'school.php';

class School_DB extends Model
{
    /**
     * @return array of schools from database
     */
    public function getAllSchools() : array {
        $query = "SELECT * FROM schools";
        $pdostm = $this->db->prepare($query);

        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        $schoolsDB = $pdostm->fetchAll();
        $schools = array();

        foreach ($schoolsDB as $s) {
            $school = new School();
            $school->setId($s->id);
            $school->setName($s->name);

            array_push($schools, $school);
        }

        return $schools;
    }


    public function getSchoolById(int $id) : School {
        $query = "SELECT * FROM schools WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();

        $schoolDB = $pdostm->fetch(PDO::FETCH_OBJ);
        $school = new School();
        $school->setId($schoolDB->id);
        $school->setName($schoolDB->name);

        return $school;
    }

    public function getAllSchoolNames(School $school): array {
        $query = "SELECT DISTINCT name = :name FROM schools";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":name", $school->getName(), PARAM_STR);
        $pdostm->execute();
        //fetches all result
        $schools = $pdostm->fetchAll(PDO::FETCH_OBJ);
        $schools = array();
    }

    public function updateSchool($id, School $school) : int {
        $query = "UPDATE schools SET name = :name WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":password", $school->getName(), PDO::PARAM_STR);
        $pdostm->bindValue(':id'. $id, PDO::PARAM_INT);

        return $pdostm->execute();
    }

    public function deleteSchool($id) : int {
        $query = "DELETE FROM users WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id'. $id, PDO::PARAM_INT);

        return $pdostm->execute();
    }
}