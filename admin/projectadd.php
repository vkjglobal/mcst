<?php
include_once 'includes/header.php';
@include 'config.php'; // Include your PDO database connection file

if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $status=$_POST['status'];
    
    $create_date = date('Y-m-d H:i:s');
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $menu="Projects";
    $stat=0;
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
            if($status=="Completed"){
                $parent_menu_id=59;
                $parent="Completed";
                
            
            }else
            {
                $parent_menu_id=58;
                $parent="Current";  
            
                
            }
            $pagem="projects-listing.php";
            $insertQuery = "INSERT INTO menus (menu,parent_menu_id,parent,created_at,pagename) VALUES (:title,:parent_menu_id,:parent,:create_date,:pagem)";
            $insertStmt = $dbh->prepare($insertQuery);
            $insertStmt->bindParam(':parent_menu_id', $parent_menu_id, PDO::PARAM_INT);
            $insertStmt->bindParam(':title', $title, PDO::PARAM_STR);
            $insertStmt->bindParam(':parent', $parent, PDO::PARAM_STR);
            $insertStmt->bindParam(':create_date', $create_date, PDO::PARAM_STR);
            $insertStmt->bindParam(':pagem',$pagem,PDO::PARAM_STR);
            

            $insertStmt->execute();
            $sql="Select `_id` from menus where menu=:title";
            $query = $dbh->prepare($sql);
            $query->bindParam(':title', $title);
            $query->execute();
            $menu_uid = $query->fetch(PDO::FETCH_ASSOC);
            $menu_id = $menu_uid['_id'];

            $stmt = $dbh->prepare("INSERT INTO projects (title,content,url,status,image,menu_id,status_i,`menu__-`,created_at) VALUES (:title,:content,:url,:status,:file_name,:menu_id,:stat,:menu,:create_date)");
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':file_name', $file_name);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':menu_id', $menu_id);
            $stmt->bindParam(':stat', $stat);
            $stmt->bindParam(':menu', $menu);
            $stmt->bindParam(':create_date',$create_date);
            $stmt->execute();
            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                echo "Database Error: " . $errorInfo[2];
            }
            if ($stmt->rowCount() > 0) {
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

    } catch (PDOException $e) {
        $msg = "Error: " . $e->getMessage();
    }
    
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
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add Project</strong>
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
                                        <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label>Status</label>
                                                            <select class="form-control border" name="status" id="status">
                                                                <option value="">Select</option>
                                                                <option value="Current">Current</option>
                                                                <option value="Completed">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="col-12 mb-3">
                                            <label for="content">Content</label>
                                            <textarea id="content" name="content" class="form-control"></textarea>
                                        </div>
                                        <script>
                                                function redirectToAnotherPage() {
                    
                                                    window.location.href = "project_list.php"; 
                                                }
                                            </script>
                                        <div class="col-12 d-flex">
                                            <button type="submit" name="submit" class="btn btn-primary btn-typ4">Save</button>
                                            <button type="button" onclick="redirectToAnotherPage()" class="btn btn-primary btn-typ3 ms-2">Cancel</button>
                                        </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                        </div>
                    </div>
                    <!-- Content End -->
                    <!--Start -->
                    <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">CMS Added</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="redirectToAnotherPage()" ></button>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <!--  End -->
        <?php include_once 'includes/footer.php'; ?>
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