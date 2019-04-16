<?php
/**
 * Created by PhpStorm.
 * User: purplehaze
 * Date: 2018-04-10
 * Time: 5:02 PM
 */
require_once "teacher.php";
class outline_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }



    /*===================== Insert - Add a new outline ==========================*/
    public function insert(int $teacher_id)
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $technologies = $_POST['technologies'];
        $course = $_POST['course'];
        $min_members = $_POST['min_members'];
        $max_members = $_POST['max_members'];
        $start_date = $_POST['start_date'];
        $due_date = $_POST['due_date'];
        $published = (int)$_POST['published'];


        $outlines = $this->db->prepare('INSERT INTO outlines 
                                                (teacher_id, name, description, technologies, course, min_members, max_members, start_date, due_date, published) 
                                                VALUES (:teacher_id, :name, :description, :technologies, :course, :min_members, :max_members, :start_date, :due_date, :published)');
        return $outlines->execute(array(
            ':teacher_id'=> $teacher_id,
            ':name'=>$name,
            ':description'=>$description,
            ':technologies'=>$technologies,
            ':course'=>$course,
            ':min_members'=>$min_members,
            ':max_members'=>$max_members,
            ':start_date'=>$start_date,
            ':due_date'=>$due_date,
            ':published'=>$published

        ));
    }




/*===================== READ - outline by id ==========================*/



    public function getOutlineById(int $id)
    {
        $query = "SELECT o.id AS outline_id, o.name, o.description, o.technologies, o.course, o.published, o.min_members, o.max_members, o.start_date, o.due_date, 
                  t.first_name, t.last_name FROM outlines o JOIN teachers t ON o.teacher_id = t.id WHERE o.id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();

        $outlineDetail = $pdostm->fetch(PDO::FETCH_OBJ);

            $teacher = new Teacher();
            $outline = new Outline();

            $teacher->setFirstName($outlineDetail->first_name);
            $teacher->setlastName($outlineDetail->last_name);

            $outline->setTeacher($teacher);
            $outline->setId($outlineDetail->outline_id);
            $outline->setName($outlineDetail->name);
            $outline->setDescription($outlineDetail->description);
            $outline->setTechnologies($outlineDetail->technologies);
            $outline->setCourse($outlineDetail->course);
            $outline->setPublished($outlineDetail->published);
            $outline->setMinMembers($outlineDetail->min_members);
            $outline->setMaxMembers($outlineDetail->max_members);
            $outline->setStartDate($outlineDetail->start_date);
            $outline->setDueDate($outlineDetail->due_date);


        return $outline;
    }

    /*============Outline id ================*/
    public function outlineId()
    {

        $query = "SELECT id FROM outlines WHERE id = id";
        $pdostm = $this->db->prepare($query);
        $count = $pdostm->execute();

        return $count;

    }


    /*===================== READ - all outlines ==========================*/


    public function getAllOutlinesForCompany($company_id)
    {
        $query = "SELECT o.name, t.first_name, t.last_name, o.description, o.id FROM outlines o JOIN teachers t ON o.teacher_id = t.id WHERE o.id NOT IN 
                 (SELECT outline_id FROM projects WHERE company_id = :company_id) AND o.completed = 0 AND o.published = 1";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':company_id', $company_id, PDO::PARAM_INT);
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        $outlinesDB = $pdostm->fetchAll();

        $outlines = array();

        foreach ($outlinesDB as $outlineDetail) {

            $teacher = new Teacher();
            $outline = new Outline();

            $teacher->setFirstName($outlineDetail->first_name);
            $teacher->setlastName($outlineDetail->  last_name);

            $outline->setTeacher($teacher);
            $outline->setId($outlineDetail->id);
            $outline->setName($outlineDetail->name);
            $outline->setDescription($outlineDetail->description);

            array_push($outlines, $outline);
        }
        return $outlines;
    }



    /*============Read - outline by teacher id================*/
    public function getOutlineByTeacherId(int $teacher_id)
    {
        //$teacher_id = 2;//$_SESSION['id'];
        $query = "SELECT * FROM outlines WHERE teacher_id = :teacher_id";
      /*  $query = "SELECT * FROM projects o JOIN teachers t ON o.teacher_id = t.id WHERE teacher_id = :teacher_id AND ";*/
        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();
        $gti = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $gti;
    }

    /*============Delete outline ================*/
    public function delete(int $id)
    {

        //var_dump($_POST);
        $query = "DELETE FROM outlines WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $count = $pdostm->execute();
        return $count;

    }


    /*============Update outline ================*/

    public function updateOutline($id, Outline $outline): int {
        $query ="UPDATE outlines SET 
                id = :id,
                name = :name,
                description  = :description,
                technologies = :technologies,
                course = :course,
                min_members = :min_members,
                max_members = :max_members,
                start_date = :start_date,
                due_date = :due_date,
                published = :published 
                WHERE id = :id ";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":name", $outline->getName(), PDO::PARAM_STR);
        $pdostm->bindValue(":description",$outline->getDescription(), PDO::PARAM_STR);
        $pdostm->bindValue(":technologies",$outline->getTechnologies(), PDO::PARAM_STR);
        $pdostm->bindValue(":course",$outline->getCourse(), PDO::PARAM_STR);
        $pdostm->bindValue(":min_members",$outline->getMinMembers(), PDO::PARAM_STR);
        $pdostm->bindValue(":max_members",$outline->getMaxMembers(), PDO::PARAM_STR);
        $pdostm->bindValue(":start_date",$outline->getStartDate(), PDO::PARAM_STR);
        $pdostm->bindValue(":due_date",$outline->getDueDate(), PDO::PARAM_STR);
        $pdostm->bindValue(":published",$outline->getPublished(), PDO::PARAM_INT);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        return $pdostm->execute();

    }

    /*public function searchOutline(){
        $query = "SELECT * FROM outlines
                  WHERE name LIKE '%$search%'
                  OR description LIKE '%$search%'
                  OR technologies LIKE '%$search%'
                  OR course LIKE '%$search%'";

        $pdostm = $this->db->prepare($query);
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        return $pdostm->execute();
    }*/


}

