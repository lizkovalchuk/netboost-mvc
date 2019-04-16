<main>
    <body>
    <form method="post" action="<?=BASE_PATH?>tasks/updateTask/<?= $this->task->id ?>">
        <fieldset>
            <legend class="c-upd-legend">UPDATE</legend>

            <input type="hidden" name="hidden_id" value= "<?= $this->task->id ?>" />

            <div class="form-group col-md-12">
                <label>Name:</label>
                <input type="text" class="form-control c-input" value="<?= $this->task->name ?>" name="inp_name">
            </div>
            <div class="form-group col-md-12">
                <label>Due Date:</label>
                <input type="date" class="form-control c-input" value="<?= $this->task->due_date ?>" name="inp_dueDate">
            </div>
            <div class="form-group col-md-12">
                <div class="form-group col-md-6">
                    <label>Estimated Duration:</label>
                    <input type="number" class="form-control c-input" value="<?= $this->task->length_hours ?>" name="inp_dur">
                </div>
                <div class="form-group col-md-6">
                    <label>Status</label>
                    <select id="inputState" class="form-control c-input" name="sel_status">
                        <option selected><?= $this->task->status ?></option>
                        <option>complete</option>
                        <option>in-progress</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="" >
                    <label>Notes:</label>
                    <input type="textarea" class="form-control c-input c-txtarea" placeholder="<?= $this->task->notes ?>" name="inp_notes">
                </div>
            </div>
            <div class="form-row col-md-12 c-create-a">
                <input type="submit" class="btn btn-primary c-btn" value="Update Task">
            </div>
        </fieldset>
    </form>
    </body>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/tasks/form.css">
