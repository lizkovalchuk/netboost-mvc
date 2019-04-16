<?php
require_once 'user.php';
require_once 'notification.php';

class Notification_DB extends Model
{
    public function getUnreadNotificationsForUser(int $userId) : array {
        $query = "SELECT * FROM notifications WHERE user_id = :userId AND seen = 0";
        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":userId", $userId, PDO::PARAM_INT);
        $pdostm->execute();

        $notificationsDB = $pdostm->fetchAll(PDO::FETCH_OBJ);

        $notifications = array();
        foreach ($notificationsDB as $n) {
            $notification = new Notification();
            $notification->setNotificationId($n->id);
            $notification->setNotifyEvent($n->event);
            $notification->setCreatedDate($n->created_date);
            $notification->setNotifiedUserId($n->user_id);
            $notification->setSeenStatus($n->seen);

            array_push($notifications, $notification);
        }

        return $notifications;
    }

    public function clearRequestNotificationsForUser(int $userId) : bool {
        $query = 'UPDATE notifications SET seen = 1 WHERE user_id = :userId AND event = "new_project_request"';

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":userId", $userId, PDO::PARAM_INT);

        $pdostm->execute();

        return $pdostm->rowCount() > 0;
    }

    public function clearMessageNotificationsForUser(int $userId) : bool {
        $query = 'UPDATE notifications SET seen = 1 WHERE user_id = :userId AND event = "new_message"';

        $pdostm = $this->db->prepare($query);
        $pdostm->bindValue(":userId", $userId, PDO::PARAM_INT);

        $pdostm->execute();

        return $pdostm->rowCount() > 0;
    }
}