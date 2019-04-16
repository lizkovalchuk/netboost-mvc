<?php
class Milestone_DB extends Model{
    function __construct(){
        parent::__construct();
    }

    // ========= READ ==================


        public function getAll($project_id){
        $query = ("SELECT * FROM milestones 
                  WHERE project_id = :project_id ");
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":project_id", $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $milestones = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $milestones;

    }

        public function getById($id){
        $query = "SELECT * FROM milestones WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();

        $milestones = $pdostm->fetch(PDO::FETCH_OBJ);
        return $milestones;
    }

    public function getPercentage($project_id){
        $query = "SELECT percentage FROM milestones WHERE project_id = :project_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $msPerc = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $msPerc;
    }

    public function getMSname($project_id){
        $query = "SELECT name FROM milestones WHERE project_id = :project_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $msName = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $msName;
    }

    public function getNameandPerc($project_id){
        $query = "SELECT name, percentage FROM milestones WHERE project_id = :project_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $msNamePerc = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $msNamePerc;
    }

    public function getNameCount($project_id){
        $query = "SELECT COUNT(name) FROM milestones WHERE project_id = :project_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $msName = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $msName;
    }

    public function getDates($project_id){
        $query = "SELECT name, date_created, due_date FROM milestones WHERE project_id = :project_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->execute();
        $msDates = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $msDates;
    }

    // ========= CREATE ==================

    public function DBcreateMS($project_id){


        $name = $_POST['inp_name'];
        $perc = (int)$_POST['inp_perc'];
        $creator = (int)$_SESSION['roleId'];

        $due_date = $_POST['inp_dueDate'];

        $query = "INSERT INTO milestones 
                  (project_id
                  , name
                  , percentage                
                  , creator 
                  , due_date)
                  VALUES 
                  (:project_id
                  , :name 
                  , :perc                  
                  , :user_id
                  , :due_date )";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $pdostm->bindValue(':name', $name, PDO::PARAM_STR);
        $pdostm->bindValue(':perc', $perc, PDO::PARAM_INT);
        $pdostm->bindValue(':due_date', $due_date, PDO::PARAM_STR);
        $pdostm->bindValue(':user_id', $creator, PDO::PARAM_INT);
        return $pdostm->execute();


    }

    // ========= UPDATE ==================

    public function DBupdateMS(){
        $name = $_POST['inp_name'];
        $perc = $_POST['inp_perc'];
        $due_date = $_POST['inp_dueDate'];
        $id = $_POST['hidden_id'];

        $query = ('UPDATE milestones
                   SET name = :name,
                   percentage = :perc,
                   due_date = :dueDate
                   WHERE id = :id');
        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':name', $name, PDO::PARAM_STR);
        $pdostm->bindValue(':perc', $perc, PDO::PARAM_INT);
        $pdostm->bindValue(':dueDate', $due_date, PDO::PARAM_STR);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);

        $count = $pdostm->execute();
        return $count;
    }

    // ========= DELETE ==================

    public function DBdeleteMS(){
        $id = $_POST['hidden_id'];
        $query = "DELETE FROM milestones WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_STR);
        $count = $pdostm->execute();
        return $count;
    }


    // ========= GROUP VIEW ==============


// $id needs to be taken from the userRole sessions
// this query gets the students assigned to one group

    public function DBgetGroupsByStudentId($id){
        $query = "SELECT pr.name as proname
                  , pi2.student_id
                  , pi.assign
                  , CONCAT(s.first_name, ' ' ,s.last_name) as name
                  FROM picks pi
                  JOIN projects pr
                  ON pi.project_id = pr.id
                  JOIN picks pi2
                  ON pi2.project_id = pr.id
                  JOIN students s
                  ON pi2.student_id = s.id
                  WHERE pi.assign = 1 AND pi2.assign=1
                  AND pi.student_id = :id";
        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostm->execute();

        $groupsBystudent = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $groupsBystudent;
    }

    public function DBgetGroupsByTeacherId($id){
        $query = "SELECT t.id AS teacher_id
                  , o.id AS outline_id
                  , p.id AS project_id
                  , p.name AS proName
                  FROM teachers t
                  JOIN outlines o
                  ON t.id = o.teacher_id
                  JOIN projects p
                  ON o.id = p.outline_id
                  WHERE t.id = :id ";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostm->execute();

        $allTeachers = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $allTeachers;
    }




    public function DBgetDistinctProNamesStu($id){
        $query = "SELECT DISTINCT pr.name as proname
                  , pr.id AS proId
                  FROM picks pi
                  JOIN projects pr
                  ON pi.project_id = pr.id
                  JOIN picks pi2
                  ON pi2.project_id = pr.id
                  JOIN students s
                  ON pi2.student_id = s.id
                  WHERE pi.assign = 1 AND pi2.assign=1
                  AND s.id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostm->execute();
        $assignProNames = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $assignProNames;
    }



    public function DBgetDistinctProNamesTea($id){
        $query = "SELECT DISTINCT pr.name as proname
                  , pr.id AS proId
                  , t.id as tId
                 FROM projects pr
                 JOIN outlines o
                  ON pr.outline_id = o.id
                  JOIN teachers t
                  ON o.teacher_id = t.id
                  WHERE t.id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostm->execute();
        $assignProNames = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $assignProNames;
    }



    public function DBgetAllStudentsinGroups($groupName){

 //       DBgetDistinctProjectNames();

        $query = "SELECT DISTINCT pr.name as proname
                  , CONCAT(s.first_name, ' ' ,s.last_name) as name
                  FROM picks pi
                  JOIN projects pr
                  ON pi.project_id = pr.id
                  JOIN picks pi2
                  ON pi2.project_id = pr.id
                  JOIN students s
                  ON pi2.student_id = s.id
                  WHERE pi.assign = 1 AND pi2.assign=1
                  AND pr.name = '".$groupName."'";
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();

        // MAKE A BIND

        $studentsInGroups = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $studentsInGroups;
    }

    public function DBgetStuNameProName(){
        $query = "SELECT pr.name as proname
                  , pi.student_id
                  , pi.assign
                  , CONCAT(s.first_name, ' ' ,s.last_name) as name
                  FROM picks pi
                  JOIN projects pr
                  ON pi.project_id = pr.id
                  
                  JOIN students s
                  ON pi.student_id = s.id
                  WHERE pi.assign = 1
                  ORDER BY pr.name";
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();

        $studentsInGroups = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $studentsInGroups;
    }









//    public function getById($id){
//
//        $query = "SELECT * FROM milestones WHERE id = :id";
//        $pdostm = $this->db->prepare($query);
//        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
//        $pdostm->execute();
//
//        $milestones = $pdostm->fetch(PDO::FETCH_OBJ);
//        return $milestones;
//    }




//    public function getMSname(){
//        $query = "SELECT name FROM milestones";
//        $pdostm = $this->db->prepare($query);
//        $pdostm->execute();
//        $msName = $pdostm->fetchAll(PDO::FETCH_ASSOC);
//        return $msName;
//    }


}