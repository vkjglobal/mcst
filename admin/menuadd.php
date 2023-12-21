<?php
@include 'config.php';
function getCategoryName($options, $menuId) {
    foreach ($options as $option) {
        if ($option['_id'] == $menuId) {
            return $option['menu'];
        }
    }
    return "null"; // Default to "parent" if not found
}
try {
    // Fetch distinct options from the "menu" table
    $query = "SELECT * FROM menus";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form has been submitted

    // Retrieve form data
    $parent_menu_id = $_POST['parent_category_id'];
    $menu = $_POST['menu'];
    // echo $content;
    $pagename = $_POST['content'];
    
    // $parent = getCategoryName($options, $parent_menu_id);
    if ($parent_menu_id == 0) {
        $parent = "Parent"; // Set to "parent" if it's 0
    }else{
        $parent = getCategoryName($options, $parent_menu_id);
    }
    $created_date = date('Y-m-d H:i:s');
    $updated_date = date('Y-m-d H:i:s');
    try {
    // Insert the new menu into the "menus" table
    $insertQuery = "INSERT INTO menus (menu,parent_menu_id,parent,pagename,created_at,updated_at) VALUES (:menu,:parent_menu_id,:parent,:pagename,:created_date,:updated_date)";
    $insertStmt = $dbh->prepare($insertQuery);
    $insertStmt->bindParam(':menu', $menu, PDO::PARAM_STR);
    $insertStmt->bindParam(':parent_menu_id', $parent_menu_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':parent', $parent, PDO::PARAM_STR);
    $insertStmt->bindParam(':pagename', $pagename, PDO::PARAM_STR);
    $insertStmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
    $insertStmt->bindParam(':updated_date', $updated_date, PDO::PARAM_STR);
    // Insertion succeeded
    if($insertStmt->execute()) { 
        // Set a success message in URL parameter
        $redirectURL = 'menu.php?success=Menu+item+added+successfully.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
        exit();
    } else {
        // Insertion failed
        echo '<div id="errorMessage" class="alert alert-danger"><center>Failed to add menu item.</center></div>';
    }
    // Redirect to a success page or perform other actions as needed
    header('Location: menu.php');
    exit();
} catch (PDOException $e) {
    echo "Insertion failed: " . $e->getMessage();
}
}
?>
<?php include_once 'includes/header.php'; ?>
            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                            <form method="POST">
                                <div class="row" id="editprofile" style="display: flex;">
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Add Menu</h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Menu</label>
                                                <select class="form-control border" name="parent_category_id">
                                                    <option value="0">Select an option</option>
                                                    <?php foreach ($options as $option) { ?>
                                                        <option value="<?php echo $option['_id'];;?>"><?php echo $option['menu']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Menu</label>
                                                <input type="text" class="form-control border" name="menu" required="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label><input type="checkbox" name="content" value="about-us.php">Menu content</label>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function redirectToAnotherPage() {
            
                                            window.location.href = "menu.php"; 
                                        }
                                    </script>
                                
                                    <div class="col-12 d-flex"><button type="submit"
                                        class="btn btn-primary btn-typ4" name="save_menu" >SAVE</button>
                                        <button type="button" onclick="redirectToAnotherPage()" class="btn btn-primary btn-typ3 ms-2">CANCEL</button>
                                    </div>
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