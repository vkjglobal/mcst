<?php
@include 'config.php'; // Include your PDO database connection file


try {
    // Fetch distinct options from the "menu" table
    $query = "SELECT * FROM categories where `parent__-` ='parent'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    $content1=$_POST['content1'];
    $content2=$_POST['content2'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $hot = isset($_POST['hot']) ? true : false;
    $created_date = date('Y-m-d H:i:s');
    $download='0';
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $filesize = $_FILES['image']['size'];
    if (!empty($file_name)) {
        // Upload directory
        $upload_dir = 'uploads/';

        // Check if the upload directory exists; if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $uploadError = $_FILES['image']['error'];
        if ($uploadError !== UPLOAD_ERR_OK) {
            // Handle the upload error
            echo "Upload failed with error code: $uploadError";
        } 
        else {
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
    try {
        $stmt = $dbh->prepare("INSERT INTO libraries (title,short_description,long_description,change_log,author,downloads,file,fileSize,isHot,created_at) VALUES (:title,:content,:content1,:content2,:url,:download,:file_name,:filesize,:hot,:created_date)");
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':content1', $content1);
        $stmt->bindParam(':content2', $content2);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':file_name', $file_name);
        $stmt->bindParam(':filesize', $filesize);
        $stmt->bindParam(':hot', $hot, PDO::PARAM_BOOL);
        $stmt->bindParam(':created_date',$created_date);
        $stmt->bindParam(':download',$download);
        $stmt->execute();
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            echo "Database Error: " . $errorInfo[2];
        }
        
        if ($stmt->rowCount() > 0) {
            echo '<script>';
                echo 'alert("Data Inserted");';
                echo 'window.location.href = "librarylist.php";'; // Change "redirect_page.php" to the desired page
                echo '</script>';
        } else {
            $msg = "Error: No rows inserted";
            echo '<script>';
                echo 'alert("Data Inserted");';
                echo 'window.location.href = "librarylist.php";'; // Change "redirect_page.php" to the desired page
                echo '</script>';
        }

        $uploadError = $_FILES['image']['error'];

        if ($stmt->rowCount() > 0) {
            echo '<script>';
                echo 'alert("Data Inserted");';
                echo 'window.location.href = "librarylist.php";'; // Change "redirect_page.php" to the desired page
                echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("File not Inserted");';
            echo 'window.location.href = "librarylist.php";'; // Change "redirect_page.php" to the desired page
            echo '</script>';
        }
    } catch (PDOException $e) {
        $msg = "Error: " . $e->getMessage();
    }
    

}
 else {
    $msg = "Error uploading the file.";
}}
} else {
$msg = "Please select a file to upload.";
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
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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

            <script>
    function redirectToAnotherPage() {
        // Use window.location.href to redirect to the desired page
        window.location.href = "librarylist.php"; // Replace with the actual page URL
    }
</script>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <!-- Account Settings Start -->
                <div class="container-fluid pt-4 px-4">
        <div class="row border-primary rounded mx-0 p-3">
            <div class="col-12">
                <div class="row" id="editprofile" style="display: flex;">
                    <div class="col-12">
                        <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add Library</strong>
                        <form class="row" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">File</label>
                                <label class="uploadFile form-control">
                                    <span class="filename"></span>
                                    <input type="file" class="inputfile" name="image" id="image">
                                </label>
                            </div>
                            <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Category</label>
                                                <select class="form-control border" name="parent_category_id">
                                                <option value="">Parent</option>
                <?php foreach ($options as $option) { ?>
                    <option value="<?php echo $option['_id'];;?>"><?php echo $option['category']; ?></option>
                <?php } ?>
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            <div class="col-md-6 mb-3">
                                <label for="url">Author</label>
                                <input type="text" class="form-control" id="url" name="url" required>
                            </div>
                            <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="hot" name="hot">
                                    <label class="form-check-label" for="hot">Hot</label>
                                </div>
                            <div class="col-12 mb-3">
                                <label for="content">Short description</label>
                                <textarea id="content" name="content" class="form-control"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="content">Long description</label>
                                <textarea id="content1" name="content1" class="form-control"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="content">Change log</label>
                                <textarea id="content2" name="content2" class="form-control"></textarea>
                            </div>
                            <div class="col-12 d-flex">
                                <button type="submit" name="submit" class="btn btn-primary btn-typ4">Save</button>
                                <button type="button" class="btn btn-primary btn-typ3 ms-2" onclick="redirectToAnotherPage()">Cancel</button>
                            </div>
                                </form>
                            </div>
                            
                        </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ),{
            ckfinder:
            {
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })
        .catch( error => {
            console.error( error );
        });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content1' ),{
            ckfinder:
            {
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })
        .catch( error => {
            console.error( error );
        });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content2' ),{
            ckfinder:
            {
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })
        .catch( error => {
            console.error( error );
        });
</script>