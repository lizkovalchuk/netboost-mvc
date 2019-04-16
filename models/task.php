<?php
class Task{
    function __construct(){
        $this->id = (isset($this->id)) ? $this->id : "";
        $this->project_id = (isset($this->project_id)) ? $this->project_id : "";
        $this->name = (isset($this->name)) ? $this->name : "";
        $this->status = (isset($this->status)) ? $this->status : "";
        $this->date_created = (isset($this->date_created)) ? $this->date_created : "";
        $this->length_hours = (isset($this->length_hours)) ? $this->length_hours : "";
        $this->notes = (isset($this->notes)) ? $this->notes : "";
        $this->creator = (isset($this->creator)) ? $this->creator : 1;
    }

    public static function getTasksFromPost(){
        if(isset($_POST['addSubmit']))
        {
            $tasks = new Task();
            foreach ($_POST as $key => $value) {
                $tasks->$key = $value;
            }
            return $tasks;
        }
        else
            return new Task();
    }
}