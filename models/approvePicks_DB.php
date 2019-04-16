<?php
require_once 'pick.php';
require_once 'project.php';

class ApprovePicks_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }

// ======================================================
// ========== INDEX PAGE ================================
// ======================================================


    // SIMPLE GROUP BY STUDENTS

    public function groupByStuID()
    {
        $query = "SELECT student_id 
                , CONCAT(s.first_name, ' ' ,s.last_name) as stu_name 
                FROM picks pi JOIN students s ON pi.student_id = s.id 
                GROUP BY student_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $studentsFromPicks = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $studentsFromPicks;
    }

    // RATINGS FUNCTIONS

    public function topRatings()
    {
        $query = ("
               SELECT 
               DISTINCT pr.name
			  , pi.rating
	          , pi.student_id
              , pi.project_id
              FROM picks pi
              JOIN projects pr
              ON 
              pi.project_id = pr.id
              WHERE pi.rating = 5
              ORDER BY pi.student_id");
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $topRatings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $topRatings;
    }


    public function lowestRating()
    {
        $query = ("SELECT
              DISTINCT pr.name
              , pi.rating
	          , pi.student_id
              , pi.project_id
              FROM picks pi
              JOIN projects pr
              ON 
              pi.project_id = pr.id
              WHERE pi.rating = 0
              ORDER BY pi.student_id");
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $lowerRatings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $lowerRatings;
    }

    // READ IF STUDENT HAS BEEN ASSIGNED

    public function getAssignedName()
    {
        $query = ("SELECT 
              DISTINCT pr.name
              , pi.rating
	          , pi.id
              , pi.assign
              , pi.student_id
              FROM picks pi
              JOIN projects pr
              ON 
              pi.project_id = pr.id");
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $assignment = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $assignment;
    }




// ======================================================
// ========== ASSIGN PAGE ================================
// ======================================================


//    public function getById($id){
//
//        $query = "SELECT * FROM picks WHERE id = :id";
//        $pdostm = $this->db->prepare($query);
//        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
//        $pdostm->execute();
//        $apPicks = $pdostm->fetch(PDO::FETCH_OBJ);
//        return $apPicks;
//    }


    public function getStudentId()
    {
        $query = "SELECT student_id FROM picks";
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $stuId = $pdostm->fetch(PDO::FETCH_OBJ);
        return $stuId;
    }


    public function topRatingsAssign($id)
    {
        $query = ("
               SELECT pr.name as proname 
               , pi.student_id as piId 
               , st.id as stId 
               , pi.rating
               FROM picks pi 
               JOIN students st 
               ON st.id = pi.student_id 
               JOIN projects pr 
               ON pi.project_id = pr.id 
               WHERE pi.student_id = 1
               ORDER BY  pi.rating DESC
               LIMIT 1");
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();
        $topRatings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $topRatings;
    }

    public function lowestRatingAssign($id)
    {
        $query = ("
              SELECT pr.name as proname 
               , pi.student_id as piId 
               , st.id as stId 
               , pi.rating
               FROM picks pi 
               JOIN students st 
               ON st.id = pi.student_id 
               JOIN projects pr 
               ON pi.project_id = pr.id 
               WHERE pi.student_id = 1
               ORDER BY  pi.rating ASC
               LIMIT 1");
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();
        $lowerRatings = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $lowerRatings;
    }

    public function projectNames()
    {
        $query = ("select name, id from projects");
        $pdostm = $this->db->prepare($query);
        $pdostm->execute();
        $projectNames = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $projectNames;
    }


// UPDATE THE ASSIGNED COLUMN IN PICKS TABLE

    public function getProjectName($id = null)
    {
        $query = 'SELECT outlines.name 
                  FROM picks 
                  JOIN outlines 
                  ON picks.project_id = outlines.id';
        $pdostm = $this->db->prepare($query);
        //      $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        $pdostm->execute();
        $proName = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $proName;
    }


    public function updateAssign()
    {
        $student = $_POST['hidden_studentId'];
        $project = $_POST['sel_Projects'];

        //FIRST QUERY
        $query1 = "UPDATE picks
                   SET assign = FALSE
                   WHERE student_id = :studentId";
        $pdostm = $this->db->prepare($query1);
        $pdostm->bindValue(':studentId', $student, PDO::PARAM_INT);
        $upAssign = $pdostm->execute();


        //SECOND QUERY
        $query2 = "UPDATE picks 
                  set assign = TRUE 
              --    WHERE (student_id = )
              --    AND (project_id = )
                  
                  WHERE (project_id = :projectId) 
                  AND (student_id = :studentId)";
        $pdostm = $this->db->prepare($query2);

        $pdostm->bindValue(':projectId', $project, PDO::PARAM_INT);
        $pdostm->bindValue(':studentId', $student, PDO::PARAM_INT);
        $upAssign = $pdostm->execute();
        return $upAssign;
    }


    // -------- FANCY QUERY DIEGO MADE
    public function getAll()
    {
//        $apPicks = $this->db->query("SELECT * FROM picks");

        $apPicks = $this->db->query("
            SELECT pi.status, pr.id as prid
                    , pi.assign as assigned
                    , pi.rating as rating
                    , pi.id as pickId
                    , s.id AS stuId
                    , CONCAT(s.first_name
                    , \" \",s.last_name) as stu_name 
                    , pr.name as proName
                    FROM outline_assists os 
                    JOIN students s ON os.student_id = s.id 
                    JOIN (
                      SELECT * FROM picks 
                      ORDER BY picks.rating DESC LIMIT 3) 
                    pi ON pi.student_id = s.id 
                    JOIN projects pr 
                    ON pr.id = pi.project_id");
        $apPicks->execute();
        return $apPicks->fetchAll(PDO::FETCH_OBJ);

    }

}





























//==================================================
    // NOT USING BELOW
//==================================================


    // ========== UPDATE ===========

//    public function updateStatus($post_id){
//
//        //   $post_id = $_POST['hidden_id'];
//  //      $uStatus = $_POST['sel_Projects'];
//
//        $query = ('UPDATE picks SET assign = TRUE WHERE id = :id ');
//        $pdostm = $this->db->prepare($query);
//        $pdostm->bindValue(':id', $post_id, PDO::PARAM_STR);
//  //      $pdostm->bindValue(':status', $uStatus, PDO::PARAM_STR);
//        $count = $pdostm->execute();
//        return $count;
//    }
//}
