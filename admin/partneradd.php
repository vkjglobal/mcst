<?php
include_once 'includes/header.php';
@include 'config.php'; // Include your PDO database connection file

if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name']; 
    $create_date = date('Y-m-d H:i:s');
    $upadte_date;
    $menu_id='2';
    $menu="Partners";
    $stat=0;
    // echo "filename:$file_name";
    if (!empty($file_name)) {
        // Upload directory
        $upload_dir = 'imagepic/';

        // Check if the upload directory exists; if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $uploadError = $_FILES['image']['error'];
        if ($uploadError !== UPLOAD_ERR_OK) {
            // Handle the upload error
            echo "Upload failed with error code: $uploadError";
        } else {
            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
    try {
        $parent_menu_id=2;
        $parent="Partners";
        $pagem="partners-details.php";
        $insertQuery = "INSERT INTO menus (menu,parent_menu_id,parent,created_at,pagename,updated_at) VALUES (:title,:parent_menu_id,:parent,:create_date,:pagem,:update_date)";
        $insertStmt = $dbh->prepare($insertQuery);
        $insertStmt->bindParam(':parent_menu_id', $parent_menu_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':title', $title, PDO::PARAM_STR);
        $insertStmt->bindParam(':parent', $parent, PDO::PARAM_STR);
        $insertStmt->bindParam(':create_date', $create_date, PDO::PARAM_STR);
        $insertStmt->bindParam(':pagem',$pagem,PDO::PARAM_STR);
        $insertStmt->bindParam(':update_date',$update_date);
        $insertStmt->execute();
        $sql="Select `_id` from menus where menu=:title";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title);
        $query->execute();
        $menu_uid = $query->fetch(PDO::FETCH_ASSOC);
        $menu_id = $menu_uid['_id'];

        
        $stmt = $dbh->prepare("INSERT INTO partners (title,content,url,image,menu_id,`menu__-`,status_i,created_at,updated_at) VALUES (:title,:content,:url,:file_name,:menu_id,:menu,:stat,:create_date,:update_date)");
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':file_name', $file_name);
        $stmt->bindParam(':menu_id', $menu_id);
        $stmt->bindParam(':menu', $menu);
        $stmt->bindParam(':stat', $stat);
        $stmt->bindParam(':create_date',$create_date);
        $stmt->bindParam(':update_date',$update_date);
        $stmt->execute();
        // echo "Number of rows affected: " . $stmt->rowCount();
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            // echo "Database Error: " . $errorInfo[2];
        }
        if ($stmt->rowCount() > 0) {
            // $msg = "Data Inserted";
            // $msg = "Data Inserted";
            echo "<script>";
            echo "document.addEventListener('DOMContentLoaded', function() {";
            echo "    var addsuccesspop = document.getElementById('addsuccesspop');";
            echo "    if (addsuccesspop) {";
            echo "        addsuccesspop.classList.add('show');";
            echo "        addsuccesspop.style.display = 'block';";
            echo "    }";
            echo "});";
            echo "</script>";
        } else {
            $msg = "Error";
        }
        $uploadError = $_FILES['image']['error'];
        // if ($stmt->rowCount() > 0) {
        //     $msg = "Data Inserted";
        // } else {
        //     $msg = "Error";
        // }
    } catch (PDOException $e) {
        $msg = "Error: " . $e->getMessage();
    }
    echo $msg;
}
else {
    $msg = "Error uploading the file.";
}}
} else {
$msg = "Please select a file to upload.";
}
}
?>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <!-- Account Settings Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <div class="row" id="editprofile" style="display: flex;">
                                <div class="col-12">
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add Partner</strong>
                                    <form class="row" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control" id="url" name="url">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image</label>
                                            <label class="uploadFile form-control">
                                                <span class="filename"></span>
                                                <input type="file" class="inputfile" name="image" id="image">
                                            </label>
                                            <span class="d-block">Note: Maximum Image Size 1000 kb</span>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Content</label>
                                            <textarea id="content" name="content" class="form-control"></textarea>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <button type="submit" name="submit" class="btn btn-primary btn-typ4">Save</button>
                                            <button type="button" class="btn btn-primary btn-typ3 ms-2" onclick="redirectToAnotherPage()">Cancel</button>
                                        </div>
                                    </form>
                                </div>    
                            </div>
                        </div>
                       <?php include_once 'includes/footer.php'; ?>
                       <script>
                            function redirectToAnotherPage() {
                                // Use window.location.href to redirect to the desired page
                                window.location.href = "partner-list.php"; // Replace with the actual page URL
                            }
                        </script>
                    </div>
                    <!-- Content End -->
                    <!--Start -->
                    <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Partner data Added</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="redirectToAnotherPage()" ></button>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <!--  End -->
                </div>
            </div>
</body>

</html>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ),{
            ckfinder:
            {
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })
        .catch( error => {
            console.error( error );
        });
</script>