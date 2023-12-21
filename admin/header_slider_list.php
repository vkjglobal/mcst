<?php

include_once 'includes/header.php';
include_once 'includes/class.headerslider.php';

$cmsObj = new Class_headerslider();

$hs_value = $cmsObj->selectHSvalue();
// print_r($hs_value);
$c = 0;

//delete Images from Gallery
if(isset($_GET['did']))
{
    $pid =  $_GET['did'] ;    
    // echo $pid;exit;
    $delete =   $cmsObj->DeleteHS($pid);
    if($delete){
        echo "<script>";
        echo "document.addEventListener('DOMContentLoaded', function() {";
        echo "    var delSuccessPop = document.getElementById('delsuccesspop');";
        echo "    if (delSuccessPop) {";
        echo "        delSuccessPop.classList.add('show');";
        echo "        delSuccessPop.style.display = 'block';";
        echo "    }";
        echo "});";
        echo "</script>";
                    
        // echo "<script>jQuery('#delsuccesspop').modal('show');alert('deleted succesfully');</script>";
        // header('Locatiion:users.php'); //exit;
        //echo "deleted succesfully";
    }else{
        echo "error in deletion";
    }
}

if(isset($_GET['d_id']))
{
    $id = $_GET['d_id'];
    $status = $_GET['status'];
    $table=$_GET['table'];
    $name=$_GET['name'];

    $button_change = $cmsObj->enable_disable($status, $id);
    // if($button_change)
    // {
    //     echo 'success';
    // }
    if ($button_change) {
        echo "<script>";
        echo "setTimeout(function(){ window.location.href = 'header_slider_list.php'; });"; // Redirect same page
        echo "</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">Header Sliders List</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="add-headerSlider.php" class="btn btn-primary">Add New</a>
                            <!-- <form class="d-none d-md-flex ms-4" method="GET" action="librarylist.php">
                                <input class="form-control border" type="search" placeholder="Search" name="search"
                                value="<?php echo isset($_GET['search'])? $_GET['search']:'';?>">
                            </form> -->
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                                <thead>
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($hs_value as $hs){ $c++; ?>
                                    <tr>
                                        <td><?php echo $c; ?></td>
                                        <td><?php echo $hs['title']; ?></td>
                                        <td><?php echo $hs['image']; ?></td>
                                        <td>
                                            <div class="d-flex align-items-center action">
                                                <a class="btn text-secondary edit" href="edit_headerslider.php?eid=<?php echo $hs['id']; ?>">
                                                    <i class="fa fa-pen">Edit</i>
                                                </a>
                                                <a class="btn text-secondary delete" href="header_slider_list.php?did=<?php echo $hs['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
                                                    <i class="fa fa-trash">Delete</i>
                                                </a>
                                                
                                                <?php
                                                if ($hs['status'] == 1) {
                                                echo '<a href="header_slider_list.php?d_id=' . $hs['id'] . '&status=0&table=header_slider&name=header_slider_list.php" class="d-flex align-items-center btn-success rounded p-2" ">publish</a>';
                                                } else {
                                                echo '<a href="header_slider_list.php?d_id=' . $hs['id'] . '&status=1&table=header_slider&name=header_slider_list.php" class="d-flex align-items-center btn-primary rounded p-2" ">Unpublish</a>';
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                            </table>
                        </div>
                        <!-- <div aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item disabled">           
                            </ul>
                        </div> -->
                    </div>
                </div>
                <!-- User List End -->
                <!--Start -->
                <div class="modal fade" id="delsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Header Slider deleted</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                            </div> 
                        </div>
                    </div>
                </div>
                <!--  End -->
            </div>
           <?php include_once 'includes/footer.php'; ?>
           <!-- Datatable start -->
           <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script>
                // Awesome JS Code Goes here
                $(document).ready( function () {
                    // $('#myTable').DataTable({responsive: true});
                    new DataTable('#myTable');
                } );
            </script>
    <!-- Datatable script end -->
        </div>
        <!-- Content End -->
        <script>
            function backuserpage() {
            window.location = "header_slider_list.php";
        }
        </script>

</body>

</html>