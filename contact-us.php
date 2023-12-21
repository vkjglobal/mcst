
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once('includes/dbConnect.php');
include_once('includes/header.php');
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert the data into the 'contact' table
    // $sql = "INSERT INTO contact (name,email,message) VALUES (:name,:email,:message)";
    $sql = "INSERT INTO contact (name, email, message, Date) VALUES (:name, :email, :message, NOW())";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->execute();

    if (isset($_POST['g-recaptcha-response'])) {
        // Check if the reCAPTCHA response is empty or invalid
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $key = '6LfPzucoAAAAAPmMmvK8ajKwNB1c4xg6Vshm7osg'; // Replace with your actual reCAPTCHA secret key
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        // RECAPTCHA RESPONSE
        $recaptcha_response = file_get_contents($url . '?secret=' . $key . '&response=' . $captcha . '&remoteip=' . $ip);
        $data = json_decode($recaptcha_response);

        if (!isset($data->success) || !$data->success) {
            // reCAPTCHA verification failed, show an error message to the user
            $message = 'reCAPTCHA verification failed. Please complete the reCAPTCHA to submit the form.';
        } else {
            // reCAPTCHA verification passed, proceed with sending the email
            require 'vendor/phpmailer/phpmailer/src/Exception.php';
            require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require 'vendor/phpmailer/phpmailer/src/SMTP.php';
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'mail.mcst-rmi.org';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@mcst-rmi.org';
            $mail->Password = 'Reubro@2023';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Sender and recipient email addresses
            $mail->setFrom('no-reply@mcst-rmi.org', 'mcst');
            $mail->addAddress('info@mcst-rmi.org', 'MCST');
            $mail->Subject = 'Contact Request Received from ' . $name;

            $mail->isHTML(true);
            $mail->Body = "<h2>Contact Request Received </h2>
                  <p><strong>Name:</strong> $name</p>
                  <p><strong>Email:</strong> $email</p>
                  <p><strong>Message:</strong> $message</p>";

            // Initialize the message variable
            $message = '';

            // Send the email
            if ($mail->send()) {
                $message = 'Message has been sent successfully.';
            } else {
                $message = 'Error: ' . $mail->ErrorInfo;
            }
        }
    }
}
?>
 
    <section class="contact-us-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <h2 class="hd-typ1 text-left mb-lg-5 mb-4">Keep in Touch with Us</h2>
            <div class="row">
                <div class="col-lg-6 order-lg-0 order-1">
                    <ul class="contact-info">
                        <li class="d-flex flex-column mb-4 address-info">
                            <strong class="mb-3">Meet Us</strong>
                            <address class="mb-0"> MCST, The College of the Marshall Islands, <br>
                            College of the Marshall 
Ocean View 1258,<br>
Majuro MH, 96960</address>
                        </li>
                        <li class="d-flex flex-column mb-4 bypost-info">
                            <strong class="mb-3">By Post</strong>
                            <address class="mb-0">PO Box 1258, Majuro, <br> Republic of the Marshall Islands, 96960</address>
                        </li>
                        <li class="d-flex flex-column mb-4 phone-info">
                            <strong>Phone</strong>
                            <span class="mb-3">Need more information? Please call us now on:</span>
                            
                            <a href="tel:+(692) 625-3394">+(692) 625-3394 (Ext. 359 or 376)</a>
                        </li>
                        <li class="d-flex flex-column mail-info">
                            <strong>Email</strong>
                            <span class="mb-3">Have a question? Please send us an email on:</span>
                            
                            <a href="mailto:info@mcst-rmi.org">info@mcst-rmi.org</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 mb-lg-0 mb-5">
                    <form action="contact-us.php" method="POST" onsubmit="return validateForm()">
    <div class="form-group mb-md-5 mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control px-0" name="name" id="name" required>
        <span id="name-warning" class="text-danger"></span>
    </div>
    <div class="form-group mb-md-5 mb-3">
        <label for="email">Email</label>
        <input type="text" class="form-control px-0" name="email" id="email" required>
        <span id="email-warning" class="text-danger"></span>
    </div>
    <div class="form-group mb-md-5 mb-4">
        <label for="message">Message</label>
        <textarea class="form-control px-0" name="message" id="message" cols="30" rows="4" required></textarea>
    </div>
    <div class="row g-3">
        <div class="col-sm-8 d-flex align-items-center">
            <input id="contact-us-check" type="checkbox" required>
            <label for="contact-us-check">I agree to the data usage rules</label>
        </div>
        <div class="g-recaptcha" data-sitekey="6LfPzucoAAAAAF8E3DtVbF7wowHGtAkqf8g_ILgd" required></div>
        <div class="col-sm-4">
            <button type="submit" id="submit" name="submit" class="btn more-btn more-btn-blue pill me-sm-0 ms-sm-auto mx-auto">Send</button>
        </div>
    </div><br><br>
    <!-- <div id="message-box" class="alert <?php echo (strpos($message, 'Error') !== false) ? 'alert-danger' : 'alert-success'; ?>">
    <center><?php echo $message; ?></center> -->
    <?php
    if (isset($message)) {
    echo '<div class="alert ' . (strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success') . '">';
    echo '<center>' . $message . '</center>';
    echo '</div>';
    echo '<script>
    // Function to hide the message after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        var messageBox = document.querySelector(".alert");
        if (messageBox) {
            messageBox.style.display = "none";
        }
    }, 5000);
    </script>';
}
?>
    
</form>
<script>
        // Function to validate email address
        function validateEmail() {
            var email = document.getElementById("email").value;
            var emailWarning = document.getElementById("email-warning");

            // Regular expression for basic email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                emailWarning.innerHTML = "Invalid email address";
                return false;
            } else {
                emailWarning.innerHTML = "";
                return true;
            }
        }
        function validateName() {
        var name = document.getElementById("name").value;
        var nameWarning = document.getElementById("name-warning");

        // Regular expression to check if the name contains any numbers
        var namePattern = /\d/;

        if (namePattern.test(name)) {
            nameWarning.innerHTML = "Name should not contain numbers";
            return false;
        } else {
            nameWarning.innerHTML = "";
            return true;
        }
    }

        // Add an event listener to trigger email validation when leaving the input field
        var emailInput = document.getElementById("email");
        var nameInput = document.getElementById("name");
        emailInput.addEventListener("blur", validateEmail);
        nameInput.addEventListener("blur", validateName);
        function validateForm() {
        var isNameValid = validateName();
        var isEmailValid = validateEmail();

return isEmailValid && isNameValid;
    }
    </script>


                </div>
            </div>
        </div>
    </section>
   <?php include_once('includes/footer.php'); ?>
    <script>
        $(document).ready(function () {
            $('.home-banner').owlCarousel({
                loop: false,
                autoplay: false,
                mouseDrag: false,
                nav: false,
                dots: false,
                items: 1,
                smartSpeed: 450
            });
        })
    </script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>