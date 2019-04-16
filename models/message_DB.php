<?php

require_once 'message.php';
require_once 'chat.php';

class Message_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // ========= ADD MESSAGE TO CURRENT CHAT ==================

    public function addMsgToExistingChat(Message $message) : int {
        $query = "INSERT INTO messages
                  (chat_id,body,sender_id) 
                  VALUES (:chat_id, :message, :userId)";

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":chat_id", $message->getChat()->getId());
        $pdostm->bindValue(":message", $message->getBody());
        $pdostm->bindValue("userId", $message->getSender()->getId());

        return $pdostm->execute();
    }

}
