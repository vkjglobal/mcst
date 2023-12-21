
<?php
ob_start(); // Start output buffering
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];
try{
    // Perform the delete operation
    $sql = "DELETE FROM menus WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    // var_dump($_id);
    // Delete succeeded
    if ($query->execute()) {
        // Set a success message in URL parameter
        $redirectURL = 'menu.php?success=Menu+item+deleted+successfully.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
        exit();
    } else {
        // Deletion failed
        echo '<div id="errorMessage" class="alert alert-danger"><center>Failed to delete menu item.</center></div>';
    }
} catch (PDOException $e) {
    // Handle database-related errors
    echo "Database Error: " . $e->getMessage();
    error_log("Database Error: " . $e->getMessage(), 0);
}
} else {
    echo "Invalid request method or user ID not specified.";
}
ob_end_flush(); // Flush the output buffer
?>