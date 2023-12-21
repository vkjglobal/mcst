
<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];
try{
    // Perform the delete operation
    $sql = "DELETE FROM cms WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    // var_dump($_id);
    if ($query->execute()) {
        
        // Set a success message in URL parameter
        $redirectURL = 'cmslist.php?success=CMS+item+deleted+successfully.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
        exit();
    } else {
        // Set a success message in URL parameter
        $redirectURL = 'cmslist.php?success=CMS+item+failed+to+delete.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
    }
    
} catch (PDOException $e) {
    // Handle database-related errors
    echo "Database Error: " . $e->getMessage();
    error_log("Database Error: " . $e->getMessage(), 0);
}
} else {
    echo "Invalid request method or user ID not specified.";
}
?>