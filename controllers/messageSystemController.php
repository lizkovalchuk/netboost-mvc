<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/user.php';
require_once 'models/user_DB.php';
require_once 'models/chat.php';
require_once 'models/chat_DB.php';
require_once 'models/message.php';
require_once 'models/company.php';
require_once 'models/company_DB.php';
require_once 'models/message_DB.php';
require_once 'models/notification_DB.php';
require_once 'models/notification.php';

class messageSystemController extends Controller
{
    private $notificationDB;

    public function __construct()
    {
        parent::__construct();
        $this->notificationDB = new Notification_DB();
    }

    // ========= READ ALL CHATS FOR THE USER LOGGED IN ==================

    public function index()
    {
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['teacher','company']])){
            return;
        }
        $chat_DB = new Chat_DB();

        $chatDetails = $chat_DB->getChatsByUserId($_SESSION['userId']);

        if(isset($_SESSION['notifications']) && count($_SESSION['notifications']['messageNotifications']) > 0) {
            $this->notificationDB->clearMessageNotificationsForUser((int)$_SESSION['userId']);
            $_SESSION['notifications']['messageNotifications'] = array();
        }

        //var_dump($chatDetails);
        $this->View->chats = $chatDetails;
        $this->View->render('messages/index', 'dashboard');
    }

    // ========= READ ALL MESSAGES OF A PARTICULAR CHAT ==================

    public function messages()
    {
        $chat_DB = new Chat_DB();

        $chatId = (int)$_POST['chatId'];
        $messageDetails = $chat_DB->getAllMessagesForChat($chatId);
        //var_dump($messageDetails);

        $this->View->chats = $messageDetails;
        $this->View->render('messages/viewMessages', 'dashboard');


    }

    // ========= AND ADD MESSAGE TO AN EXISTING CHAT ==================

    public function addMsgtoChat()
    {

        $message_DB = new Message_DB();

        if (isset($_POST['addNewMessage'])) {
            $message = new Message();
            $chat = new Chat();
            $sender = new User();
            $sender->setId($_SESSION['userId']);
            $chat->setId($_POST['chatId']);
            $message->setBody($_POST['messageBody']); // set body from the input received
            $message->setChat($chat);
            $message->setSender($sender);

            $newMessage = $message_DB->addMsgToExistingChat($message);
            $this->messages();
            return;
        }

    }

    // ========= CREATING A NEW CHAT ==================

    public function createChat()
    {
        $chatDB = new Chat_DB();
        $recipients = $chatDB->getAllRecipientsForChat();
        $this->View->recipients = $recipients;

        $this->View->render('messages/createNewChat', 'dashboard');
    }

    // ========= GET NEW CHAT SUBJECT, MESSAGE AND ADD IT TO MESSAGE, CHAT_MEMBERS TABLE ==================

    public function sendNewMessage() {

            $subject = $_POST['newMsgSubject'];
            $recipientSelectedId = (int)$_POST['recipientSelected'];
            $senderId = $_SESSION['userId'];
            $messageDB = new Message_DB();
            $chatDB = new Chat_DB();

            $chatMembers = array();

            array_push($chatMembers, $recipientSelectedId);
            array_push($chatMembers, $senderId);
            $newChatId = $chatDB->addNewChat($subject,$chatMembers); // returns new chat Id

            $message = new Message();
            $chat = new Chat();

            $chat->setId($newChatId);

            $message->setBody($_POST['newChatMsg']);
            $sender = new User();
            $sender->setId($_SESSION['userId']);
            $message->setSender($sender);
            $message->setChat($chat);

            $messageDB->addMsgToExistingChat($message);
            $this->index();
    }

    //========= CREATE CHAT WITH KNOWN RECIPIENT ==================

    public function newChatKnownRecipient($recipientId = null) {

        $companyDB = new Company_DB();

        $company = $companyDB->getCompanyByUserId($recipientId);
        $this->View->recipientId = $recipientId;
        $this->View->recipient = $company;
        $this->View->render('messages/newChatForKnownRecipient', 'dashboard');

    }
}
