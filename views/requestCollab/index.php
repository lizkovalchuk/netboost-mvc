<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/requestCollab/index.css">
<main>
<!--would like to fix the search bar one day-->
<!--   <div class="col-sm-12 col-md-12 col-lg-12 search_div">-->
<!--       <form method="post" action="">-->
<!--       <label class="margin_left">Search outlines</label>-->
<!--       <input name="search" class="input" type="text" placeholder="Search outlines...">-->
<!--       </form>-->
<!--   </div>-->
   <h3 class="heading-left">View All Outlines</h3>

    <?php foreach ($this->requestsCollab as $requestCollab):?>
            <div class="outline">
                <div class="row">
                    <div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                            <img src="<?= BASE_PATH?>views/public/images/requestCollab/request.svg" width="100" height="auto" class="center-block margin-left-img" alt="request graphic">
                        </div>
                        <div class="col-sm-10 col-md-10 col-lg-7 col-lg-offset-1 margin-left">
                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <label class="">
                                        Outline Name:
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <?=$requestCollab->getName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <label class="">
                                        Teacher Name:
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-9 col-lg-9 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <?=$requestCollab->getTeacher()->getFirstName() .' '. $requestCollab->getTeacher()->getLastName();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-3 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <label class="">
                                        Description:
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-9 col-lg-9 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
                                    <?=$requestCollab->getDescription();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div  class="btn__div">
                                        <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>requestCollab/details/<?=$requestCollab->getId();?>">View Details</a>
                                        <a class="text-center c-btn override__btn" href="<?=BASE_PATH?>requestCollab/addProject/<?=$requestCollab->getId();?>">Send Request</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach;?>
    </main>





