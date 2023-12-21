<?php
session_start();
@include 'config.php';
if (!isset($_SESSION['login'])) {
?>
   <script>
    window.location="index.php";exit;   </script>
    exit;
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php'; ?>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-6 col-xl-3">
                            <div class="border-primary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i> 
                                <div class="">
                                    <p class="mb-2 text-secondary">Current Projects</p>
                                    <?php $sql3 = "SELECT * from projects where status='current'";
                                        $query3= $dbh -> prepare($sql3);
                                        $query3->execute();
                                        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                        $cnt3=$query3->rowCount();
	                				?>
								    <h4 class="mb-0 text-secondary"><?php echo htmlentities($cnt3);?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="border-primary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                                <div class="">
                                    <p class="mb-2 text-secondary">Completed Projects</p>
                                    <?php $sql4 = "SELECT * from projects where status='completed'";
                                        $query4= $dbh -> prepare($sql4);
                                        $query4->execute();
                                        $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                                        $cnt4=$query4->rowCount();
                                    ?>
                                    <h4 class="mb-0 text-secondary"><?php echo htmlentities($cnt3);?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="border-primary rounded d-flex align-items-center justify-content-between p-4">
                                 <i class="fa fa-chart-area fa-3x text-primary"></i> 
                                <div class="">
                                    <p class="mb-2 text-secondary">Total Partners</p>
                                    <?php $sql5 = "SELECT * from partners";
                                        $query5= $dbh -> prepare($sql5);
                                        $query5->execute();
                                        $results5=$query5->fetchAll(PDO::FETCH_OBJ);
                                        $cnt5=$query5->rowCount();
                                    ?>
                                    <h4 class="mb-0 text-secondary"><?php echo htmlentities($cnt5);?></h4> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="border-primary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i> 
                                <div class="">
                                    <p class="mb-2 text-secondary">Total Resources</p>
                                    <?php $sql6 = "SELECT * from cms where `menu__-`='Resources'";
                                        $query6= $dbh -> prepare($sql6);
                                        $query6->execute();
                                        $results6=$query6->fetchAll(PDO::FETCH_OBJ);
                                        $cnt6=$query6->rowCount();
					                ?>
                                    <h4 class="mb-0 text-secondary"><?php echo htmlentities($cnt6);?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Info cards End -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Current Projects</h6><a href="project_list.php">Show All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Project Title</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $sql = "SELECT * from projects where status='current'";
                                $query = $dbh -> prepare($sql);
                                //$query -> bindParam(':city', $city, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {	?>		
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->title);?></td>
                                            <td><a class="btn btn-sm btn-primary" href="updateproject.php?uid=<?php echo htmlentities($result->_id); ?>">View</a></td>
                                        </tr>
                                        <?php $cnt=$cnt+1;} }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once 'includes/footer.php'; ?>
        </div>
        <!-- Content End -->

</body>

</html>