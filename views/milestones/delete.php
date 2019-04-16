<main>
    <body>
    <form method="post" action="<?=BASE_PATH?>milestones/deleteMS/<?= $this->milestone->id ?>">
        <fieldset>
            <legend class="c-del-legend">DELETE</legend>
            <div class="form-group col-md-12">
                <input type="hidden" name="hidden_id" value= "<?= $this->milestone->id ?>" />
                <input type="hidden" name="hidden_project_id" value= "<?=$this->milestone->project_id?>" />
                <label>Name:</label>
                <p><?= $this->milestone->name ?></p>
            </div>

            <div class="form-group col-md-12">
                <label>Estimated Duration:</label>
                <p><?= $this->milestone->percentage ?></p>
            </div>

            <div class="form-group col-md-12">
                <label>Due Date:</label>
                <p><?= $this->milestone->due_date ?></p>
            </div>

            <div class="form-row">
                <div class="col-lg-6 col-xs-12 c-create-a">
                    <input type="submit" class="btn btn-primary c-btn" value="Delete Milestone">
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="col-md-6 col-md-offset-4">
                        <a href="<?=BASE_PATH?>milestones/updateIndex/<?=$this->milestone->project_id?>" class='btn btn-primary c-btn'>Cancel</a>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    </body>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/form.css">
