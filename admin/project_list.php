<?php
include_once 'includes/header.php';
@include 'config.php';
$itemsPerPage = 5;
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
                        <h5 class="fw-normal">Project List</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="projectadd.php" class="btn btn-primary">Add New</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * from projects LIMIT :limit OFFSET :offset";
                                        $query = $dbh -> prepare($sql);
                                        //$query -> bindParam(':city', $city, PDO::PARAM_STR);
                                        $query->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt=1+ $offset;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {				?>		
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->title);?></td>
                                            <td><?php echo htmlentities($result->status);?></td>
                                            <td>
                                                            <div class="d-flex align-items-center action">
                                                            <a class="btn text-secondary edit" href="updateproject.php?uid=<?php echo htmlentities($result->_id); ?>">
                                                                    <i class="fa fa-pen">Edit</i>
                                                                </a>
                                                                <button type="button" class="btn text-secondary delete">
                                                                <a class="btn text-secondary delete" href="deleteproject.php?_id=<?php echo htmlentities($result->_id); ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
                                                                    <i class="fa fa-trash">Delete</i>
                                                                </a>
                                                                </button>
                                                                <?php
                                                                if ($result->status_i == 1) {
                                                                echo '<a href="show.php?d_id=' . htmlentities($result->_id) . '&status=0&table=projects&name=project_list.php" class="d-flex align-items-center btn-success rounded p-2">Unpublish</a>';
                                                                } else {
                                                                echo '<a href="show.php?d_id=' . htmlentities($result->_id) . '&status=1&table=projects&name=project_list.php" class="d-flex align-items-center btn-primary rounded p-2" >publish</a>';
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
                                        // Calculate the total number of pages
                                        $sql = "SELECT COUNT(*) as count FROM projects";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                        $totalItems = $row['count'];
                                        $totalPages = ceil($totalItems / $itemsPerPage);

                                        // Generate "First" link
                                        if ($current_page > 1) {
                                            echo '<a href="?page=1" class="page-link">First</a>';
                                        }

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
        </div>
        <!-- Content End -->
    
</body>

</html>