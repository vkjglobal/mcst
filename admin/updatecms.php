<?php
include_once 'includes/header.php';
include_once 'config.php';
$uid=intval($_GET['uid']);	
if (isset($_POST['submit'])) {
    
    $menu = $_POST['menu'];
    $update_date = date('Y-m-d H:i:s');
    $url=$_POST['url'];
    $order=$_POST['order'];
    $content = $_POST['content'];
    // Insert the new menu into the "menus" table
    $sql = "UPDATE cms set title=:menu,updated_at=:update_date,external_url=:url,`order`=:order,content=:content WHERE _id=:uid";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':menu', $menu, PDO::PARAM_STR);
    $sql->bindParam(':update_date', $update_date, PDO::PARAM_STR);
    $sql->bindParam(':uid', $uid, PDO::PARAM_INT);
    $sql->bindParam(':order', $order, PDO::PARAM_INT);
    $sql->bindParam(':url', $url, PDO::PARAM_STR);
    $sql->bindParam(':content', $content, PDO::PARAM_STR);
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
}
?>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                        <?php 
                            $uid=intval($_GET['uid']);
                            $sql = "SELECT * from cms where _id=:uid";
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
                                    <h5 class="fw-normal">Update Category</h5>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Category</label>

                                                <select class="form-control border" name="parent_menu_id">
                                                    <option value="<?php echo htmlentities($result->menu_id); ?>">
                                                    <?php echo htmlentities($result->{'menu__-'}); ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>category</label>
                                                <input type="text" class="form-control border" name="menu" required="" value="<?php echo htmlentities($result->title);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>External url</label>
                                                <input type="text" class="form-control border" name="url" required="" value="<?php echo htmlentities($result->external_url);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Order</label>
                                                <input type="number" class="form-control border" name="order" required="" value="<?php echo htmlentities($result->order);?>">
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
            </div>
            <?php  include_once 'includes/footer.php';   ?> 
            <!--Start -->
            <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMore" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">CMS Updated</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="redirectToAnotherPage()" ></button>
                        </div>      
                    </div>
                </div>
            </div>
            <!--  End -->
            <script>
                function validateForm() {
                    var status = document.getElementById("status").value;
                    var url = document.getElementById("url").value;
                    var order = document.getElementById("order").value;
                    var content = document.getElementById("content").value;
                    var errorMessage = document.getElementById("valid");

                    // Reset error message
                    errorMessage.innerHTML = "";

                    // Validation checks on form submission
                    if (status.trim() === "" || url.trim() === "" || order.trim() === "" || content.trim() === "") {
                        errorMessage.innerHTML = "Please fill in all fields.";
                        return false;
                    }

                    // Validation passed
                    return true;
                }

                function redirectToAnotherPage() {
                    window.location.href = "cmslist.php"; // Redirect to another page
                }
            </script>
        </div>
        <!-- Content End -->
       </div>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
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