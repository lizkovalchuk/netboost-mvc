<?php
/**
 * Created by PhpStorm.
 * User: purplehaze
 * Date: 2018-04-10
 * Time: 4:59 PM
 */
require_once 'teacher.php';

class Outline
{

    function __construct(){
        $this->id = (isset($this->id)) ? $this->id : "";
        $this->teacher_id = (isset($this->teacher_id)) ? $this->teacher_id : "";
        $this->name = (isset($this->name)) ? $this->name : "";
        $this->status = (isset($this->status)) ? $this->status : "";
        $this->due_date= (isset($this->due_date)) ? $this->due_date : "";
        $this->start_date = (isset($this->start_date)) ? $this->start_date : "";
        $this->min_members = (isset($this->notes)) ? $this->notes : "";
        $this->max_members = (isset($this->max_members)) ? $this->max_members : "";
        $this->description = (isset($this->description)) ? $this->description : "";
        $this->technologies = (isset($this->technologies)) ? $this->technologies : "";
        $this->course = (isset($this->course)) ? $this->course : "";

    }

    public static function getOutlinesFromPost(){
        if(isset($_POST['btn-add-outline']))
        {
            $outlines = new Outline();
            foreach ($_POST as $key => $value) {
                $outlines->$key = $value;
            }
            return $outlines;
        }
        else
            return new Outline();


    }

    private $id;
    private $teacher;
    private $name;
    private $published;
    private $due_date;
    private $start_date;
    private $min_members;
    private $max_members;
    private $description;
    private $technologies;
    private $course;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTeacher() : Teacher
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
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
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $status
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * @param mixed $due_date
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getMinMembers()
    {
        return $this->min_members;
    }

    /**
     * @param mixed $min_members
     */
    public function setMinMembers($min_members)
    {
        $this->min_members = $min_members;
    }

    /**
     * @return mixed
     */
    public function getMaxMembers()
    {
        return $this->max_members;
    }

    /**
     * @param mixed $max_members
     */
    public function setMaxMembers($max_members)
    {
        $this->max_members = $max_members;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTechnologies()
    {
        return $this->technologies;
    }

    /**
     * @param mixed $technologies
     */
    public function setTechnologies($technologies)
    {
        $this->technologies = $technologies;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

















}