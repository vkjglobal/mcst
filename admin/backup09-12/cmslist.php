<?php
@include 'config.php';
$itemsPerPage = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;

include_once 'includes/class.headerslider.php';

$cmsObj = new Class_headerslider();

if(isset($_GET['d_id']))
{
    $id = $_GET['d_id'];
    $status = $_GET['status'];
    $table=$_GET['table'];
    $name=$_GET['name'];

    $button_change = $cmsObj->enable_disable_cms($status, $id);
    // if($button_change)
    // {
    //     echo 'success';
    // }
    if ($button_change) {
        echo "<script>";
        echo "setTimeout(function(){ window.location.href = 'cmslist.php'; });"; // Redirect same page
        echo "</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php'; ?>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">CMS</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="cmsadd.php" class="btn btn-primary">Add New</a>
                            <form class="d-none d-md-flex ms-4" method="GET" action="cmslist.php">
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
                                        
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                      
                                <?php 
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $search = $_GET['search'];
                                    
                                        // Modify your SQL query to include the search condition
                                        $sql = "SELECT * FROM cms WHERE title LIKE :search ";
                                        $query = $dbh->prepare($sql);
                                        $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    } 
                                    else
                                    {
                                        $sql = "SELECT * from cms LIMIT :limit OFFSET :offset";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                                        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                                        //$query -> bindParam(':city', $city, PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        }
                                        $cnt=1 + $offset;;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                            {				?>		
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($result->title);?></td>
                                                    
                                                    <td>
                                                                    <div class="d-flex action">
                                                                    <a class="btn text-secondary edit" href="updatecms.php?uid=<?php echo htmlentities($result->_id); ?>">
                                                                            <i class="fa fa-pen">Edit</i>
                                                                        </a>
                                                                        <button type="button" class="btn text-secondary delete">
                                                                        <a class="btn text-secondary delete" href="deletecms.php?_id=<?php echo htmlentities($result->_id); ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
                                                                            <i class="fa fa-trash">Delete</i>
                                                                        </a>
                                                                        </button>
                                                                        <?php
                                                                        if ($result->status == 1) {
                                                                            echo '<a href="cmslist.php?d_id=' . $result->_id . '&status=0&table=header_slider&name=cmslist.php" class="d-flex align-items-center btn-success rounded p-2" ">publish</a>';
                                                                        } else {
                                                                            echo '<a href="cmslist.php?d_id=' . $result->_id . '&status=1&table=header_slider&name=cmslist.php" class="d-flex align-items-center btn-primary rounded p-2" ">Unpublish</a>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                </tr>
                                                <?php $cnt=$cnt+1;} }?>
                                 </tbody>
                                 <tr>
<td colspan="4">
            <!-- <div class="pagination justify-content-center mt-3" >
                <?php
                // Calculate the total number of pages
                $sql = "SELECT COUNT(*) as count FROM cms";
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
                ?> -->
                            </table>
                        </div>
                        <!-- <div aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="pagination justify-content-center mt-3">
                            <?php
                            // Generate "First" link
                            if ($current_page > 1) {
                                echo '<a href="?page=1" class="page-link">First</a>';
                            }

                            // Generate "Previous" link
                            if ($current_page > 1) {
                                echo '<a href="?page=' . ($current_page - 1) . '" class="page-link">Previous</a>';
                            }

                            // Display a limited number of page links
                            $visiblePages = 15; // Adjust the number of visible page links as needed
                            $startPage = max(1, $current_page - floor($visiblePages / 2));
                            $endPage = min($totalPages, $startPage + $visiblePages - 1);

                            for ($i = $startPage; $i <= $endPage; $i++) {
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