<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/outlines/index.css">


<main>
    <h3>View Your Outlines</h3>

<?php /*var_dump($this->outlines); */?>
    <?php foreach ($this->projects as $p) {?>
    <!--OUTLINE 1-->
    <div class="outline">
        <div class="row">
            <div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                    <img src="<?= BASE_PATH ?>views/public/images/outlinesimages/graphic1.svg" width="100" height="auto" class="center-block img" alt="request graphic">
                </div>
                <div class="col-sm-7 col-md-7 col-lg-7 content-div">
                    <div class="row">

                        <div class="col-sm-3 col-md-3 col-lg-3 col-md-offset-0 col-lg-offset-0">
                            <label class="">
                                Name:
                            </label>
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-9 col-md-offset-0 col-lg-offset-0">
                            <?=$p->name?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3 col-md-offset-0 col-lg-offset-0">
                            <label class="">
                                Published:
                            </label>
                        </div>
                        <div class="col-sm-8 col-md-9 col-lg-9 col-md-offset-0 col-lg-offset-0">
                            <?= ($p->published) ? "YES" :"NO" ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 buttons-div">
                            <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/details/<?=$p->id?>">View Details</a>
                            <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/updateOutline/<?=$p->id?>">Update</a>
                            <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/delete/<?=$p->id?>">Delete</a>
                            <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/closeOutline/<?=$p->id?>">Close Outline</a>
                            <div class="errMsg center-content"><?php if(!is_null($this->msg)){ ?>
                                <span><?=$this->msg?></span>
                            <?php } ?></div>
                            <!--<a class="text-center c-btn override__btn" href="#">Publish</a>-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php  }?>
</main>


