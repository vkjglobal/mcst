<?php
include_once 'includes/header.php';
@include 'config.php';
$itemsPerPage = 20;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;
?>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">Menu List</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="menuadd.php" class="btn btn-primary">Add New</a>
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
                                    $sql = "SELECT * from menus LIMIT :limit OFFSET :offset";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);

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
                                            // Calculate the total number of pages
                                            $sql = "SELECT COUNT(*) as count FROM menus";
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
</body>

</html>