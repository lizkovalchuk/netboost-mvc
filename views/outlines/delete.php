<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/outlines/updateDelete.css">

<main>
    <form method="POST" class="form" action="<?=BASE_PATH?>outlines/deleteOutline">
        <fieldset>
            <legend class="center-content">Delete Outline</legend>
            <input type="hidden" name="hidden_id" value="<?=$this->outline->getId()?>">

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control c-input" name="name" value="<?=$this->outline->getName()?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea rows="7" class="form-control c-input" name="description"><?=$this->outline->getDescription()?></textarea>
            </div>
            <div class="form-group">
                <label for="technology">Technology:</label>
                <input type="text" class="form-control c-input" name="technologies" value="<?=$this->outline->getTechnologies()?>">
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" class="form-control c-input" name="course" value="<?=$this->outline->getCourse()?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="minimum memebrs">Minimum Members:</label>
                    <select id="max_members" name="min_members" class="form-control c-input" disabled>
                        <option value="1"<?= $this->outline->getMinMembers() == 1? 'selected="selected"': ''; ?>>1</option>
                        <option value="2"<?= $this->outline->getMinMembers() == 2? 'selected="selected"': ''; ?>>2</option>
                        <option value="3"<?= $this->outline->getMinMembers() == 3? 'selected="selected"': ''; ?>>3</option>
                        <option value="4"<?= $this->outline->getMinMembers() == 4? 'selected="selected"': ''; ?>>4</option>
                        <option value="5"<?= $this->outline->getMinMembers() == 5? 'selected="selected"': ''; ?>>5</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="maxmembers">Maximum Members:</label>
                    <select id="max_members" name="max_members" class="form-control c-input" disabled>
                        <option value="3"<?= $this->outline->getMaxMembers() == 3? 'selected="selected"': ''; ?>>3</option>
                        <option value="4"<?= $this->outline->getMaxMembers() == 4? 'selected="selected"': ''; ?>>4</option>
                        <option value="5"<?= $this->outline->getMaxMembers() == 5? 'selected="selected"': ''; ?>>5</option>
                        <option value="6"<?= $this->outline->getMaxMembers() == 6? 'selected="selected"': ''; ?>>6</option>
                        <option value="7"<?= $this->outline->getMaxMembers() == 7? 'selected="selected"': ''; ?>>7</option>
                        <option value="8"<?= $this->outline->getMaxMembers() == 8? 'selected="selected"': ''; ?>>8</option>
                        <option value="9"<?= $this->outline->getMaxMembers() == 9? 'selected="selected"': ''; ?>>9</option>
                        <option value="10"<?= $this->outline->getMaxMembers() == 10? 'selected="selected"': ''; ?>>10</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Start Date:</label>
                    <input type="date" id="inputState" name="start_date" class="form-control c-input" value="<?=$this->outline->getStartDate()?>" />
                </div>
                <div class="form-group col-md-6">
                    <label>Due Date:</label>
                    <input type="date" id="inputState" name="due_date" class="form-control c-input" value="<?=$this->outline->getDueDate()?>" />
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="col-md-4 col-md-offset-2">
                            <input type="submit" name="btn_delete_outline" class="btn btn-primary c-btn" value="Delete">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-4 col-md-offset-2">
                        <a class="btn btn-primary c-btn" href="<?=BASE_PATH?>outlines/details/<?=$this->outline->getId();?>">Go Back</a>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</main>
