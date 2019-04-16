<main>
    <body>
    <form method="post" action="<?=BASE_PATH?>milestones/createM" >
        <fieldset>
            <legend>ADD MILESTONE</legend>
            <input type="hidden" name="hidden_project_id" value= "<?=$this->project_id?>" />
            <div class="form-group col-md-12">
                <label>Name of Milestone:</label>
                <input type="text" class="form-control c-input" placeholder="Name of task" name="inp_name">
            </div>
            <div class="form-group col-md-12">
                <label>Percentage of Milestone:</label>
                <input type="number" class="form-control c-input" name="inp_perc">
            </div>
            <div class="form-group col-md-12">
                <label>Due Date:</label>
                <input type="date" class="form-control c-input" name="inp_dueDate">
            </div>
            <div class="form-row col-md-12 c-create-a">
                <input type="submit" class="btn btn-primary c-btn" value="Add New Milestone">
            </div>
        </fieldset>
    </form>
    </body>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/milestones/form.css">