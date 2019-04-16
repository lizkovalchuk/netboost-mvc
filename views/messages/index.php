<main>
        <div class="container">
            <h1>Your Inbox</h1>
            <div class="row">
                <div class="col-md-10">
                    <!--inbox toolbar-->
                    <div class="row">
                        <div class="col-xs-12">
<!--                            <a class="btn btn-default btn-lg c-btn">-->
<!--                               <span class="fas fa-sync"></span>-->
<!--                            </a>-->
                            <form method="post" action="<?=BASE_PATH?>messageSystem/createChat">
                                <button type="submit" name="createNewChat" class="btn c-btn">
                                    <span class="fa fa-edit fa-lg"></span> New Chat
                                </button>
                            </form>
                        </div><!--/col-->
                    </div><!--/row-->

                    <!--/inbox toolbar-->
                    <div class="panel panel-default inbox" id="inboxPanel">
                        <!--message list-->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="hidden-xs">
                                    <tr>
                                        <td class="col-sm-1"></td>
                                        <td class="col-sm-3"><strong>Date</strong></td>
                                        <td class="col-sm-1"></td>
                                        <td class="col-sm-4"><strong>Subject</strong></td>
                                        <td class="col-sm-1"></td>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($this->chats as $chat) :?>
                                    <tr>
                                        <td class="col-sm-1 col-xs-4"><img id="msgPic" src="<?=BASE_PATH?>views/public/images/messages/envelope.svg" alt="Message Image" ></td>
                                        <td class="col-sm-3 col-xs-4"><span><?= $chat->getDateCreated(); ?></span></td>
                                        <td class="col-sm-1 col-xs-4"></td>
                                        <td class="col-sm-4 col-xs-6"><span><?= $chat->getSubject();?></span></td>
                                        <td class="col-sm-1 col-sm-2">
                                            <form method="post" action="<?=BASE_PATH?>messageSystem/messages">
                                                <input class="btn c-btn override__btn" name="viewMessage" type="submit" href="<?=BASE_PATH?>messageSystem/messages" value="View"/>
                                                <input type="hidden" name="chatId" value="<?= $chat->getId(); ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div><!--/inbox panel-->
                </div><!--/col-9-->
            </div>
        </div><!--/container-->
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/message/index.css">

    <script src="<?=BASE_PATH?>views/public/scripts/message/script.js"></script>
</main>


