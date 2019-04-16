<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<main>
    <div id="container mainChatBox">
        <div class="jumbotron">
            <h3 class="display-4"></h3>
            <?php foreach ($this->chats as $chat) :?>
            <div class="chat_box">
                <span style="color:green;"><?= $chat->getUser()->getUsername(); ?></span>
                <span style="color:brown;"><?= $chat->getMessage()->getBody(); ?></span>
                <span style="float:right;"><?= $chat->getDateCreated(); ?></span>
            </div>
            <?php endforeach;?>
        </div>
        <section>
            <form method="post" action="<?=BASE_PATH?>messageSystem/addMsgtoChat" class="chat-app-input">
                <fieldset class="form-group col-lg-12">
                    <input type="hidden" name="chatId" value="<?= $chat->getId(); ?>">
                    <input type="text" name="messageBody" class="form-control" placeholder="Type your message">
                </fieldset>
                <input class="c-btn" type="submit" name="addNewMessage" href="<?=BASE_PATH?>messageSystem/addMsgtoChat" value="Send Message" />
                <a class="btn-sm c-btn" href="<?=BASE_PATH?>messageSystem/index" role="button">Go back to Inbox</a>
            </form>
        </section>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/message/newChat.css">
</main>