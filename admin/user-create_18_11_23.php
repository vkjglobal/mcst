<?php
// Set error reporting for debugging purposes
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
            echo '<div class="alert alert-success"><center>Data updated successfully.</center></div>';
            header('refresh:2;url=user-list.php'); // Redirect to dashboard after 2 seconds
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MCST</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <script>
        function clearForm() {
            document.getElementById("myForm").reset();

        }
    </script>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar border-end pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index1.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary admin-logo-wrp mb-0">
                        <img src="img/logo.png" alt="" class="img-fluid d-lg-block d-none">
                        <img src="img/logo-mobile.png" alt="" class="img-fluid d-lg-none d-block">
                    </h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index1.php" class="nav-item nav-link active">Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user-list.php" class="dropdown-item">List</a>
                            <a href="user-create.php" class="dropdown-item">Add User</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Menus</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="menu.php" class="dropdown-item">List</a>
                            <a href="menuadd.php" class="dropdown-item">Add Menu</a>
                        </div>
                        </div>

                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">CMS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="cmslist.php" class="dropdown-item">List</a>
                            <a href="cmsadd.php" class="dropdown-item">Add CMS</a>
                        </div>
                        </div>
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Projects</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="project_list.php" class="dropdown-item">List</a>
                            <a href="projectadd.php" class="dropdown-item">Add Project</a>
                        </div>
                        </div>
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Partner</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="partner-list.php" class="dropdown-item">List</a>
                            <a href="partneradd.php" class="dropdown-item">Add Partner</a>
                        </div>
                        </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Reference Library</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="category-list.php" class="dropdown-item">Category List</a>
                            <a href="add-category.php" class="dropdown-item">Add Category</a>
                            <a href="librarylist.php" class="dropdown-item">Library List</a>
                            <a href="add-library.php" class="dropdown-item">Add Library</a>
                        </div>
                    </div>
                    <!-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index1.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h3 class="text-primary admin-logo-wrp">
                        <img src="img/logo-mobile.png" alt="">
                    </h3>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!-- <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> -->
                            <span class="d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border rounded py-0 m-0">
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="settings.php" class="dropdown-item">Settings</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


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
</script>
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Add User</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3" method="post">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border" name="first_name" id="first_name" value=" " required></div>
                                            <div class="col-12 mb-3" method="post"><label>Last Name</label>
                                            <input type="text" value=" "  class="form-control border" name="last_name" id="last_name" required></div>
                                            <div class="col-12 mb-3" method="post"><label>Email</label>
                                            <input type="email" class="form-control border"  name="email" id="email" value=" " required></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3"><label>Password</label><input type="password"
                                                    class="form-control border" name="passwor" id="passwor" required></div>
                                            <div class="col-12 mb-3"><label>Confirm Password</label><input
                                                    type="password" class="form-control border" name="cpassword" required="" 
                                                    ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Status</label>
                                                <select class="form-control border" name="user" id="user">
                                                    <option value="">Select</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
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
            <!-- Footer Start -->
            <div class="container-fluid border-top py-2 mt-3 sticky-footer">
                <div class="bg-secondary">
                    <div class="row">
                        <div class="col-12 text-center small">
                            Copyright &copy; 2017 - 2023 Micronesian Center for Sustainable Transport (MCST)
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>