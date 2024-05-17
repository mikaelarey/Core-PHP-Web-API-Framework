<?php

namespace Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailHelper {

    public function send_mail($recipient_email, $recipient_name, $subject, $template, $contents) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'urs.deanslister@gmail.com';            // SMTP username
            $mail->Password   = 'dobglcxkmugzaoym';                     // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('your@example.com', 'ELearning Administrator');
            $mail->addAddress($recipient_email, $recipient_name);

            // Attach HTML file
            $mail->isHTML(true);

            // Read HTML file
            $htmlContent = file_get_contents($template);

            // Define dynamic content replacements
            $placeholders = array();

            foreach($contents as $key => $value) {
                $placeholders[$key] = $value;
            }

            // Replace placeholders in HTML content
            $htmlContent = $this->replace_placeholders($htmlContent, $placeholders);

            $mail->Subject = $subject;
            $mail->Body    = $htmlContent;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Function to replace placeholders in the HTML content
    private function replace_placeholders($content, $placeholders) {
        foreach ($placeholders as $key => $value) {
            $content = str_replace("{{{$key}}}", $value, $content);
        }
        
        return $content;
    }
}

?>