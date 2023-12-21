<?php
@include 'config.php';
$uid=intval($_GET['uid']);	
if (isset($_POST['submit'])) {
    
    $menu = $_POST['menu'];
    $update_date = date('Y-m-d H:i:s');
    // Insert the new menu into the "menus" table
    $sql = "UPDATE menus set menu=:menu,updated_at=:update_date WHERE _id=:uid";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':menu', $menu, PDO::PARAM_STR);
    $sql->bindParam(':update_date', $update_date, PDO::PARAM_STR);
    $sql->bindParam(':uid', $uid, PDO::PARAM_INT);
    $sql->execute();
    // Update succeeded
    if ($sql->rowCount() > 0) {
            // Set a success message in URL parameter
            $redirectURL = 'menu.php?success=Menu+item+updated+successfully.';
            // header('Location:'.$redirectURL); ?>
            <script type="text/javascript">
                window.location.href = '<?php echo $redirectURL; ?>';
            </script>
<?php
        exit();
    } else {
        // Update failed
        echo '<div id="errorMessage" class="alert alert-danger"><center>Failed to update menu item.</center></div>';
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
                        <?php 
                            $uid=intval($_GET['uid']);
                            $sql = "SELECT * from menus where _id=:uid";
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
                                    <h5 class="fw-normal">Update Menu</h5>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Parent Menu</label>

                                                <select class="form-control border" name="parent_menu_id">
                                                    <option value="<?php echo htmlentities($result->parent); ?>">
                                                        <?php echo htmlentities($result->parent); ?>
                                                    </option>
                                                </select>
                
                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label>Menu</label>
                                                <input type="text" class="form-control border" name="menu" required="" value="<?php echo htmlentities($result->menu);?>">
                                            </div>
                                        </div>
                                    </div>                                
                                    <div class="col-12 d-flex"><button type="submit"
                                        class="btn btn-primary btn-typ4" name="submit" >SAVE</button>
                                        <button type="reset" value="Clear" onclick="redirectToAnotherPage()" 
                                        class="btn btn-primary btn-typ3 ms-2">CANCEL</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }} ?>  
                </div>
                <!-- User List End -->
            </div>
           <?php include_once 'includes/footer.php'; ?>
           <script>
                function redirectToAnotherPage() {

                window.location.href = "menu.php"; 
                }
            </script>
        </div>
        <!-- Content End -->
    </div>

</body>

</html>