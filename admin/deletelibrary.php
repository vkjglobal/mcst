
<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];
try{
    // Perform the delete operation
    $sql = "DELETE FROM libraries WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    var_dump($_id);
    if ($query->execute()) {
        // Redirect back to the user list page after deletion
        header('Location: librarylist.php?sucess=1');
        exit();
    } else {
        // Handle the error, if any
        header('Location: index1.php?error=1');
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