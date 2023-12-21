<?php 

    include_once 'includes/header.php';
    include_once 'includes/class.category.php';

    $catObj = new Class_category();

    $library = $catObj->selectLibraries();
    // print_r($library);

    $c = 0;

    //delete code
    if(isset($_GET['did']))
    {
        $pid =  $_GET['did'] ;   
        // echo $pid;exit;
        $delete =   $catObj->Delete_library($pid);
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
                            <a href="add_library.php" class="btn btn-primary">Add New</a>
                        </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                            <thead>
                                <tr class="">
                                    <th scope="col">#</th>
                                    <th scope="col">Parent</th>
                                    <!-- <th scope="col">Subcategory</th> -->
                                    <th scope="col">Library Title</th>
                                    <th scope="col">Downloads</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($library as $ll){ $c++;?>
                                    <tr>
                                        <td><?php echo $c; ?></td>
                                        <td><?php 
                                            //fetch parent name using id
                                                // $parent_id = $ll['category_id'];
                                                $p_id = $ll['category_id'];
                                                $parentName = $catObj->SelectParent($p_id);
                                                print_r($parentName[0]['category']);
                                            ?></td>
                                        <td><?php echo $ll['title']; ?></td>
                                        <td><?php echo $ll['downloads']; ?></td>
                                        <td>
                                            <div class="d-flex action">
                                                <a class="btn text-secondary edit" href="edit_library.php?uid=<?php echo $ll['_id']; ?>">
                                                    <i class="fa fa-pen">Edit</i>
                                                </a>
                                                <button type="button" class="btn text-secondary delete">
                                                <a class="btn text-secondary delete" href="library_list.php?did=<?php echo $ll['_id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">   
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
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Library deleted</h1>
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
            window.location = "library_list.php";
        }
    </script>
</body>

</html>