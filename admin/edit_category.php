<?php 

    include_once 'includes/header.php';
    include_once 'includes/class.category.php';

    $catObj = new Class_category();

    // $category = $catObj->selectCategory();//fetch the db category values
    $p_Name = '';
    $categoryName = '';
    if(isset($_GET['uid']))
    {
        $id = $catObj->sanitizeInput($_GET['uid']);

        $category_values = $catObj->getcategory($id);
        // print_r($category_values);
        if($category_values)
        {
            $categoryName = $category_values[0]['category'];
            $parent_id = $category_values[0]['parent_category_id'];
        }
    }
   
    $parentName = $catObj->getParent_name($parent_id);
    
    // print_r($parent_id);
    if($parent_id == 1){
        $p_Name = 'Parent';
    }else{
        $p_Name = $parentName[0]['category'];
    }
    //update function
    if(isset($_POST['Submit']))
    {
        //fetch form values
        $name = $catObj->sanitizeInput($_POST['name']);

        $updateCat = $catObj->updateCategoryValue($name,$id);
        if($updateCat)
        { 
            echo "<script>";
            echo "document.addEventListener('DOMContentLoaded', function() {";
            echo "    var addsuccesspop = document.getElementById('addsuccesspop');";
            echo "    if (addsuccesspop) {";
            echo "        addsuccesspop.classList.add('show');";
            echo "        addsuccesspop.style.display = 'block';";
            echo "    }";
            echo "});";
            echo "</script>";
            // echo "update success ";
        }
        else{
            echo "error in insertion";
        }
    }
    
?>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <form name = "myform" method="POST" enctype="multipart/form-data">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Update Category</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Category</label>
                                                <input type="text" class="form-control border" name="parent" id="parent" value="<?php echo $p_Name; ?> " disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control border"  name="name" id="name" value="<?php echo $categoryName; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <input type="submit" name="Submit" value="Submit" id="Submit" class="btn btn-primary btn-typ4">
                                        <button type="button" class="btn btn-primary btn-typ3 ms-2" onclick="backuserpage()">CANCEL</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- User List End -->
                <!--Start -->
                <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Category Updated</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                            </div>      
                        </div>
                    </div>
                </div>
                <!--  End -->
            </div>
          
    <?php include_once 'includes/footer.php'; ?>
    <!-- form validation -->
    <script>
        $(document).ready(function(){

            $("#Submit").click(function () {

                var name = $('#name').val();

                valid = true;

                $(".errortext").remove();

                if(name == '') {
                    $('#name').after('<span class="errortext" style="color:red">name cannot be blank.</span>');	       
                    valid = false;
                }
                
                if( !valid ){       
                    return valid;
                }	
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "edit_category.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success: function (response) {
                        window.location.href='category_list.php';
                    }
                });
            // new DataTable('#countryform');
            });
        });
    function backuserpage() {
        window.location = "category_list.php";
    }

    </script>
</body>

</html>