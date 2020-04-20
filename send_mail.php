<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // mb_language("Japanese");
    // mb_internal_encoding("UTF-8");

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.kobe-u.ac.jp';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'XXXXXXXXX@obe-u.ac.jp';                     // SMTP username
        $mail->Password   = 'XXXXXXXXX';                               // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail ->SMTPSecure = 'ssl';
        $mail->Port       = 465;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('XXXXXX@kobe-u.ac.jp', 'Recipient Name');
        $mail->addAddress('XXXXXXXX@gmail.com');     // Add a recipient
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the plain text message';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();

        // echo('<pre>');
        // var_dump( $mail );
        // echo('</pre>');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>