<main>
    <body>
    <form action="<?=BASE_PATH?>tasks/createPost/<?=$this->project_id?>" method="POST">
        <fieldset>
            <legend>CREATE NEW TASK</legend>
            <input type="hidden" name="hidden_id" value= "<?=$this->project_id?>" name="hidden_id" />
            <div class="form-group col-md-12">
                <label>Name:</label>
                <input type="text" class="form-control c-input" placeholder="Name of task" name="inp_name">
            </div>
            <div class="form-group col-md-12">
                <label for="formGroupExampleInput2">Due Date:</label>
                <input type="date" class="form-control c-input" name="inp_dueDate">
            </div>
            <div class="form-group col-md-12">
                <div class="form-group col-md-6">
                    <label for="formGroupExampleInput3">Estimated Duration:</label>
                    <input type="number" class="form-control c-input" name="inp_dur">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Status</label>
                    <select id="inputState" class="form-control c-input" name="sel_status">
                        <option selected>In-progress</option>
                        <option>complete</option>
                        <option>in-review</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="" >
                    <label>Notes:</label>
                    <textarea rows="7" class="form-control c-input" name="inp_notes"></textarea>
<!--                    <input type="textarea" class="form-control c-input c-txtarea" name="inp_notes">-->
                </div>
            </div>
            <div class="form-row col-md-12 c-create-a">
                <form action="create.php" method="post">
                    <input type="submit" class="btn btn-primary c-btn" name="btn_addTask" value="Add New Task">
                </form>
            </div>
        </fieldset>
    </form>
    </body>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/form.css">
