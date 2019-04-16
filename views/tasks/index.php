<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">Task Manager</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover" id="table-c">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date and Time Created</th>
                        <th>Due Date</th>
                        <th>Task Duration</th>
                        <th>Notes</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


<?php
    foreach ($this->tasks as $t){
        echo   "<tr>"
            . "<td>" . $t->name . "</td> "
            . "<td>" . $t->status . "</td>"
            . "<td>" . $t->date_created . "</td>"
            . "<td>" . $t->due_date . "</td>"
            . "<td>" . $t->length_hours . " hours" . "</td>"
            . "<td>" . $t->notes . "</td>"
            . "<td>" . $t->fname . "</td>"
            . "<td><a href=" . BASE_PATH . "tasks/update". "/" . $t->id . ">Update</a>
             <a href=" . BASE_PATH . "tasks/delete". "/" . $t->id . ">Delete</a></td>"
            . "</tr>";
    }
?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-12">
            <div class="col-md-6 col-md-offset-5">
                <a href="<?=BASE_PATH?>tasks/create/<?=$this->project_id?>" class="btn btn-primary c-btn">Create New Task</a>
            </div>
        </div>
    </div>

</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/index.css">