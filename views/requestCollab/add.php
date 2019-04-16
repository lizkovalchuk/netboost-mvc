<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/requestCollab/add.css">
<main>
    <form  method='post' action='<?=BASE_PATH?>requestCollab/addProject' >
        <fieldset>
            <legend>Send Project Request</legend>
            <input type="hidden" value="<?=$this->id?>" name="hidden_outline">
            <?php if (isset($this->requestSent)){  ?>
                <?=$this->requestSent; ?>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="col-md-4 col-md-offset-2">
                            <a type="submit" name="backIndex" class="btn btn-primary c-btn" href="<?= BASE_PATH?>requestCollab/index">Back</a>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="form-group">
                    <label for="formGroupExampleInput">Name:</label>
                    <input type="text" class="form-control c-input" placeholder="Project Name" name="name">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput4">Description</label>
                    <textarea class="form-control c-input" placeholder="Describe the project..." rows="7" name="description"></textarea>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="col-md-4 col-md-offset-2">
                            <button type="submit" name="sendRequest" class="btn btn-primary c-btn">Send Request</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </fieldset>
    </form>
    <div class="row">
        <div class="col-md-12">
            <!--<div class="col-md-4 col-md-offset-2">-->
                <a type="submit" name="backIndex" class="btn btn-primary c-btn" href="<?= BASE_PATH?>requestCollab/index">Back</a>
           <!-- </div>-->
        </div>
    </div>

</main>


