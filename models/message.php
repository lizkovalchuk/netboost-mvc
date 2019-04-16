<?php

require_once 'chat.php';

class Message
{

 private $id;
 private $chat;
 private $body;
 private $sender;
 private $dated;

    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getChat() : Chat
    {
        return $this->chat;
    }

    /**
     * @param mixed $chat
     */
    public function setChat(Chat $chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getSender() : User
    {
        return $this->sender;
    }

    /**
     * @param mixed $user
     */
    public function setSender(User $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * @param mixed $dated
     */
    public function setDated($dated): void
    {
        $this->dated = $dated;
    }

}
?>