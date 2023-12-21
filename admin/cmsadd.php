<?php
include_once 'includes/header.php'; 
@include 'config.php'; // Include your PDO database connection file
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    // Fetch distinct options from the "menu" table
    $query = "SELECT * FROM menus";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    // $title = $_POST['title'];
    $url = $_POST['url'];
    $order=$_POST['order'];
    $status=$_POST['status'];
    $new="SELECT menu from menus where _id=:status";
    $stmt = $dbh->prepare($new);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT); // Assuming _id is an integer
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $value = $result['menu'];



    try {
    
        $stmt = $dbh->prepare("INSERT INTO cms (title,content,external_url,`order`,menu_id,`menu__-`) VALUES (:value,:content,:url,:order,:status,:value)");

        $stmt->bindParam(':content', $content);
        // $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':order', $order);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        
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
    } catch (PDOException $e) {
        $msg = "Error: " . $e->getMessage();
        echo $msg;

    }
}

include_once 'includes/header.php'; 

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
                                    <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add CMS</strong>
                                    <form class="row" method="POST" onsubmit="return validateForm()">
                                    <div id="valid"></div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label>Menu</label>
                                                    <select class="form-control border" name="status" id="status">
                                                    <?php foreach ($options as $option) { ?>
                                                        <option value="<?php echo $option['_id'];;?>"><?php echo $option['menu']; ?></option>
                                                    <?php } ?>  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div> -->
                                        <div class="col-md-6 mb-3">
                                            <label for="url">External URL</label>
                                            <input type="text" class="form-control" id="url" name="url">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="order">order</label>
                                            <input type="number" class="form-control" id="order" name="order">
                                        </div>
                                        
                                        <div class="col-12 mb-3">
                                            <label for="content">Content</label>
                                            <textarea id="content" name="content" class="form-control"></textarea>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <button type="submit" name="submit" class="btn btn-primary btn-typ4">Save</button>
                                            <button type="button" onclick="redirectToAnotherPage()" class="btn btn-primary btn-typ3 ms-2">Cancel</button>
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
                                    <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">CMS Added</h1>
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