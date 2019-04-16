<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

class EmailHelper
{
    private static $EMAILID = 'netboostinc@gmail.com';
    private static $PASSWORD = 'phpfinalproject2018';

    public static function sendResetPasswordEmail(string $emailId, string $passwordResetToken) {

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EmailHelper::$EMAILID;
            $mail->Password = EmailHelper::$PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom(EmailHelper::$EMAILID, 'NETBOOST');
            $mail->addAddress($emailId, 'User');
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Link';
            $mail->Body    = 'Please click on the given link to reset your password : <a href="https://netboost.ca/login/resetPasswordLink/'.$passwordResetToken.'">Reset</a>';
            $mail->AltBody = 'Please click on the given link to reset your password : <a href="https://netboost.ca/login/resetPasswordLink/'.$passwordResetToken.'">Reset</a>';

            return $mail->send();

        } catch (Exception $e) {
            return false;
        }
    }
}