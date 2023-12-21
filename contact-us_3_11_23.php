<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('includes/dbConnect.php');
    if (isset($_POST['submit']))
     {
    // Verify the reCAPTCHA
  /*  $recaptchaSecretKey = '6Ld3rdsoAAAAAOtna5M8ixHozuUIOrmEMQ0zLbih';
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $recaptchaData = json_decode($recaptchaVerify);

    if ($recaptchaData->success) 
    {
    */
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
    
        // Insert the data into the 'contact' table
        $sql = "INSERT INTO contact (name,email,message) VALUES (:name,:email,:message)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute(); 
        
  /*  }
    else{
        $errorMessage = "reCAPTCHA verification failed";
    } */
}
include_once('includes/header.php');
include_once('send_email.php')
 
?>
<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
  
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
                    <form action="send_email.php" method="POST" onsubmit="return validateForm()">
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
    <!-- Add the reCAPTCHA widget here -->
  <!--  <div class="g-recaptcha" data-sitekey="6Ld3rdsoAAAAAFUT4l1pnuSRRROx8_sJIg_FG2tf"></div> -->
    <!-- End of reCAPTCHA widget -->
    <div class="row g-3">
       <!-- <div class="col-sm-8 d-flex align-items-center">
            <input id="contact-us-check" type="checkbox" required>
            <label for="contact-us-check">I agree to the data usage rules</label>
        </div> -->
        <div class="col-sm-4">
            <button type="submit" id="submit" name="submit" class="btn more-btn more-btn-blue pill me-sm-0 ms-sm-auto mx-auto">Send</button>
        </div>
    </div> 
    <?php
// Check for success message
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success"><center>Message has been sent successfully.</center></div>';
    echo '<script>
        // Remove success message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            var successMessage = document.querySelector(".alert-success");
            if (successMessage) {
                successMessage.style.display = "none";
            }
        }, 3000);
    </script>';
} elseif (isset($_GET['error'])) {
    $errorMessage = urldecode($_GET['error']);
    echo '<div class="alert alert-danger"><center>' . $errorMessage . '</center></div>';
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
</body>

</html>