<?php 

    include_once 'includes/header.php';
    include_once 'includes/class.category.php';

    $catObj = new Class_category();

    $category = $catObj->selectCategory();//fetch the db category data
    // print_r($category);
    $c = 0;
    //delete code
    if(isset($_GET['did']))
    {
        $pid =  $_GET['did'] ;   
        // echo $pid;exit;
        $delete =   $catObj->DeleteCategory($pid);
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
?>
        <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="border-primary text-center rounded p-4">
                        <h5 class="fw-normal">Category</h5>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="add_category.php" class="btn btn-primary">Add New</a>
                        </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                            <thead>
                                <tr class="">
                                    <th scope="col">#</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($category as $cc){ $c++; ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php 
                                            if($cc['parent_category_id'] == 1){
                                                echo 'Parent';
                                            }else{
                                                
                                                $p_id = $cc['parent_category_id'];
                                                $parentName = $catObj->SelectParent($p_id);
                                                print_r($parentName[0]['category']);
                                            }
                                        ?></td>
                                    <td><?php echo $cc['category']; ?></td>
                                    <td>
                                        <div class="d-flex action">
                                            <a class="btn text-secondary edit" href="edit_category.php?uid=<?php echo $cc['_id']; ?>">
                                                <i class="fa fa-pen">Edit</i>
                                            </a>
                                            <button type="button" class="btn text-secondary delete">
                                            <a class="btn text-secondary delete" href="category_list.php?did=<?php echo $cc['_id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
                                                <i class="fa fa-trash">Delete</i>
                                            </a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- User List End -->
                <!--Start -->
                <div class="modal fade" id="delsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Category deleted</h1>
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
    <script>
        function backuserpage() {
            window.location = "category_list.php";
        }
    </script>
</body>

</html>