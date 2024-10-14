<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerService
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->isSMTP();                                             
        $this->mail->Host       = 'smtp.gmail.com';    // Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mail->Username   = 'ggzane14@gmail.com';                 // SMTP username
        $this->mail->Password   = 'ahdieigihscsuqmx';                    // SMTP password (use App Password if 2FA is enabled)
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $this->mail->Port       = 587;                                    // TCP port to connect to
        $this->mail->setFrom('ggzane14@gmail.com', 'Magma');        // Set your from email address and name
    }

    // Function to send email
    public function sendEmail($to, $subject, $body)
    {
        try {
            //Recipients
            $this->mail->addAddress($to);     // Add recipient email address

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
