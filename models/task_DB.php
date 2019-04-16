<?php
class Task_DB extends Model{
    function __construct(){
        parent::__construct();
    }


    // ========= READ ==================

    public function getAll($id){
        $query = "
          SELECT t.* ,
	      CONCAT(s.first_name, ' ' ,s.last_name) as fname
          FROM tasks t
          JOIN students s
          ON t.creator = s.id
          WHERE t.project_id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostm->execute();
        $tasks = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }
    public function getById($id){
        $query = "SELECT * FROM tasks WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();

        $tasks = $pdostm->fetch(PDO::FETCH_OBJ);
        return $tasks;
    }



    // ========= INSERT ==================

    public function insert(){

        $cName = $_POST['inp_name'];
        $cStatus = $_POST['sel_status'];
        $cDueDate = $_POST['inp_dueDate'];
        $cDuration = $_POST['inp_dur'];
        $cNotes = $_POST['inp_notes'];
        $cProject_Id = $_POST['hidden_id'];
        $cStudent_id = $_SESSION['roleId'];

        $tasksI = $this->db->prepare('INSERT INTO tasks 
                                            (project_id, name, status, due_date, length_hours, notes, creator) 
                                            VALUES (:id, :name, :status, :due_date, :length_hours, :notes, :creator)');
        return $tasksI->execute(array(':id'=>$cProject_Id,
                                      ':name'=>$cName,
                                      ':status'=>$cStatus,
                                      ':due_date'=>$cDueDate,
                                      ':length_hours'=>$cDuration,
                                      ':notes'=>$cNotes,
                                      ':creator'=>$cStudent_id
                                      ));
    }

    // ========= DELETE ==================

    public function delete()
    {
        $id = $_POST['hidden_id'];
//        $taskD = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        $query = "DELETE FROM tasks WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id, PDO::PARAM_STR);
        $count = $pdostm->execute();
        return $count;

    }

    // =========== UPDATE ================



    public function update(){
        $cName = $_POST['inp_name'];
        $cStatus = $_POST['sel_status'];
        $cDueDate = $_POST['inp_dueDate'];
        $cDuration = $_POST['inp_dur'];
        $cNotes = $_POST['inp_notes'];
        $post_id = $_POST['hidden_id'];

        $query = ('UPDATE tasks
                SET name = :name,
                status = :status,
                due_date = :date,
                length_hours = :length_hours,
                notes = :notes
                WHERE id = :id ');
        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':id', $post_id, PDO::PARAM_STR);
        $pdostm->bindValue(':name', $cName, PDO::PARAM_STR);
        $pdostm->bindValue(':status', $cStatus, PDO::PARAM_STR);
        $pdostm->bindValue(':date', $cDueDate, PDO::PARAM_STR);
        $pdostm->bindValue(':length_hours', $cDuration, PDO::PARAM_INT);
        $pdostm->bindValue(':notes', $cNotes, PDO::PARAM_STR);

        $count = $pdostm->execute();
        return $count;


    }


    // =============== GROUP LIST ================

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



}