<?php

class Milestone
{
    private $id;
    private $project;
    private $name;
    private $perc;
    private $length_days;
    private $notes;
    private $creator;

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
    public function getProject() : Project
    {
        return $this->project;
    }

    /**
     * @param mixed $project_id
     */
    public function setProjectId($project_id) : int
    {
        $this->project_id = $project_id;
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
    public function getPerc()
    {
        return $this->perc;
    }

    /**
     * @param mixed $perc
     */
    public function setPerc($perc)
    {
        $this->perc = $perc;
    }

    /**
     * @return mixed
     */
    public function getLengthDays()
    {
        return $this->length_days;
    }

    /**
     * @param mixed $length_days
     */
    public function setLengthDays($length_days)
    {
        $this->length_days = $length_days;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }


}