<main>
    <body>
    <form method="post" action="<?=BASE_PATH?>milestones/updateMS/<?= $this->milestone->id ?>" >
        <fieldset>
            <legend>UPDATE MILESTONE</legend>
            <input type="hidden" name="hidden_project_id" value= "<?= $this->milestone->project_id ?>" />
            <input type="hidden" name="hidden_id" value= "<?= $this->milestone->id ?>" />
            <div class="form-group col-md-12">
                <label>Name of Milestone:</label>
                <input type="text" class="form-control c-input" value="<?= $this->milestone->name ?>" name="inp_name">
            </div>
            <div class="form-group col-md-12">
                <label>Percentage of Milestone:</label>
                <input type="number" class="form-control c-input" value="<?= $this->milestone->percentage ?>" name="inp_perc">
            </div>
            <div class="form-group col-md-12">
                <label>Due Date:</label>
                <input type="date" class="form-control c-input" value="<?= $this->milestone->due_date ?>" name="inp_dueDate">
            </div>
            <div class="form-row">
                <div class="col-lg-6 col-xs-12 c-create-a">
                    <input type="submit" class="btn btn-primary c-btn" value="Update Milestone">
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
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/milestones/form.css">