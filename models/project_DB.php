<?php
require_once 'project.php';
require_once 'outline.php';
require_once 'company.php';
require_once 'teacher.php';

class Project_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }


    /* ========= READ - ALL ================== */

    public function getProjectbyId($id)  : Project
    {
        $query = "SELECT * FROM projects WHERE id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id);
        $pdostm->execute();
        $projectDB = $pdostm->fetch(PDO::FETCH_OBJ);

        // create an instance of Project class.
        $project = new Project();
        $project->setId($projectDB->id);
        $project->setCompany($projectDB->company_id);
        $project->setOutline($projectDB->outline_id);
        $project->setStatus($projectDB->status);
        $project->setDateCreated($projectDB->date_created);
        $project->setName($projectDB->name);
        $project->setDescription($projectDB->description);

        return $project;
    }

    /* ========= READ - By teacher ID ================== */

    /**
     * @param int $teacher_id
     * @return array of project requests
     */
    public function getProjectRequestsByTeacherId(int $teacher_id)  : array
    {
        $query = "SELECT o.id AS outline_id , c.id AS company_id, c.user_id, p.id as project_id, c.name AS company_name, 
                  p.name AS project_name, p.description, p.status, o.name AS outline_name, p.date_created 
                  FROM projects p JOIN outlines o on p.outline_id = o.id JOIN companies c ON c.id = p.company_id 
                  WHERE o.teacher_id = :teacher_id";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':teacher_id', $teacher_id);
        $pdostm->execute();
        $projectsDB = $pdostm->fetchAll(PDO::FETCH_OBJ);

        $projectRequests = array();

        // create an instance of Project class.
        foreach ($projectsDB as $projectRequest) {
            $project = new Project();
            $company = new Company();
            $outline = new Outline();

            $company->setCompanyId($projectRequest->company_id);
            $company->setId($projectRequest->user_id);
            $company->setName($projectRequest->company_name);
            $outline->setId($projectRequest->outline_id);
            $outline->setName($projectRequest->outline_name);

            $project->setId($projectRequest->project_id);
            $project->setCompany($company);
            $project->setOutline($outline);
            $project->setStatus($projectRequest->status);
            $project->setDateCreated($projectRequest->date_created);
            $project->setName($projectRequest->project_name);
            $project->setDescription($projectRequest->description);

            array_push($projectRequests, $project);
        }

        return $projectRequests;
    }

    /* ========= READ - SENT REQUESTS - company ID ================== */
    public function getSentRequestsByCompanyId(int $company_id) : array
    {
        $query = "SELECT o.id AS outline_id , p.id as project_id, t.first_name, t.last_name, 
                  p.name AS project_name, p.status, p.date_created, o.name AS outline_name 
                  FROM projects p JOIN outlines o on p.outline_id = o.id JOIN teachers t 
                  ON t.id = o.teacher_id WHERE p.company_id = :company_id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':company_id', $company_id);
        $pdostm->execute();
        $requestsDB = $pdostm->fetchAll(PDO::FETCH_OBJ);

        $sentRequests = array();

        foreach ($requestsDB as $sentRequest) {
            $project = new Project();
            $teacher = new Teacher();
            $outline = new Outline();

            $outline->setId($sentRequest->outline_id);
            $outline->setName($sentRequest->outline_name);
            //$teacher->setId($sentRequest->teacher_id);
            $teacher->setFirstName($sentRequest->first_name);
            $teacher->setLastName($sentRequest->last_name);

            $outline->setTeacher($teacher);
            $project->setOutline($outline);

            $project->setId($sentRequest->project_id);
            $project->setName($sentRequest->project_name);
            $project->setStatus($sentRequest->status);
            $project->setDateCreated($sentRequest->date_created);

            array_push($sentRequests, $project);
        }
        return $sentRequests;
    }

    /* ========= INSERT ================== */
    public function addProject(Project $project) : int {
        //var_dump($project);
        $query = "INSERT INTO projects (company_id, outline_id, status, name, description) 
                        VALUES(:company_id, :outline_id, 'Sent', :name, :description)";

        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':company_id', $project->getCompany()->getCompanyId());
        $pdostm->bindValue(':outline_id', $project->getOutline()->getId());
        $pdostm->bindValue(':name', $project->getName());
        $pdostm->bindValue(':description', $project->getDescription());


        return $pdostm->execute();
    }


    /* ========= UPDATE ================== */

    public function updateProject($id, Project $project): int {
        $query ="UPDATE projects SET 
                id = :id,
                company_id = :company_id,
                outline_id = :outline_id,
                status = :status,
                date_created = :date_created,
                name = :name,
                description  = :description
                WHERE id = :id ";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":id", $id, PDO::PARAM_INT);
        //how do I just get the company and outline id but not have it in the form? hidden id?
        $pdostm->bindValue(":company_id", $id, PDO::PARAM_INT);
        $pdostm->bindValue(":outline_id", $id, PDO::PARAM_INT);

        $pdostm->bindValue(":name", $project->getName(), PDO::PARAM_STR);
        $pdostm->bindValue(":description",$project->getDescription(), PDO::PARAM_STR);
        $pdostm->bindValue(":status",$project->getStatus(), PDO::PARAM_STR);
        $pdostm->bindValue(":date_created",$project->getDateCreated(), PDO::PARAM_STR);



        return $pdostm->execute();

    }

    // ========= DELETE ==================
    public function deleteProject($id, Project $project): Project
    {
        $query = "DELETE FROM projects where id = :id";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(':id', $id,PDO::PARAM_INT);

        return $pdostm->execute();
    }

    // ========= Update- Accept Project ==================

        public function acceptProject($id) : Int {
            $query ="UPDATE projects SET 
                status = 'Accepted'
                WHERE id = :id";

            $pdostm = $this->db->prepare($query);

            $pdostm->bindValue(':id', $id,PDO::PARAM_INT);

            return $pdostm->execute();

        }

    // ========= Update - Decline Project ==================

    public function declineProject($id) : Int {
        $query ="UPDATE projects SET 
                status = 'Declined'
                WHERE id = :id";

        $pdostm = $this->db->prepare($query);

        $pdostm->bindValue(':id', $id,PDO::PARAM_INT);

        return $pdostm->execute();

    }

}

