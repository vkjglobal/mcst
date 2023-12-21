<?php 
include_once 'includes/header.php';  
include_once 'includes/class.category.php';

    $catObj = new Class_category();
   
    $category = $catObj->selectCategory();//fetch the db category values
    // print_r($category);
    // print_r($_POST);
    if(isset($_POST['Submit']))
    {
        $parent = $catObj->sanitizeInput($_POST['parent']);
        $name = $catObj->sanitizeInput($_POST['name']);

        $addCat = $catObj->addCategory($parent,$name);
        
        if($parent == 1)
        {
            //folder name
            $folder_name = $name;

            //path 
            $folder_path = '../files/';

            // Check if the folder doesn't already exist
            if (!file_exists($folder_path . $folder_name)) {
                
                $newfile = mkdir($folder_path . $folder_name, 0775);// create new folder for category
            }else{
                    echo 'already exist the folder';
            }
        }else{

            $Pname1 = $catObj->selectParentNameId($parent);//get parent value
            //  print_r($Pname1[0]['category']); exit;
            //folder name
            $folder_name = $name;

            //path 
            $folder_path = '../files/'.$Pname1[0]['category'].'/';

            // Check if the folder doesn't already exist
            if (!file_exists($folder_path . $folder_name)) {
                
                $newfile = mkdir($folder_path . $folder_name, 0775);// create new folder for category
            }else{
                    echo 'already exist the folder';
            }
        }
        
        if($addCat)
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
<!-- <script>alert('helo');</script> -->
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <form name = "myform" method="POST">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Add Category</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Category</label>
                                                <select class="form-control border" name="parent" id="parent">
                                                    <option Value = ""></option>
                                                    <option Value = "1">Parent</option>
                                                    <?php foreach($category as $cc){ ?>
                                                        <option Value = <?php echo $cc['_id']; ?>><?php echo $cc['category']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control border" name="name" id="name">
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
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Category Added</h1>
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
// alert('helo');
            $("#Submit").click(function () {

                var parent = $('#parent').val();
                var name = $('#name').val();

                valid = true;
            
                $(".errortext").remove();
    
                if(parent == '') {
                    $('#parent').after('<span class="errortext" style="color:red">Category cannot be blank.</span>');	       
                    valid = false;
                }
                if (name == '') {
                    // alert('CKEditor content cannot be empty.');
                    $('#name').after('<span class="errortext" style="color:red">Name cannot be blank.</span>');	       
                    valid = false;
                } 
                
                if( !valid ){       
                    return valid;
                }	
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "add_category.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success: function (response) {
                        // alert(response); exit false;
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