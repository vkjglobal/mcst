<?php
include_once 'includes/header.php';
include_once 'includes/class.category.php';

$catObj = new Class_category();

$category = $catObj->selectCategory();//fetch the db category values

$fileErr = '';
if(isset($_POST['Submit']))
{ 
    $title = $catObj->sanitizeInput($_POST['title']);
    $author = $catObj->sanitizeInput($_POST['url']);
    $category = $catObj->sanitizeInput($_POST['category']);
    $longdesc1 = $catObj->sanitizeInput($_POST['desc1']);
    $shortdesc1 = $catObj->sanitizeInput($_POST['desc2']);
    $changelog1 = $catObj->sanitizeInput($_POST['desc3']);
    $file = $_FILES['file']['name'];
    
    //content decoding
    $longdesc = html_entity_decode($longdesc1);
    $shortdesc = html_entity_decode($shortdesc1);
    $changelog = html_entity_decode($changelog1);
    // Split the selected value into _id and category using the delimiter '|'
    // list($categoryId, $categoryName) = explode('|', $Category);

    $Pname1 = $catObj->selectParentNameId($category);//get parent name
    // print_r($Pname1);exit;
    if($Pname1[0]['parent_category_id'] == 1)
    {
        //check file uploaded
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $targetDir = '../files/'.$Pname1[0]['category'].'/';
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($targetFile)) {
                $fileErr = "Sorry, file already exists.";
            }

            // Check file size (limit to 10MB here)
            // if ($_FILES["file"]["size"] > 10 * 1024 * 1024) {
            //     $fileErr = "Sorry, your file is too large.";
            // }

            // Allow only PDF files
            // if ($fileType !== "pdf") {
            //     $fileErr = "Sorry, only PDF files are allowed.";
            // }

            if ($fileErr == "") {
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
                    // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";

                    // Store the file path or details in the database if needed
                    // For example:
                    // $filePath = $targetFile;
                    // $catObj->saveFilePathInDatabase($filePath);
                // } 
                // else {
                //     echo "Sorry, there was an error uploading your file.";
                // }
            }
        } 
        // else {
        //     echo "No file uploaded.";
        // }
    }else{
        
        $pp = $Pname1[0]['parent_category_id'];//fetch parent name id
        
        $parentname = $catObj->selectParentNameId($pp);//fetch main parent name
// print_r($parentname); exit;
        //check file uploaded
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $targetDir = '../files/'.$parentname[0]['category'] .'/'. $Pname1[0]['category'].'/';
            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($targetFile)) {
                $fileErr = "Sorry, file already exists.";
            }
            if ($fileErr == "") {
                (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile));
            }
        }
    }
    $f_size = $_FILES["file"]["size"];
    
    $file_size = $catObj->formatfile_size($f_size);
    // print_r($file_size);
//    if( $imageErr == '')
//    {
        // $Pname1 = $catObj->selectParentNameId($category);//get parent name
        // // print_r($Pname1);exit;
        // // checking the category value
        // //folder name
        // $folder_name = $title;

        // //path 
        // $targetDir = 'files/'.$Pname1[0]['category'].'/';

        // $targetFile = $targetDir . basename($_FILES['file']['name']);
         //add code
        $addlibrary = $catObj->addLibrary($title, $author, $shortdesc, $longdesc, $file_size, $file, $category, $changelog);
        
        if($addlibrary)
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
    // }
}
?>

<!-- <?php include_once 'includes/header.php'; ?> -->

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <!-- Account Settings Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <div class="row" id="editprofile" style="display: flex;">
                                <div class="col-12">
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add Library</strong>
                                    <form class="row" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">File</label>
                                            <label class="uploadFile form-control">
                                                <span class="filename"></span>
                                                <input type="file" class="inputfile" name="file" id="file">
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label>Category</label>
                                                    <select class="form-control" name="category" id="category">
                                                        <option value=""></option>
                                                        <?php foreach($category as $cc){ $cname = $cc['category'];?>
                                                            <option Value = "<?php echo $cc['_id']; ?>"><?php echo $cc['category']; ?></option>
                                                            <!-- <option Value = "<?php echo $cc['_id'] . '|' . $cc['category']; ?>"><?php echo $cc['category']; ?></option> -->
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="url">Author</label>
                                            <input type="text" class="form-control" id="url" name="url">
                                        </div>
                                        <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="hot" name="hot">
                                                <label class="form-check-label" for="hot">Hot</label>
                                            </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Short description</label>
                                            <textarea type="editor" class="ckeditor" id="desc1" name="desc1"></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Long description</label>
                                            <textarea type="editor" class="ckeditor" id="desc2" name="desc2"></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Change log</label>
                                            <textarea type="editor" class="ckeditor" id="desc3" name="desc3"></textarea>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <input type="submit" name="Submit" value="Submit" id="Submit" class="btn btn-primary btn-typ4">
                                            <button type="button" class="btn btn-primary btn-typ3 ms-2" onclick="backuserpage()">CANCEL</button>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                        <!--Start -->
                        <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Library Added</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                                    </div>      
                                </div>
                            </div>
                        </div>
                        <!--  End -->
                        <?php include_once 'includes/footer.php'; ?>
                    </div>
                    <!-- Content End -->
                </div>
            </div>
    <!-- form validations -->
    <script>
        $(document).ready(function(){

            $("#Submit").click(function () {

                var title = $('#title').val();
                var category = $('#category').val();
                // var image = $('#image').val();
                // var desc1 = CKEDITOR.instances['desc1'].getData().replace(/<[^>]*>/gi, '').length;
                // var desc2 = CKEDITOR.instances['desc1'].getData().replace(/<[^>]*>/gi, '').length;
                // var desc3 = CKEDITOR.instances['desc1'].getData().replace(/<[^>]*>/gi, '').length;

                valid = true;
            
                $(".errortext").remove();
    
                if(title == '') {
                    $('#title').after('<span class="errortext" style="color:red">title cannot be blank.</span>');	       
                    valid = false;
                }
                if(category == '') {
                    $('#category').after('<span class="errortext" style="color:red">category cannot be blank.</span>');	       
                    valid = false;
                }
                // if (!desc1) {
                //     // alert('CKEditor content cannot be empty.');
                //     $('#desc1').after('<span class="errortext" style="color:red">long description cannot be blank.</span>');	       
                //     valid = false;
                // } 
                // if (!desc2) {
                //     // alert('CKEditor content cannot be empty.');
                //     $('#desc2').after('<span class="errortext" style="color:red">Short description cannot be blank.</span>');	       
                //     valid = false;
                // }  
                // if (!desc3) {
                //     // alert('CKEditor content cannot be empty.');
                //     $('#desc3').after('<span class="errortext" style="color:red">change log cannot be blank.</span>');	       
                //     valid = false;
                // }  
                // if(image == '') {
                //     $('#image').after('<span class="errortext" style="color:red">image cannot be blank.</span>');       
                //     valid = false;
                // }
                
                if( !valid ){       
                    return valid;
                }	
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "add_library.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success: function (response) {
                        // alert(response); exit false;
                        window.location.href='library_list.php';
                    }
                });
            // new DataTable('#countryform');
            });
        });

        function backuserpage() {
            window.location = "library_list.php";
        }
    </script>