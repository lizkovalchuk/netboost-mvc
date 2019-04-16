<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/outlines/index.css">

<main>

    <h3 class="center-content"><?=$this->projectdetails->getName()?></h3>

    <?php /*var_dump($this->outlines); */?>

        <!--OUTLINE 1-->
        <div class="outline">
            <div class="row">
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-2 margin-left details-margin-bottom">
                        <img src="<?= BASE_PATH?>views/public/images/outlinesimages/graphic1.svg" width="100" height="auto" class="center-block" alt="request graphic">
                    </div>

                    <div class="col-md-10 col-lg-8 margin_left">
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Description:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getDescription()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Technology:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getTechnologies()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Course:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getCourse()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Minimum Memebers:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getMinMembers()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Maximum Memebers:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getMaxMembers()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Start Date:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=$this->projectdetails->getStartDate()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Due Date:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?= $this->projectdetails->getDueDate()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Published:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                <?=($this->projectdetails->getPublished()) ? "YES" : "NO" ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 buttons-div">
                                <span><a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/index">Back</a></span>
                                <span><a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/updateOutline/<?=$this->projectdetails->getId()?>">Update</a></span>
                                <span><a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlines/delete/<?=$this->projectdetails->getId()?>">Delete</a></span>
                                <span><a class="text-center c-btn override__btn" href="<?=BASE_PATH?>outlineassists/index/<?=$this->projectdetails->getId()?>">Manage Students</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>



