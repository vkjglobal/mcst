<?php
session_start();
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if (isset($_POST['Publish'])) {
    // Retrieve form data
    // $user_id = isset($_POST['user_id']);
    $user_id = $_SESSION['uid'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Validate title
    if (empty($title)) {
        $_SESSION['form_error'] = 'Title is required.';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Validate featured image
    if (!isset($_FILES['featured_image']['name']) || empty($_FILES['featured_image']['name'])) {
        $_SESSION['form_error'] = 'Featured image is required.';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    $allowed_image_extensions = array('jpg', 'jpeg', 'png'); // Add more if needed
    $uploaded_image_extension = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($uploaded_image_extension), $allowed_image_extensions)) {
        $_SESSION['form_error'] = 'Invalid featured image type. Please upload a valid image (JPEG, JPG, PNG).';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Validate description
    if (empty($description)) {
        $_SESSION['form_error'] = 'Description is required.';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Validate file upload
    if (!isset($_FILES['file_upload']['name']) || empty($_FILES['file_upload']['name'])) {
        $_SESSION['form_error'] = 'File upload is required.';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Check file type
    $allowed_file_extensions = array('pdf'); // Add more if needed
    $uploaded_file_extension = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($uploaded_file_extension), $allowed_file_extensions)) {
        $_SESSION['form_error'] = 'Invalid file type. Please upload a PDF file.';
        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Check for file upload errors
    if ($_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['form_error'] = 'File upload failed.';

        // Append error details if available
        $_SESSION['form_error'] .= ' Error code: ' . $_FILES['file_upload']['error'];

        $_SESSION['form_data'] = $_POST; // Store form data in session
        header("Location: new-post.php");
        exit();
    }

    // Image Upload Handling
    $image_upload = $_FILES['featured_image']['name'];
    $image_temp = $_FILES['featured_image']['tmp_name'];
    $image_dest = "uploads/postimages/" . $image_upload;

    
    // Set $image_upload_name to the filename of the uploaded image
    $image_upload_name = basename($image_dest);

    // File Upload Handling
    $file_upload = $_FILES['file_upload']['name'];
    $file_temp = $_FILES['file_upload']['tmp_name'];
    $file_dest = "uploads/postfiles/" . $file_upload;

    // Set $file_upload_name to the filename of the uploaded file
    $file_upload_name = basename($file_dest);


    // Check if the image and file uploads are moved successfully
if (move_uploaded_file($image_temp, $image_dest) && move_uploaded_file($file_temp, $file_dest)) {
    // Insert data into the database
    $sql = "INSERT INTO posts (user_id, Title, Image_upload, Description, file_upload, created_at)
            VALUES (:user_id, :title, :image_upload, :description, :file_upload, NOW())";

    try {
        // Use the $dbh connection from config.php
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image_upload', $image_upload_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':file_upload', $file_upload_name);
        $stmt->execute();

        // Set a session variable to indicate successful database insertion
        $_SESSION['db_insert_success'] = true;
    } catch (PDOException $e) {
        // Set a session variable to indicate database insertion failure
        $_SESSION['db_insert_success'] = false;
        $_SESSION['db_insert_error'] = "Error: " . $e->getMessage();
        echo "Error: " . $e->getMessage() . "<br>";
    }
} else {
    // Set a session variable to indicate file upload failure
    $_SESSION['db_insert_success'] = false;
    $_SESSION['db_insert_error'] = "File upload failed.";
    echo "File upload failed.<br>";
}

    // Clear form data from the session after successful submission
    unset($_SESSION['form_data']);

    // Redirect to user dashboard or any other page
    // header("Location: new-post.php");
    // exit();
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
    <section class="min-vh-100 p-3 dark-blue-bg">
        <div class="container-fluid p-0">
            <div class="row g-3">
                <div class="col-lg-3 dash-sidebar">
                    <div class="orange-bg rounded-2 d-flex flex-column align-items-center p-4 sidebar-container">
                        <div
                            class="d-flex flex-lg-column flex-sm-row flex-column align-items-center justify-content-between w-100">
                            <div class="mb-3 d-flex flex-lg-column align-items-center">
                                <div class="img-wrp text-center mb-2">
                                    <img src="images/avatar-new.png" alt="" class="rounded-circle">
                                </div>
                                <div class="d-flex flex-column align-items-lg-center p-3">
                                    <strong class="white-text">Ken Kalil</strong>
                                    <span class="white-text small">kenkalil@gmail.com</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="button"
                                    class="btn border-2 rounded-pill logout-btn py-1 text-uppercase mb-3" onclick="myfunction()">Logout</button>
                            </div>
                        </div>
                        <ul class="list-group w-100">
                            <li class="dropdown list-group-item list-group-item-action bg-transparent border-0 py-1">
                                <button class="btn btn-secondary border-0 btn-light dropdown-toggle w-100 justify-content-between" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Posts
                                </button>
                                <ul class="dropdown-menu bg-transparent border-0 position-static">
                                    <li class="dark-blue-bg"><a class="dropdown-item active" href="user-dashboard.php">All Posts</a></li>
                                    <li><a class="dropdown-item" href="my-posts.php">My Posts</a></li>
                                    <li><a class="dropdown-item" href="new-post.php">Add Post</a></li>
                                </ul>
                            </li>
                            <li class="dropdown list-group-item list-group-item-action bg-transparent border-0 py-1">
                                <a href="profile-settings.html" class="btn btn-secondary border-0 btn-light justify-content-between">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h4 mb-0">
                                New Post
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4">
                            <form action="" method="POST" enctype="multipart/form-data">
    <div class="col-12">
        <div class="row g-2">
            <div class="col-md-6">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control shadow-none" id="title" name="title" value="<?php echo isset($_SESSION['form_data']['title']) ? htmlspecialchars($_SESSION['form_data']['title']) : ''; ?>">
            </div>

            <div class="col-md-6">
                <label for="featured_image" class="form-label">Featured Image</label>
                <div class="form-control p-0">
                    <input type="file" id="featured_image" class="form-control shadow-none border-0" name="featured_image">
                    <img src="" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
                </div>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" cols="30" rows="4" class="form-control shadow-none" placeholder="Type something..."><?php echo isset($_SESSION['form_data']['description']) ? htmlspecialchars($_SESSION['form_data']['description']) : ''; ?></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label for="file_upload" class="form-label">Upload File</label>
        <div class="form-control p-0">
            <input type="file" id="file_upload" class="form-control shadow-none border-0" name="file_upload">
            <img src="" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="button" class="btn border btn-typ4 px-4" onclick="history.back()">Cancel</button>
        <button type="submit" name="Publish" class="btn border btn-typ4 px-4 ms-2">Publish</button>
    </div>
</form>

<!-- Display error or success messages -->
<?php
if (isset($_SESSION['form_error'])) {
    echo '<div id="errorMessage" class="alert alert-danger mt-3" role="alert">' . $_SESSION['form_error'] . '</div>';
    unset($_SESSION['form_error']);
} elseif (isset($_SESSION['db_insert_success'])) {
    if ($_SESSION['db_insert_success']) {
        echo '<div id="successMessage" class="alert alert-success mt-3" role="alert">Post successfully published!</div>';
    } else {
        echo '<div id="errorMessage" class="alert alert-danger mt-3" role="alert">' . $_SESSION['db_insert_error'] . '</div>';
    }
    unset($_SESSION['db_insert_success']);
    unset($_SESSION['db_insert_error']);
}
?>

<!-- Display error or success messages -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add JavaScript to hide the messages after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById("errorMessage");
            var successMessage = document.getElementById("successMessage");

            if (errorMessage) {
                errorMessage.style.display = "none";
            }

            if (successMessage) {
                successMessage.style.display = "none";
            }
        }, 5000); // 5000 milliseconds (5 seconds)
    });
</script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <?php include_once('dashboard_footer.php'); ?>