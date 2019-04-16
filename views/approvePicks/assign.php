<main>
    <form method="post" action="<?=BASE_PATH?>approvepicks/assignPick">
        <fieldset>
            <input type="hidden" name="hidden_studentId" value= "<?= $this->studentId ?>" />
            <legend class="c-upd-legend">ASSIGN STUDENT TO PROJECT</legend>
            <div class="form-group col-md-12">
                <label>Most Preferred:</label>
                <span>
                    <?php
                        $temp = false;
                        foreach($this->topRating as $rating) {
                            if ($rating->stId == $rating->piId){
                            $temp = true;
                            echo "<span>" . $rating->proname . "</span>" . "</br>";
                            }
                        }
                        if($temp == false){
                            echo "<span>no top preferences indicated</span>";
                        }
                    ?>
            </div>
            <div class="form-group col-md-12">
                <label>Least Preferred:</label>
                <span>
                    <?php
                        $temp = false;
                        foreach($this->lowestRating as $rating) {
                            if ($rating->stId == $rating->piId){
                                $temp = true;
                                echo "<span>" . $rating->proname . "</span>" . "</br>";
                            }
                        }
                        if($temp == false){
                            echo "<span>no least preferred preference indicated</span>";
                        }
                    ?>
                </span>
            </div>
            <div class="form-group col-md-12">
                <label for="">Projects</label>
                <select id="inputProjects" class="form-control c-input" name="sel_Projects">
                    <?php
                        foreach($this->projectNames as $proName){ ?>
                            <option value="<?=$proName->id?>">
                                <?= $proName->name ?>
                            </option>

                        <?php  } ?>
                </select>
            </div>
            <div class="form-row col-md-12 c-create-a">
                <input type="submit" class="btn btn-primary c-btn" value="Assign Project">
            </div>
        </fieldset>
    </form>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/approvePicks/form.css">