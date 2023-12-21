<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

     // Verify the reCAPTCHA
   //  $recaptchaSecretKey = '6Ld3rdsoAAAAAOtna5M8ixHozuUIOrmEMQ0zLbih';
   //  $recaptchaResponse = $_POST['g-recaptcha-response'];
   //  $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    // $recaptchaData = json_decode($recaptchaVerify);
    
    // if ($recaptchaData->success) 
   //  {

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Set up the SMTP server
        $mail->isSMTP();
        $mail->Host = 'mail.mcst-rmi.org';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@mcst-rmi.org';
        $mail->Password = 'Reubro@2023';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sender and recipient email addresses
        $mail->setFrom('no-reply@mcst-rmi.org', 'mcst'); // Replace 'Your Name' with your name
        //$mail->addAddress('ammudevika1999@gmail.com'); // Replace with your email address
                $mail->addAddress('projects@vkjglobal.com'); // Replace with your email address

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Us Message Received  from ' . $name;
        $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";

        // Send the email
        $mail->send();
        // Redirect back to contact-us.php with a success message
        header('Location: contact-us.php?success=1');
        exit();
        // echo 'Message has been sent';
    } catch (Exception $e) 
    {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // Redirect back to contact-us.php with an error message
        header('Location: contact-us.php?error=' . urlencode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
        exit();
    }
}
/*
else {
    // echo "reCAPTCHA verification failed";
     // Redirect back to contact-us.php with a reCAPTCHA error message
     header('Location: contact-us.php?error=' . urlencode("reCAPTCHA verification failed"));
     exit();
}*/
//}
?>
