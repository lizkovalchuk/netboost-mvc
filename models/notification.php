<?php

class Notification
{
    private $notificationId;
    private $notifyEvent;
    private $createdDate;
    private $notifiedUserId;
    private $seenStatus;

    /**
     * @return mixed
     */
    public function getNotificationId() : int
    {
        return $this->notificationId;
    }

    /**
     * @param mixed $notificationId
     */
    public function setNotificationId(int $notificationId): void
    {
        $this->notificationId = $notificationId;
    }

    /**
     * @return mixed
     */
    public function getNotifyEvent()
    {
        return $this->notifyEvent;
    }

    /**
     * @param mixed $notifyEvent
     */
    public function setNotifyEvent($notifyEvent): void
    {
        $this->notifyEvent = $notifyEvent;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getNotifiedUserId()
    {
        return $this->notifiedUserId;
    }

    /**
     * @param mixed $notifiedUser
     */
    public function setNotifiedUserId($notifiedUserId): void
    {
        $this->notifiedUser = $notifiedUserId;
    }

    /**
     * @return mixed
     */
    public function getSeenStatus() : bool
    {
        return $this->seenStatus;
    }

    /**
     * @param mixed $seenStatus
     */
    public function setSeenStatus($seenStatus): void
    {
        $this->seenStatus = $seenStatus;
    }


}