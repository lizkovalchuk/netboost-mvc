<?php

class NotificationEvents
{
    const NEW_PROJECT_REQ = "new_project_request";
    const NEW_MESSAGE = "new_message";

    private $notifications = array();

    function addNotification($key, $value) {
        $this->notifications[$key] = $value;
    }
}