<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $message;
    private $subject;
    private $to_email;
    private $to_username;

    public function __construct($message, $subject, $to_email, $to_username = '')
    {
        $this->message     = $message;
        $this->subject     = $subject;
        $this->to_email    = $to_email;
        $this->to_username = $to_username;
    }

    public function send()
    {
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->isSMTP();                                                     // Send using SMTP
            $mail->Host        = $_ENV['SMTP_HOST'];         // Set the SMTP server to send through
            $mail->SMTPAuth    = true;                                // Enable SMTP authentication
            $mail->Username    = $_ENV['SMTP_EMAIL'];                              // SMTP username
            $mail->Password    = $_ENV['SMTP_EMAIL_PASSWORD'];                     // SMTP password
            $mail->SMTPSecure  = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port        = $_ENV['SMTP_PORT'];        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            $mail->setFrom($_ENV['SMTP_EMAIL'], $_ENV['SMTP_EMAIL_FROM_NAME']);
            $mail->addAddress($this->to_email, $this->to_username);             // Add a recipient
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // $mail->addAttachment('/var/tmp/file.tar.gz');                    // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');                 // Optional name

            $mail->isHTML(true);                                       // Set email format to HTML
            $mail->CharSet     = 'UTF-8';
            $mail->Subject     = $this->subject;
            $mail->Body        = $this->message;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
