<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/requestCollab/index.css">
<main>
    <h3 class="col-xs-offset-1 col-md-offset-1 col-lg-offset-1 md">View Project Details</h3>
        <div class="outline details margin-left">
            <div class="row">
                <div>
                    <div class="col-sm-9 col-md-10 col-lg-10 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                        <div class="row">

                            <div class="col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Project Name:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requests->getName()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <label class="">
                                    Project Description:
                                </label>
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-9 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
                                <?=$this->requests->getDescription()?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div  class="btn__div"><a class="text-center c-btn override__btn" href="<?=BASE_PATH?>viewProjectRequests/index">Back</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>