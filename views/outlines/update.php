

<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/outlines/updateDelete.css">

<main>
    <div class="">
        <form method="POST" class="form" action="<?=BASE_PATH?>outlines/update">
            <fieldset>
                <legend class="center-content">Update Outline</legend>
                <input type="hidden" name="hidden_id" value="<?=$this->update->getId();?>">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control c-input" name="name" value="<?=$this->update->getName();?>">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea rows="7" class="form-control c-input" name="description"><?=$this->update->getDescription();?></textarea>
                </div>
                <div class="form-group">
                    <label for="technology">Technology:</label>
                    <input type="text" class="form-control c-input" name="technologies" value="<?=$this->update->getTechnologies();?>">
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" class="form-control c-input" name="course" value="<?=$this->update->getCourse();?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="minimum memebrs">Minimum Members:</label>
                        <select id="min_members" name="min_members" class="form-control c-input">
                            <!--<option selected><?/*=$this->update->getMinMembers();*/?></option>-->
                            <option value="1"<?= $this->update->getMinMembers() == 1? 'selected="selected"': ''; ?>>1</option>
                            <option value="2"<?= $this->update->getMinMembers() == 2? 'selected="selected"': ''; ?>>2</option>
                            <option value="3"<?= $this->update->getMinMembers() == 3? 'selected="selected"': ''; ?>>3</option>
                            <option value="4"<?= $this->update->getMinMembers() == 4? 'selected="selected"': ''; ?>>4</option>
                            <option value="5"<?= $this->update->getMinMembers() == 5? 'selected="selected"': ''; ?>>5</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="maxmembers">Maximum Members:</label>
                        <select id="max_members" name="max_members" class="form-control c-input">
                            <option value="3"<?= $this->update->getMaxMembers() == 3? 'selected="selected"': ''; ?>>3</option>
                            <option value="4"<?= $this->update->getMaxMembers() == 4? 'selected="selected"': ''; ?>>4</option>
                            <option value="5"<?= $this->update->getMaxMembers() == 5? 'selected="selected"': ''; ?>>5</option>
                            <option value="6"<?= $this->update->getMaxMembers() == 6? 'selected="selected"': ''; ?>>6</option>
                            <option value="7"<?= $this->update->getMaxMembers() == 7? 'selected="selected"': ''; ?>>7</option>
                            <option value="8"<?= $this->update->getMaxMembers() == 8? 'selected="selected"': ''; ?>>8</option>
                            <option value="9"<?= $this->update->getMaxMembers() == 9? 'selected="selected"': ''; ?>>9</option>
                            <option value="10"<?= $this->update->getMaxMembers() == 10? 'selected="selected"': ''; ?>>10</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Start Date:</label>
                        <input type="date" id="inputState" name="start_date" class="form-control c-input" value="<?=$this->update->getStartDate()?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Due Date:</label>
                            <input type="date" id="inputState" name="due_date" class="form-control c-input" value="<?=$this->update->getDueDate()?>" />
                    </div>
                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="maxmembers">Status:</label>
                                        <?php if($this->update->getPublished() == 1){?>
                                            <label class="col-md-7 form-control ">Published</label>
                                        <? }else{?>
                                        <select id="inputState" name="published" class="form-control c-input">
                                            <option value="1"<?= $this->update->getPublished() == 1? 'selected="selected"': ''; ?>>Publish</option>
                                            <option value="0"<?= $this->update->getPublished() == 0? 'selected="selected"': ''; ?>>Save</option>
                                        </select>
                                        <?php } ?>
                                    </div>
                                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" name="btn_update_outline" class="btn btn-primary c-btn" value="Update">
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
        <div class="col-md-7">
            <div class="col-md-4 col-md-offset-2">
                <a class="btn btn-primary c-btn" href="<?=BASE_PATH?>outlines/details/<?=$this->update->getId();?>">Go Back</a>
            </div>
        </div>
    </div>
</main>

