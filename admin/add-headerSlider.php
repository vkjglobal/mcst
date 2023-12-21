<?php
include_once 'includes/header.php';
include_once 'includes/class.headerslider.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$cmsObj = new Class_headerslider();

if(isset($_POST['Submit']))
{
    // fetch form values
    // print_r($_POST);
   $title = $cmsObj->sanitizeInput($_POST['title']);
   $desc1 = $cmsObj->sanitizeInput($_POST['desc1']);
   $desc2 = $cmsObj->sanitizeInput($_POST['desc2']);
   $image1 = $_FILES['image1']['name'];
//    $image2 = $_FILES['image2']['name'];
//    print_r($_POST);
   $imageErr1 = "";
   //check file uploaded
   if(!empty($_FILES['image1']['name']))
   {

       $image1 = $_FILES['image1']; 
       $image1 = $image1['name'];
    //    $image2 = $_FILES['image2']; 
    //    $image2 = $image2['name'];

       $allowedTypes = array(
           IMAGETYPE_JPEG,
           IMAGETYPE_PNG,
           IMAGETYPE_GIF
       );
        if ($_FILES['image1']['error'] === UPLOAD_ERR_OK) { 
            $imageType = getimagesize($_FILES['image1']['tmp_name']);

            if (!in_array($imageType, $allowedTypes)) {
                // Invalid image file type
                $imageErr1   =  "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
                //return false;
            } 
        }
   }
   // Example allowed MIME types
   $allowedMimeTypes = ['image1/jpeg', 'image1/png', 'image1/gif']; 
   $fileMimeType1 = $_FILES['image1']['type'];
   if (!in_array($fileMimeType1, $allowedMimeTypes)) {
       $imageErr1 = "Invalid MIME type";
       //return false;
   }
//    $allowedMimeType = ['image2/jpeg', 'image2/png', 'image2/gif']; 
//    $fileMimeType = $_FILES['image2']['type'];
//    if (!in_array($fileMimeType, $allowedMimeType)) {
//        $imageErr2 = "Invalid MIME type";
//        //return false;
//    }
   $time = date('Y-m-d H:i:s');
//    if($imageErr1 == "" && $imageErr2 == "")
//    {
        move_uploaded_file($_FILES["image1"]["tmp_name"],"uploads/".$image1);//move image1
        // move_uploaded_file($_FILES["image1"]["tmp_name"],"uploads/".$image2);//move image2
      
        $addHS = $cmsObj->add_HeaderSliders($title,$desc1,$desc2,$image1);
        // print_r($addHS);
        if(!empty ($addHS))
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
        // if($addHS) {
        //     // Redirect or perform actions upon successful insertion
        //     header("Location: header_slider_list.php");
        //     exit(); // Ensure script stops execution after redirect
        // } else {
        //     // Handle error if insertion fails
        //     echo "Error: Failed to insert data into the database.";
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
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add header sliders</strong>
                                    <form class="row" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="">Long description</label>
                                            <textarea type="editor" class="ckeditor" name="desc1" id="desc1"></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="">Short description</label>
                                            <textarea type="editor" class="ckeditor" name="desc2" id="desc2"></textarea>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image 1</label>
                                            <label class="uploadFile form-control">
                                                <span class="filename"></span>
                                                <input type="file" class="inputfile" name="image1" id="image1">
                                            </label>
                                        </div>
                                        <!-- <div class="col-md-6 mb-3">
                                            <label for="image">Image 2</label>
                                            <label class="uploadFile form-control">
                                                <span class="filename"></span>
                                                <input type="file" class="inputfile" name="image2" id="image2">
                                            </label>
                                        </div> -->
                                        <div class="col-12 d-flex">
                                            <input type="submit" name="Submit" value="Submit" id="Submit" class="btn btn-primary btn-typ4">
                                            <button type="button" class="btn btn-primary btn-typ3 ms-2" onclick="backuserpage()">CANCEL</button>
                                        </div>
                                    </form>
                                </div>            
                            </div>
                        </div>
                        <?php include_once 'includes/footer.php'; ?>
                    </div>
                    <!-- Content End -->
                    <!--Start -->
                    <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Header slider Added</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <!--  End -->
            </div>

    <!-- JS validation -->
    <script>
        $(document).ready(function(){

            $("#Submit").click(function () {

                var title = $('#title').val();
                var image1 = $('#image1').val();
                // var image2 = $('#image2').val();
                var desc1 = CKEDITOR.instances['desc1'].getData().replace(/<[^>]*>/gi, '').length;
                var desc2 = CKEDITOR.instances['desc1'].getData().replace(/<[^>]*>/gi, '').length;

                valid = true;
            
                $(".errortext").remove();
    
                if(title == '') {
                    $('#title').after('<span class="errortext" style="color:red">title cannot be blank.</span>');	       
                    valid = false;
                }
                if (!desc1) {
                    // alert('CKEditor content cannot be empty.');
                    $('#desc1').after('<span class="errortext" style="color:red">Description cannot be blank.</span>');	       
                    valid = false;
                } 
                if (!desc2) {
                    // alert('CKEditor content cannot be empty.');
                    $('#desc2').after('<span class="errortext" style="color:red">Short description cannot be blank.</span>');	       
                    valid = false;
                }  
                if(image1 == '') {
                    $('#image1').after('<span class="errortext" style="color:red">image cannot be blank.</span>');       
                    valid = false;
                }
                // if(image2 == '') {
                //     $('#image2').after('<span class="errortext" style="color:red">image cannot be blank.</span>');       
                //     valid = false;
                // }
                if( !valid ){       
                    return valid;
                }	
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "add-headerSlider.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success: function (response) {
                        // alert(response); exit false;
                        window.location.href='header_slider_list.php';
                    }
                });
            // new DataTable('#countryform');
            });
        });

        function backuserpage() {
            window.location = "header_slider_list.php";
        }
    </script>
</body>

</html>

