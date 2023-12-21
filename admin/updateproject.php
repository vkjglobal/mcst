<?php
include_once 'includes/header.php';
include_once 'config.php';
$uid=intval($_GET['uid']);	
if (isset($_POST['submit'])) {
    
    $title = $_POST['title'];
    $update_date = date('Y-m-d H:i:s');
    $url=$_POST['url'];
    $content = $_POST['content'];
    $stat = isset($_POST['stat']) ? $_POST['stat'] : ''; 
    $image=$_POST['image'];
    // Insert the new menu into the "menus" table
    $sql = "UPDATE projects set title=:title,updated_at=:update_date,url=:url,status=:stat,content=:content,image=:image WHERE _id=:uid";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':title', $title, PDO::PARAM_STR);
    $sql->bindParam(':update_date', $update_date, PDO::PARAM_STR);
    $sql->bindParam(':uid', $uid, PDO::PARAM_INT);
    $sql->bindParam(':stat', $stat, PDO::PARAM_STR);
    $sql->bindParam(':url', $url, PDO::PARAM_STR);
    $sql->bindParam(':content', $content, PDO::PARAM_STR);
    $sql->bindParam(':image', $image, PDO::PARAM_STR);
    try {    
        // Check for successful update
        if ($sql->execute()) {
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
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage(); // Log or display the error
    }   
}
?>
            <script>
                function displayFileName() {
                    const fileInput = document.getElementById('image');
                    const label = document.querySelector('.uploadFile');
                    const fileNameSpan = document.querySelector('.filename');

                    if (fileInput.files.length > 0) {
                        fileNameSpan.textContent = fileInput.files[0].name;
                        label.style.border = '1px solid #ced4da';
                    } else {
                        fileNameSpan.textContent = '';
                    }
                }
            </script>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                        <?php 
                            $uid=intval($_GET['uid']);
                            $sql = "SELECT * from projects where _id=:uid";
                            $query = $dbh -> prepare($sql);
                            $query -> bindParam(':uid', $uid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {	?>
                            <form method="POST">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Update Projects</h5>

                                    <div class="col-md-6 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required="" value="<?php echo htmlentities($result->title);?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" id="url" name="url" required="" value="<?php echo htmlentities($result->url);?>">
                            </div>
                                    
                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <label class="uploadFile form-control">
                                    <span class="filename"><?php echo htmlentities($result->image); ?></span>
                                    <input type="file" class="inputfile" name="image" id="image" onchange="displayFileName()" >
                                </label>
                                <span class="d-block">Note: Maximum Image Size 1000 kb</span>
                            </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Category</label>

                                                <select class="form-control border" name="stat" id="stat">
                                                <option value="Current" <?php if ($result->status === "Current") echo "selected"; ?>>Current</option>
                                                <option value="Completed" <?php if ($result->status === "Completed") echo "selected"; ?>>Completed</option>
   

                                                </select>

                
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-12 mb-3">
                                <label for="content">Content</label>
                                
                                <textarea id="content" name="content" class="form-control"required="" > </textarea>
                                
                            </div>
                                <div class="col-12 d-flex"><button type="submit"
                                        class="btn btn-primary btn-typ4" name="submit" >SAVE</button>
                                        <button type="reset" value="Clear" onclick="redirectToAnotherPage()" 
                                        class="btn btn-primary btn-typ3 ms-2">CANCEL</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }} ?>  
                </div>
                <!-- User List End -->
                <!--Start -->
                <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Project Updated</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="redirectToAnotherPage()" ></button>
                            </div>      
                        </div>
                    </div>
                </div>
                <!--  End -->
            </div>
            <?php include_once 'includes/footer.php'; ?>
            <script>
                function redirectToAnotherPage() {

                    window.location.href = "project_list.php"; 
                }
            </script>
        </div>
        <!-- Content End -->
     </div>

</body>

</html>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#content' ), {
        config: 'document'
    })
    .then(editor => {
        
        editor.setData(`<?php echo $result->content; ?>`);

        document.querySelector('form').addEventListener('submit', function() {
            const textContent = editor.getData({ dataText: false }); // Set dataText to false
            document.querySelector('#content').value = textContent;
        });
    })
    .catch(error => {
        console.error(error);
    });

</script>