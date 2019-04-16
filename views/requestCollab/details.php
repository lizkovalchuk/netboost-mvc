<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/requestCollab/index.css">
<main>
    <h3 class="col-xs-offset-1 col-md-offset-1 col-lg-offset-1 md"><?=$this->requestCollab->getName()?></h3>
        <div class="outline details margin-left">
            <div class="row">
                    <div class="col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-1">
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Teacher Name:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?php echo $this->requestCollab->getTeacher()->getFirstName() .' '. $this->requestCollab->getTeacher()->getLastName();?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Description
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getDescription()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Technologies:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getTechnologies()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Course:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getCourse()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Minimum Memebers:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getMinMembers()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Maximum Members:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getMaxMembers()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Start Date:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getStartDate()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Due Date:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requestCollab->getDueDate()?>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div  class="btn__div">
                                    <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>requestCollab/addProject/<?php echo $this->requestCollab->getId();?>">Send Request</a>
                                    <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>requestCollab/index">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</main>


