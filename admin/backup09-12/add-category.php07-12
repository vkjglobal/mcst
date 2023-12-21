<?php

@include 'config.php';
function getCategoryName($options, $categoryId) {
    foreach ($options as $option) {
        if ($option['_id'] == $categoryId) {
            return $option['category'];
        }
    }
    return "null"; // Default to "parent" if not found
}
try {
    // Fetch distinct options from the "menu" table
    $query = "SELECT * FROM categories where `parent__-` ='parent'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form has been submitted

    // Retrieve form data
    $parent_category_id = $_POST['parent_category_id'];
    $menu = $_POST['menu'];
    $parent = getCategoryName($options, $parent_category_id);
    if ($parent_category_id == 0) {
        $parent = "parent"; // Set to "parent" if it's 0
    }
    $created_date = date('Y-m-d H:i:s');
    try {
    // Insert the new menu into the "menus" table
    $insertQuery = "INSERT INTO categories (category,parent_category_id,`parent__-`,created_at) VALUES (:menu, :parent_category_id,:parent,:created_date)";
    $insertStmt = $dbh->prepare($insertQuery);
    $insertStmt->bindParam(':parent_category_id', $parent_category_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':menu', $menu, PDO::PARAM_STR);
    $insertStmt->bindParam(':parent', $parent, PDO::PARAM_STR);
    $insertStmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
    $insertStmt->execute();
    echo '<script>';
                echo 'alert("Data Inserted");';
                echo 'window.location.href = "category-list.php";'; // Change "redirect_page.php" to the desired page
                echo '</script>';

    // Redirect to a success page or perform other actions as needed
    
    exit();
} catch (PDOException $e) {
    echo "Insertion failed: " . $e->getMessage();
}
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php' ?>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <form method="POST">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Add Category</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Category</label>
                                                <select class="form-control border" name="parent_category_id">
                                                <option value="0">Parent</option>
                <?php foreach ($options as $option) { ?>
                    <option value="<?php echo $option['_id'];;?>"><?php echo $option['category']; ?></option>
                <?php } ?>
                                                    

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>category</label>
                                                <input type="text" class="form-control border" name="menu" required="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <script>
    function redirectToAnotherPage() {
        // Use window.location.href to redirect to the desired page
        window.location.href = "category-list.php"; // Replace with the actual page URL
    }
</script>
                                    <div class="col-12 d-flex"><button type="submit"
                                            class="btn btn-primary btn-typ4" name="save_menu" >SAVE</button>
                                            <button type="button"
                                            class="btn btn-primary btn-typ3 ms-2" onclick="redirectToAnotherPage()">CANCEL</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- User List End -->
            </div>
          
            <?php include_once 'includes/footer.php'; ?>
</body>

</html>