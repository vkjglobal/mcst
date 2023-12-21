<?php
include_once 'includes/header.php';
include_once 'includes/class.category.php';

$catObj = new Class_category();

$category = $catObj->selectCategory();//fetch the db category values

if(isset($_GET['uid']))
{
    $id = $catObj->sanitizeInput($_GET['uid']);
    //fetch db data of selected library
    $library = $catObj->getlibrary($id);
    // print_r($library);
    if($library)
    {
        $title = $library[0]['title'];
        $file = $library[0]['file'];
        $author = $library[0]['author'];
        $category = $library[0]['category_id'];
        $longdesc = $library[0]['long_description'];
        $shortdesc = $library[0]['short_description'];
        $changelog = $library[0]['changelog'];
    }
}
$categoryName = '';
//fetch category name using category id
$p_id = $category;
$cat_name = $catObj->SelectParent($p_id);
$categoryName = $cat_name[0]['category'];

if(isset($_POST['Submit']))
{ 
    $title = $catObj->sanitizeInput($_POST['title']);
    $author = $catObj->sanitizeInput($_POST['url']);
    $longdesc = $catObj->sanitizeInput($_POST['desc1']);
    $shortdesc = $catObj->sanitizeInput($_POST['desc2']);
    $changelog = $catObj->sanitizeInput($_POST['desc3']);
    $file = $_FILES['file']['name'];
    //image validation
    $imageErr = '';
 
   if($title == '')
   {
        $title = $library[0]['title'];
   }
   if($file == '')
   {
        $file = $library[0]['file'];
   }
   

//    if( $imageErr == '')
//    {
        //add code
        $updatelibrary = $catObj->update_Library($title, $author, $shortdesc, $longdesc, $file, $changelog, $id);
        if($updatelibrary)
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
}else{
    $title = $library[0]['title'];
    $file = $library[0]['file'];
    $author = $library[0]['author'];
    $category = $library[0]['category_id'];
    $longdesc = $library[0]['long_description'];
    $shortdesc = $library[0]['short_description'];
    $changelog = $library[0]['changelog'];
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
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Update Library</strong>
                                    <form class="row" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">File</label>
                                            <label class="uploadFile form-control">
                                                <span class="filename"></span>
                                                <input type="file" class="inputfile" name="file" id="file">
                                                <?php echo $file ?>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label>Category</label>
                                                    <input class="form-control" name="category" id="category" value ="<?php echo $categoryName ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="url">Author</label>
                                            <input type="text" class="form-control" id="url" name="url" value="<?php echo $author ?>">
                                        </div>
                                        <!-- <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="hot" name="hot">
                                                <label class="form-check-label" for="hot">Hot</label>
                                            </div> -->
                                        <div class="col-12 mb-3">
                                            <label for="content">Short description</label>
                                            <textarea type="editor" class="ckeditor" id="desc1" name="desc1"><?php echo $shortdesc; ?></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Long description</label>
                                            <textarea type="editor" class="ckeditor" id="desc2" name="desc2"><?php echo $longdesc; ?></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Change log</label>
                                            <textarea type="editor" class="ckeditor" id="desc3" name="desc3"><?php echo $changelog; ?></textarea>
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
                                        <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Library Updated</h1>
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
                if(file == '') {
                    $('#file').after('<span class="errortext" style="color:red">file cannot be blank.</span>');	       
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