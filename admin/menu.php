<?php
include_once 'includes/header.php';
@include 'config.php';
$itemsPerPage = 20;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;
// Retrieve success message from URL parameter if it exists
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
// Display the success message if available
if (!empty($successMessage)) {
    echo '<div class="alert alert-success"><center>' . htmlspecialchars($successMessage) . '</center></div>';
}
?>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">Menu List</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="menuadd.php" class="btn btn-primary">Add New</a>
                            <form class="d-none d-md-flex ms-4" method="GET" action="menu.php">
                                <input class="form-control border" type="search" placeholder="Search" name="search" value="<?php echo isset($_GET['search'])? $_GET['search']:'';?>">
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Modify the SQL query to include search functionality if a search term is present
                                    $sql = "SELECT * FROM menus";
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $searchTerm = $_GET['search'];
                                        $sql .= " WHERE menu LIKE :searchTerm OR parent LIKE :searchTerm"; // Update this to include relevant search fields/columns
                                    }
                                    $sql .= " LIMIT :limit OFFSET :offset";

                                    // Prepare and bind the parameters for the search query
                                    $query = $dbh->prepare($sql);
                                    if (isset($searchTerm)) {
                                        $query->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
                                    }
                                    $query->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt=1+$offset;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    { ?>		
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->parent);?></td>
                                        <td><?php echo htmlentities($result->menu);?></td>
                                        <td>
                                            <div class="d-flex action">
                                                <a class="btn text-secondary edit" href="update-menu.php?uid=<?php echo htmlentities($result->_id); ?>">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <?php
                                                $childStatus = htmlentities($result->child_menu_status);
                                                if ($childStatus == 1) {
                                                    echo '<a class="btn text-secondary delete" href="deletemenu.php?_id=' . htmlentities($result->_id) . '" onclick="return confirm(\'This menu has child items. Are you sure you want to remove it and its children?\');"><i class="fa fa-trash"></i></a>';
                                                } else {
                                                    echo '<a class="btn text-secondary delete" href="deletemenu.php?_id=' . htmlentities($result->_id) . '" onclick="return confirm(\'Are you sure you want to delete this menu item?\');"><i class="fa fa-trash"></i></a>';
                                                }
                                                ?>
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
                                            // Calculate the total number of pages with consideration of the search term
                                            $sql = "SELECT COUNT(*) as count FROM menus";
                                            if (isset($_GET['search']) && !empty($_GET['search'])) {
                                                $searchTerm = $_GET['search'];
                                                $sql .= " WHERE menu LIKE :searchTerm OR parent LIKE :searchTerm"; // Update this to include relevant search fields/columns
                                            }

                                            $query = $dbh->prepare($sql);
                                            if (isset($searchTerm)) {
                                                $query->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
                                            }
                                            $query->execute();
                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                            $totalItems = $row['count'];
                                            $totalPages = ceil($totalItems / $itemsPerPage);

                                            // Determine the range of pages to display
                                            $range = 10;
                                            $initialNum = $current_page - floor($range / 2);
                                            if ($initialNum < 1) {
                                                $initialNum = 1;
                                            }
                                            $finalNum = $initialNum + $range - 1;
                                            if ($finalNum > $totalPages) {
                                                $finalNum = $totalPages;
                                                $initialNum = $finalNum - $range + 1;
                                                if ($initialNum < 1) {
                                                    $initialNum = 1;
                                                }
                                            }

                                            // Modify pagination links to maintain search parameters
                                            $paginationLink = 'menu.php';
                                            if (isset($_GET['search']) && !empty($_GET['search'])) {
                                                $paginationLink .= '?search=' . $_GET['search'] . '&';
                                            } else {
                                                $paginationLink .= '?';
                                            }

                                            // Generate "First" link
                                            if ($current_page > 1) {
                                                echo '<a href="?page=1" class="page-link">First</a>';
                                            }

                                            // Generate "Previous" link
                                            if ($current_page > 1) {
                                                echo '<a href="?page=' . ($current_page - 1) . '" class="page-link">Previous</a>';
                                            }

                                            // Generate numeric page links within the determined range
                                            for ($i = $initialNum; $i <= $finalNum; $i++) {
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

                                            // Generate "Last" link
                                            if ($current_page < $totalPages) {
                                                echo '<a href="?page=' . $totalPages . '" class="page-link">Last</a>';
                                            }
                                            ?>

                            </table>
                                        </div>
                        <div aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- User List End -->
            </div>
        <?php include_once 'includes/footer.php'; ?>
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
</body>

</html>