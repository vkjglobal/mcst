<?php
// Set error reporting for debugging purposes
include_once 'includes/header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection (config.php)
include 'config.php';

if (isset($_POST['submit'])) {
    $fname = trim($_POST['first_name']);
    $lname = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $passwor = $_POST['passwor']; // Corrected variable name
    $cpassword = $_POST['cpassword'];
    $user = $_POST['user'];

    // Check if the email already exists in the database
    $sql_check_email = "SELECT email FROM users WHERE email = :email";
    $query_check_email = $dbh->prepare($sql_check_email);
    $query_check_email->bindParam(':email', $email, PDO::PARAM_STR);
    $query_check_email->execute();
    $existingEmail = $query_check_email->fetchColumn();

    if ($existingEmail) {
        $error = "Email already exists, Please use a different email...!";
    } else {
        // Password validation and hashing
        if ($passwor !== $cpassword) {
            $error = "Password and confirm password do not match.";
        } else {
            $hashedPassword = md5($passwor);
        }

        if (!isset($error)) {
            // Insert the new user into the database
            $sql = "INSERT INTO users (first_name, last_name, email, passwor, user_role) VALUES (:fname, :lname, :email, :passwor, :user)";
            
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':passwor', $hashedPassword, PDO::PARAM_STR);
            $query->bindParam(':user', $user, PDO::PARAM_STR);
            
            // Execute the query
            $query->execute();

            // Display a success message and redirect
            echo '<div id="successMEssage" class="alert alert-success"><center>Data updated successfully.</center></div>';
          
          //  echo "<script type='text/javascript'> document.location = 'user-list.php'; </script>";
         //  header('refresh:2;url=user-list.php'); // Redirect to dashboard after 2 seconds
        }
    }
}

?>
<!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <form method="post" id="myForm" action=''>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger" id="error-message">
                                    <center><?php echo $error; ?></center>
                                </div>
                            <?php endif; ?>

                                <script>
                                    // Check if the error message is displayed, and then set a timeout to hide it
                                    var errorMessage = document.getElementById('error-message');
                                    if (errorMessage) {
                                        setTimeout(function() {
                                            errorMessage.style.display = 'none';
                                        }, 2000); // Hide the message after 5000 milliseconds (5 seconds)
                                    }
                                    var successM = document.getElementById('successMEssage');
                                    if (successM) {
                                        setTimeout(function() {
                                            successMEssage.style.display = 'none';
                                            window.location.href = 'user-list.php'; 
                                        }, 2000); // Hide the message after 5000 milliseconds (5 seconds)
                                    }
                                </script>
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Add User</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3" method="post">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border" name="first_name" id="first_name" value="" required></div>
                                            <div class="col-12 mb-3" method="post"><label>Last Name</label>
                                            <input type="text" value=""  class="form-control border" name="last_name" id="last_name" required></div>
                                            <div class="col-12 mb-3" method="post"><label>Email</label>
                                            <input type="email" class="form-control border"  name="email" id="email" value=" " required></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3"><label>Password</label><input type="password"
                                                    class="form-control border" name="passwor" id="passwor" required></div>
                                            <div class="col-12 mb-3"><label>Confirm Password</label><input
                                                    type="password" class="form-control border" name="cpassword" required></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Status</label>
                                                <select class="form-control border" name="user" id="user">
                                                    <option value="">Select</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user" selected>User</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function redirectToAnotherPage() {
        
                                        window.location.href = "user-list.php"; 
                                    }
                                </script>
                                
                                    <div class="col-12 d-flex"><button type="submit" name="submit" value=""
                                            class="btn btn-primary btn-typ4">SAVE</button>
                                            <button type="reset" value="Clear" onclick="redirectToAnotherPage()"  class="btn btn-primary btn-typ3 ms-2">CANCEL</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- User List End -->
            </div>
            <?php  include_once 'includes/footer.php';   ?> 
</body>

</html>