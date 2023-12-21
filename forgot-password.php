<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
// Function to send a password reset email
function sendPasswordResetEmail($email, $token) {
    // Your SMTP configuration
    $smtpUsername = 'no-reply@mcst-rmi.org';
    $smtpPassword = 'Reubro@2023';
    $smtpHost = 'mail.mcst-rmi.org';
    $smtpPort = 465;

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = $smtpPort;

        // Recipients
        $mail->setFrom('no-reply@mcst-rmi.org', 'mcst');

        // Add a recipient
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        // $mail->Body    = 'Click the link below to reset your password: <a href="reset-password.php token=' . $token . '">Reset Password</a>';
        $mail->Body = 'Click the link below to reset your password: <a href="https://mcst-rmi.org/reset-password.php?token=' . urlencode($token) . '">Reset Password</a>';

        // Send the email
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}

session_start();
@include 'config.php';

// Initialize the $message variable
$message = '';

// Check if the form is submitted for password reset
if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Set expiration time (e.g., 1 hour from now)
    $expire_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Update the users table with the reset token and its expiration time
    $sql = "UPDATE users SET reset_token = :token, reset_token_expiration = :expire_at WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':token', $token, PDO::PARAM_STR);
    $query->bindParam(':expire_at', $expire_at, PDO::PARAM_STR);
    $query->execute();

    // Check if the update was successful
    if ($query->rowCount() > 0) {
        // Send the password reset email
        $emailSent = sendPasswordResetEmail($email, $token);

        if ($emailSent) {
            $message = 'Email has been sent. Check your inbox for further instructions.';
            $_SESSION['reset_success'] = true;
        } else {
            $message = 'Error sending email. Please try again later.';
            $_SESSION['reset_error'] = true;
        }
    } else {
        $message = 'Invalid email address. Please check your email and try again.';
        $_SESSION['reset_error'] = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user-style.css">
    
</head>

<body>
    <section class="d-flex align-items-center justify-content-center login min-vh-100 py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <form method="POST">
                        <div class="white-bg rounded-4 py-5 px-lg-5 px-sm-4 px-3">
                            <h3 class="text-center mb-4 blue-text"><strong>Forgot Password</strong></h3>
                            <?php
                            if (isset($_SESSION['reset_success']) && $_SESSION['reset_success']) {
                                echo '<div class="alert alert-success mt-3" role="alert">' . $message . '</div>';
                                unset($_SESSION['reset_success']);
                            } elseif (isset($_SESSION['reset_error']) && $_SESSION['reset_error']) {
                                echo '<div class="alert alert-danger mt-3" role="alert">' . $message . '</div>';
                                unset($_SESSION['reset_error']);
                            }
                            ?>
                            <div class="mb-3">
                                <label for="email" class="fw-medium">Email</label>
                                <div class="border-bottom border-2 d-flex align-items-center">
                                    <i class="bi bi-person"></i>
                                    <input type="email" class="form-control border-0 fs-6 shadow-none" id="email" placeholder="Enter Your valid Email Id" name="email"  required value="">
                                </div>
                            </div>
                            <input type="submit" name="forgot_password" value="Send"  class="btn btn-primary btn-login fw-medium border-0 rounded-pill py-3 w-100 mb-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add JavaScript to hide the messages after 5 seconds
            setTimeout(function() {
                var successMessage = document.querySelector('.alert-success');
                var errorMessage = document.querySelector('.alert-danger');

                if (successMessage) {
                    successMessage.style.display = "none";
                }

                if (errorMessage) {
                    errorMessage.style.display = "none";
                }
            }, 5000); // 5000 milliseconds (5 seconds)
        });
    </script>
</body>

</html>