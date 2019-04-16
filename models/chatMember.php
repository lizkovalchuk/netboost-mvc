<?php
/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-04-23
 * Time: 11:33 AM
 */

class ChatMember
{

    private $userId;
    private $name;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}