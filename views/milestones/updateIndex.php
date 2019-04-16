<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">All Milestones</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover" id="table-c">
                <thead>
                <tr>
                    <th>Milestone Name</th>
                    <th>Percentage</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php
    foreach ($this->milestones as $ms){

        echo   "<tr>"
            . "<td>" . $ms->name . "</td> "
            . "<td>" . $ms->percentage . "</td>"
            . "<td>" . $ms->due_date . "</td>"
            . "<td><a href=" . BASE_PATH . "milestones/update". "/" . $ms->id . ">Update</a>
            |  <a href=" . BASE_PATH . "milestones/delete". "/" . $ms->id . ">Delete</a></td>"
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
                <a href="<?=BASE_PATH?>milestones/showMilestones/<?=$this->project_id?>" class="btn btn-primary c-btn">Return to Milestones Home</a>
            </div>
        </div>
    </div>

</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/index.css">