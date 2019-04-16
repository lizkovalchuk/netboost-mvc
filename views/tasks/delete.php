
<?php

if (isset($_POST['btn-delete-task'])){
    $t = new Task_DB();
    $id = $_POST['hidden_id'];
    $delTask = $t->deleteTask($id);
    header('Location: index.php');
}

?>

<main>
    <body>
    <form method="post" action="<?=BASE_PATH?>tasks/deleteTask/<?= $this->task->id ?>">
        <fieldset>
            <legend class="c-del-legend">DELETE</legend>
            <div class="form-group col-md-12">

                <input type="hidden" name="hidden_id" value= "<?= $this->task->id ?>" />

                <label>Name:</label>
                <p><?= $this->task->name ?></p>
            </div>
            <div class="form-group col-md-12">
                <label for="formGroupExampleInput2">Due Date:</label>
                <p><?= $this->task->due_date ?></p>
            </div>

                <div class="form-group col-md-12">
                    <label for="formGroupExampleInput3">Estimated Duration:</label>
                    <p><?= $this->task->length_hours ?></p>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Status:</label>
                    <p><?= $this->task->status ?></p>
                </div>

            <div class="form-group col-md-12">
                <div class="" >
                    <label>Notes:</label>
                    <p><?= $this->task->notes ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-6 col-xs-12 c-create-a">
                    <input type="submit" class="btn btn-primary c-btn" name="btn-delete-task" value="Delete Task">
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="col-md-6 col-md-offset-4">
                        <a href="<?=BASE_PATH?>tasks/Index" class='btn btn-primary c-btn'>Cancel</a>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    </body>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/form.css">
