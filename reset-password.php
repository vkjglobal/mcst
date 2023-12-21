<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
@include 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // echo "Token: $token";

    // Validate and sanitize user input
    $token = filter_var($token, FILTER_DEFAULT);

    // Check if the token is valid and not expired
    $current_time = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM users WHERE reset_token = :token AND reset_token_expiration > :current_time";
    $query = $dbh->prepare($sql);
    $query->bindParam(':token', $token, PDO::PARAM_STR);
    $query->bindParam(':current_time', $current_time, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Token is valid, allow the user to reset their password
        if (isset($_POST['reset_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password == $confirm_password) {
                // Validate and sanitize user input
                $new_password = filter_var($new_password, FILTER_DEFAULT);

                // Update the user's password
                // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $hashed_password = md5($new_password);
                $sql = "UPDATE users SET passwor = :password, reset_token = NULL, reset_token_expiration = NULL WHERE reset_token = :token";
                $query = $dbh->prepare($sql);
                $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $query->bindParam(':token', $token, PDO::PARAM_STR);
                $query->execute();

                if ($query->rowCount() > 0) {
                    $_SESSION['reset_success'] = true;
                    $message = 'Password reset successfully. You can now login with your new password.' ;
                } else {
                    $_SESSION['reset_error'] = true;
                    $message = 'Error updating password. Please try again later.';
                }
            } else {
                $_SESSION['reset_error'] = true;
                $message = 'Passwords do not match. Please make sure your passwords match.';
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
                            <h3 class="text-center mb-4 blue-text"><strong>Reset Password</strong></h3>
                            <?php
                            if (isset($_SESSION['reset_success']) && $_SESSION['reset_success']) {
                                echo '<div class="alert alert-success mt-3" role="alert">' . htmlspecialchars($message) . '</div>';
                                unset($_SESSION['reset_success']);
                            } elseif (isset($_SESSION['reset_error']) && $_SESSION['reset_error']) {
                                echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($message) . '</div>';
                                unset($_SESSION['reset_error']);
                            }
                            ?>
                            <label for="new_password" class="fw-medium">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>

                <label for="confirm_password" class="fw-medium">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>

                <input type="submit" name="reset_password" value="Reset Password" class="btn btn-primary btn-login fw-medium border-0 rounded-pill py-3 w-100 mt-3">
                            
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
</body>

</html>
        <?php
    } else {
        echo 'Invalid or expired token. Please try the password reset process again.';
    }
} else {
    echo 'Invalid token. Please try the password reset process again.';
}
?>
