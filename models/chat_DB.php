<?php

require_once 'chat.php';
require_once 'message.php';
require_once 'chatMember.php';

class Chat_DB extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // ========= SHOW ALL CHAT THREADS ==================

  public function getChatsByUserId(int $id) : array {
      $query = "SELECT c.id, c.subject, c.date_created FROM chats c
                 JOIN chat_members cm 
                 ON c.id = cm.chat_id 
                 WHERE cm.user_id = :userid";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":userid",$id, PDO::PARAM_INT);
        $pdostm->execute();

        $chatDB = $pdostm->fetchAll(PDO::FETCH_OBJ);
        //var_dump($chatDB);
        $chats = array();

        foreach ($chatDB as $c) {
          $chat = new Chat();
          $sender = new User();

          $chat->setId($c->id); // getting the chat Id
          $chat->setSubject($c->subject);
          $chat->setDateCreated($c->date_created);
        //  $sender->setUsername($c->username); // passing the username retrieved from database
       //   $chat->setUser($sender); // from the User object in Chat class

          array_push($chats, $chat);
      }

        return $chats;

  }

    // ========= SHOW ALL MESSAGES FOR THAT CHAT ==================

    public function getAllMessagesForChat(int $id) : array {
        $query = "SELECT * FROM chats 
                  JOIN messages 
                  ON chats.id = messages.chat_id 
                  JOIN users 
                  ON messages.sender_id =users.id 
                  WHERE chats.id = :chatId";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":chatId", $id, PDO::PARAM_INT);
        $pdostm->execute();

        $chatDB = $pdostm->fetchAll(PDO::FETCH_OBJ);
       // var_dump($chatDB);
        $chats = array();

        foreach ($chatDB as $c) {
            $chat = new Chat();
            $sender = new User();
            $message = new Message();

            $message->setBody($c->body);// set the body of message
            $chat->setMessage($message);
           // var_dump($message);

            $chat->setId($c->chat_id); // getting the chat Id
            $chat->setSubject($c->subject);

            $chat->setDateCreated($c->date);
            $sender->setUsername($c->username); // passing the username retrieved from database
            $chat->setUser($sender); // from the User object in Chat class

            array_push($chats, $chat);
        }

        return $chats;
    }

       //========= GET ALL RECIPIENTS FOR NEW CHAT ==================

    public function getAllRecipientsForChat() : array {
        $query = "SELECT c.name, u.id FROM companies 
                  c JOIN users u ON c.user_id = u.id 
                  UNION SELECT t.first_name, u.id 
                  FROM teachers t JOIN users u ON t.user_id = u.id";
        $pdostm = $this->db->prepare($query);
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
         $pdostm->execute();

        $recipientsDB = $pdostm->fetchAll(PDO::FETCH_OBJ);
      //  var_dump($recipientsDB);
        $recipients = array();

        foreach ($recipientsDB as $r)
        {
            $recipient = new ChatMember();

            $recipient->setUserId($r->id);
            $recipient->setName($r->name);

            array_push($recipients,$recipient);

        }
        return $recipients;

    }

    //========= ADDING NEW CHAT ==================

    public function addNewChat(string $subject, array $chatMembers) : int {
        $query = "INSERT INTO chats (subject) 
                  VALUES (:subject)";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":subject", $subject, PDO::PARAM_STR);
         $pdostm->execute();

         if($pdostm->rowCount() > 0)
         {
             $chatId = $this->db->lastInsertId();
             //var_dump($chatId);
             $this->addChatMembers($chatMembers, $chatId);
         }

         return $chatId;

    }




    //========= ADDING CHAT MEMBERS WHEN NEW CHAT IS CREATED ==================

  public function addChatMembers(array $chatMembers, $chatId) {
        foreach ($chatMembers as $cm)
        {
            $query = "INSERT INTO chat_members (chat_id, user_id) 
                  VALUES (:chatId, :userId)";
            $pdostm = $this->db->prepare($query);
            $pdostm->bindValue(":userId", $cm, PDO::PARAM_INT);
            $pdostm->bindValue(":chatId", $chatId, PDO::PARAM_INT);

            $pdostm->execute();


        }
      return $pdostm->rowCount() > 0;
  }

}
