<?php
session_start();
if(!isset($_SESSION['login'])){
?>
	<script>
    window.location="index.php"    </script>
    <?php
}
@include 'config.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    $sql = "SELECT _id,email,Passwor FROM users WHERE email=:email and Passwor=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        

        $_SESSION['login'] = $_POST['email'];
        echo "<script type='text/javascript'> document.location = 'user-dashboard.php'; </script>";
    } else {
       $error = "Invalid email or password.";
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
                            <h3 class="text-center mb-4 blue-text"><strong>User Login</strong></h3>
                            <div class="mb-3">
                                <label for="email" class="fw-medium">Username</label>
                                <div class="border-bottom border-2 d-flex align-items-center">
                                    <i class="bi bi-person"></i>
                                    <input type="email" class="form-control border-0 fs-6 shadow-none" id="email" placeholder="Type your username" name="email"  required value="">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="fw-medium">Password</label>
                                <div class="border-bottom border-2 d-flex align-items-center">
                                    <i class="bi bi-key"></i>
                                    <input type="password" class="form-control border-0 fs-6 shadow-none" id="password" placeholder="Type your password" name="password" required value="">
                                </div>
                            </div>
                             <!-- Display error message if login fails -->
            

            <?php if (isset($error)){ ?>
    <div class="alert alert-danger" id="error-message">
        <center><?php echo $error; ?></center>
    </div>
<?php } ?>
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <a href="forgot-password.php" class="fw-light text-decoration-none text-reset">Forgot Password?</a>
                            </div>
                            <input type="submit" name="login" value="Login"  class="btn btn-primary btn-login fw-medium border-0 rounded-pill py-3 w-100 mb-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
    <script>
    // Check if the error message is displayed, and then set a timeout to hide it
    var errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.display = 'none';
        }, 2000); // Hide the message after 5000 milliseconds (5 seconds)
    }
</script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    </script>
</body>

</html>