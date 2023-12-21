
<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];
try{
    // Perform the delete operation
    $sql = "DELETE FROM projects WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    // var_dump($_id);
    if ($query->execute()) {
        // Set a success message in URL parameter
        $redirectURL = 'project_list.php?success=Project+item+deleted+successfully.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
        exit();
    } else {
        // Set a success message in URL parameter
        $redirectURL = 'project_list.php?success=Project+item+failed+to+delete.';
        // header('Location:'.$redirectURL); ?>
        <script type="text/javascript">
            window.location.href = '<?php echo $redirectURL; ?>';
        </script>
<?php
    exit();
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