<?php

/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-04-20
 * Time: 2:39 PM
 */
require_once 'user.php';
require_once 'message.php';

class Chat
{

    private $id;
    private $subject;
    private $dateCreated;
    private $lastMessage;
    private $user;
    private $message;

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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $name
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getLastMessage() : Message
    {
        return $this->lastMessage;
    }

    /**
     * @param mixed $lastMessage
     */
    public function setLastMessage(Message $lastMessage): void
    {
        $this->lastMessage = $lastMessage;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getMessage() : Message
    {
        return $this->message;
    }

    /**
     * @param mixed $user
     */
    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }


}