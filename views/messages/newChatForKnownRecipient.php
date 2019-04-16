<main>
    <div class="container form-container">
        <form  method='post' action='<?=BASE_PATH?>messageSystem/sendNewMessage' >
            <fieldset>
                <legend>Create new chat</legend>
                <div class="form-group">
                    <label for="recipient">Recipient</label>
                    <input type="hidden" name="recipientSelected" value="<?=$this->recipientId; ?>">
                        <label><?php echo $this->recipient->getName(); ?></label>
                </div>
                <div class="form-group">
                    <label for="chatSubject">Subject</label>
                    <input type="text" name="newMsgSubject" class="form-control c-input" placeholder="Enter the subject of your chat">
                </div>
                <div class="form-group">
                    <label for="chatMessage">Enter Message</label>
                    <textarea name="newChatMsg" class="form-control c-input" placeholder="Enter the message you want to send" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" href="<?=BASE_PATH?>messageSystem/sendNewMessage" name="createNewChat" class="btn c-btn">Create new chat</button>
                            <a class="btn c-btn"  href="<?=BASE_PATH?>viewProjectRequests"><i class="fas fa-backward"></i>back</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/message/newChat.css">
</main>