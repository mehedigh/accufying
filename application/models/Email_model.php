<?php
class Email_model extends CI_Model {

    function send($email_to, $subject, $message, $email_myself=''){
        
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $this->settings->mail_username;
        $mail->Password = base64_decode($this->settings->mail_password);
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom($this->settings->admin_email, $this->settings->site_name);
        $mail->addReplyTo('no-reply@gmail.com', $this->settings->site_name);
        
        // Add a recipient
        $mail->addAddress($email_to);
        
        // Add cc or bcc 
        if (!empty($email_myself)) {
            $mail->addCC($email_myself);
        }
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;
        
        // Send email

        if(!$mail->send()){
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
            
        }else{
            //echo 'Message has been sent';
            return true;
        }
    }

    function send_email($email_to, $subject='', $message=''){
        
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'codericks.envato@gmail.com';
        $mail->Password = 'm3h3dI9222#';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('codericks.envato@gmail.com', 'Codericks');
        $mail->addReplyTo('no-reply.codericks@gmail.com', 'Codericks');
        
        // Add a recipient
        $mail->addAddress($email_to);
        
        // Email subject
        $mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;

        // Send email
        if(!$mail->send()){
            
        }else{
            
        }
        
    }

}