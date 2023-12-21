<?php
@include 'config.php';
$itemsPerPage = 4;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;
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


            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">Reference Library List</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="add-library.php" class="btn btn-primary">Add New</a>
                            <form class="d-none d-md-flex ms-4" method="GET" action="librarylist.php">
                                <input class="form-control border" type="search" placeholder="Search" name="search"
                                value="<?php echo isset($_GET['search'])? $_GET['search']:'';?>">
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Downloads</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                      
                                <?php 
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $search = $_GET['search'];
                                    
                                        // Modify your SQL query to include the search condition
                                        $sql = "SELECT * FROM libraries WHERE title LIKE :search";
                                        $query = $dbh->prepare($sql);
                                        $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                     } 
                                    else
                                    {
                                    $sql = "SELECT * from libraries LIMIT :limit OFFSET :offset";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    }
                                    $cnt=1 + $offset;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {				?>		
						            <tr>
							        <td><?php echo htmlentities($cnt);?></td>
							        <td><?php echo htmlentities($result->title);?></td>
							        <td><?php echo htmlentities($result->downloads);?></td>
                                    <td>
                                            <div class="d-flex action">
                                               <a class="btn text-secondary edit" href="libraryupdate.php?uid=<?php echo htmlentities($result->_id); ?>">
                                                    <i class="fa fa-pen">Edit</i>
                                                </a>
                                                <button type="button" class="btn text-secondary delete">
                                                <a class="btn text-secondary delete" href="deletelibrary.php?_id=<?php echo htmlentities($result->_id); ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
                                                    <i class="fa fa-trash">Delete</i>
                                                </a>
                                                </button>
                                            </div>
                                        </td>
						            </tr>
						             <?php $cnt=$cnt+1;} }?>
                                    
                                    </tr>
                                </tbody>
                                <tr>
        <td colspan="4">
            <div class="pagination justify-content-center mt-3">
                <?php
                // Calculate the total number of pages
                $sql = "SELECT COUNT(*) as count FROM libraries";
                $query = $dbh->prepare($sql);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $totalItems = $row['count'];
                $totalPages = ceil($totalItems / $itemsPerPage);

                // Generate "Previous" link
                if ($current_page > 1) {
                    echo '<a href="?page=' . ($current_page - 1) . '" class="page-link">Previous</a>';
                }

                // Generate numeric page links
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="page-link">' . $i . '</span>';
                    } else {
                        echo '<a href="?page=' . $i . '" class="page-link">' . $i . '</a>';
                    }
                }

                // Generate "Next" link
                if ($current_page < $totalPages) {
                    echo '<a href="?page=' . ($current_page + 1) . '" class="page-link">Next</a>';
                }
                ?>
            </div>
        </td>
    </tr>
</tfoot>
                            </table>
                        </div>
                        <div aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item disabled">
                                
                            </ul>
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