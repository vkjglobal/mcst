<?php
@include 'config.php';
$uid = intval($_GET['uid']);
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $update_date = date('Y-m-d H:i:s');
    $url = $_POST['url'];
    $content = $_POST['content'];
    $content1 = $_POST['content1'];
    $content2 = $_POST['content2'];

    // Check if a file was uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
    } else {
        $image = $result->file;
    }

    $hot = isset($_POST['hot']) ? 1 : 0;

    // Fetch the existing record for the given uid
    $sql_select = "SELECT * FROM libraries WHERE _id = :uid";
    $query_select = $dbh->prepare($sql_select);
    $query_select->bindParam(':uid', $uid, PDO::PARAM_INT);
    $query_select->execute();
    $result = $query_select->fetch(PDO::FETCH_OBJ);

    if ($result) {
        // Update the record with the new values
        $sql_update = "UPDATE libraries SET title=:title, updated_at=:update_date, author=:url, short_description=:content, long_description=:content1, change_log=:content2, `file`=:image, isHot=:hot WHERE _id=:uid";
        $query_update = $dbh->prepare($sql_update);
        $query_update->bindParam(':title', $title, PDO::PARAM_STR);
        $query_update->bindParam(':update_date', $update_date, PDO::PARAM_STR);
        $query_update->bindParam(':uid', $uid, PDO::PARAM_INT);
        $query_update->bindParam(':url', $url, PDO::PARAM_STR);
        $query_update->bindParam(':content', $content, PDO::PARAM_STR);
        $query_update->bindParam(':content1', $content1, PDO::PARAM_STR);
        $query_update->bindParam(':content2', $content2, PDO::PARAM_STR);
        $query_update->bindParam(':image', $image, PDO::PARAM_STR);
        $query_update->bindParam(':hot', $hot, PDO::PARAM_BOOL);

        try {
            $query_update->execute();

            // Check for successful update
            if ($query_update->rowCount() > 0) {
                echo '<script>';
                echo 'alert("Data Updated");';
                echo 'window.location.href = "librarylist.php";'; // Redirect after successful update
                echo '</script>';
                exit();
            } else {
                echo "No rows were updated.";
            }
        } catch (PDOException $e) {
            echo "SQL Error: " . $e->getMessage();
        }
    } else {
        echo "Record not found for the given uid.";
    }
}
?>
<!-- Rest of your HTML code -->


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
function displayFileName() {
    const fileInput = document.getElementById('image');
    const label = document.querySelector('.uploadFile');
    const fileNameSpan = document.querySelector('.filename');

    if (fileInput.files.length > 0) {
        fileNameSpan.textContent = fileInput.files[0].name;
        label.style.border = '1px solid #ced4da';
    } else {
        fileNameSpan.textContent = '';
    }
}
</script>
<script>
    function redirectToAnotherPage() {
        // Use window.location.href to redirect to the desired page
        window.location.href = "librarylist.php"; // Replace with the actual page URL
    }
</script>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                        <?php 
$uid=intval($_GET['uid']);
$sql = "SELECT * from libraries where _id=:uid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Update Libraries</h5>

                                    <div class="col-md-6 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"  value="<?php echo htmlentities($result->title);?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <label class="uploadFile form-control">
                                    <span class="filename"><?php echo htmlentities($result->file); ?></span>
                                    <input type="file" class="inputfile" name="image" id="image"  value="<?php echo htmlentities($result->file); ?>"onchange="displayFileName()" >
                                </label>
                                <span class="d-block">Note: Maximum Image Size 1000 kb</span>
                            </div>
                            
                            
                            <div class="col-md-6 mb-3">
                                <label for="title">Author</label>
                                <input type="text" class="form-control" id="url" name="url"  value="<?php echo htmlentities($result->author);?>">
                            </div>
                            <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="hot" name="hot" <?php if ($result->isHot == 1) echo 'checked'; ?>>
    <label class="form-check-label" for="hot">Hot</label>
</div>

                            
                                <div class="col-12 mb-3">
                                <label for="content">Content</label>
                                
                                <textarea id="content" name="content" class="form-control" > </textarea>
                                
                            </div>
                            </div>

                                <div class="col-12 mb-3">
                                <label for="content">long description</label>
                                
                                <textarea id="content1" name="content1" class="form-control" > </textarea>
                                
                            </div>
                            </div>
                                <div class="col-12 mb-3">
                                <label for="content">Change log</label>
                                
                                <textarea id="content2" name="content2" class="form-control" > </textarea>
                                
                            </div>
                                    
                                    <div class="col-12 d-flex"><button type="submit"
                                            class="btn btn-primary btn-typ4" name="submit" >SAVE</button>
                                            <button type="reset" value="Clear" onclick="redirectToAnotherPage()" 
                                            class="btn btn-primary btn-typ3 ms-2">CANCEL</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }} ?>  
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#content' ), {
        config: 'document'
    })
    .then(editor => {
        
        editor.setData(`<?php echo $result->short_description; ?>`);

        document.querySelector('form').addEventListener('submit', function() {
            const textContent = editor.getData({ dataText: false }); // Set dataText to false
            document.querySelector('#content').value = textContent;
        });
    })
    .catch(error => {
        console.error(error);
    });

</script>
<script>
  ClassicEditor
    .create( document.querySelector( '#content1' ), {
        config: 'document'
    })
    .then(editor => {
        
        editor.setData(`<?php echo $result->long_description; ?>`);

        document.querySelector('form').addEventListener('submit', function() {
            const textContent = editor.getData({ dataText: false }); // Set dataText to false
            document.querySelector('#content1').value = textContent;
        });
    })
    .catch(error => {
        console.error(error);
    });

</script>
<script>
  ClassicEditor
    .create( document.querySelector( '#content2' ), {
        config: 'document'
    })
    .then(editor => {
        
        editor.setData(`<?php echo $result->change_log; ?>`);

        document.querySelector('form').addEventListener('submit', function() {
            const textContent = editor.getData({ dataText: false }); // Set dataText to false
            document.querySelector('#content2').value = textContent;
        });
    })
    .catch(error => {
        console.error(error);
    });

</script>