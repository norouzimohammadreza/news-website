<?php 
namespace Auth;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Auth{
    protected function redirect($url)
    {
        header('Location:' . trim(CURRENT_DOMAIN, '/') . '/' . trim($url, '/'));
        exit;
    }
    protected function redirectBack()
    {
        header('Location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    private function hash($password){
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
    }
    private function sendMail($email,$subject,$body){
         //Create an instance; passing `true` enables exceptions
         $mail = new PHPMailer(true);

         try {
             //Server settings
             $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
             $mail->CharSet = "UTF-8"; //Enable verbose debug output
             $mail->isSMTP(); //Send using SMTP
             $mail->Host = MAIL_HOST; //Set the SMTP server to send through
             $mail->SMTPAuth = SMTP_AUTH; //Enable SMTP authentication
             $mail->Username = MAIL_USERNAME; //SMTP username
             $mail->Password = MAIL_PASSWORD; //SMTP password
             $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
             $mail->Port = MAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 
             //Recipients
             $mail->setFrom(SENDER_MAIL, SENDER_NAME);
             $mail->addAddress($email);    
 
 
             //Content
             $mail->isHTML(true); //Set email format to HTML
             $mail->Subject = $subject;
             $mail->Body = $body;
 
             $result = $mail->send();
             echo 'Message has been sent';
             return $result;
         } catch (Exception $e) {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
             return false;
         }
 
 
    }
}