
<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];
try{
    // Perform the delete operation
    $sql = "DELETE FROM partners WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    // var_dump($_id);
    if ($query->execute()) {
        // header('Location: partner-list.php?sucess=1');
           // Set a success message in URL parameter
           $redirectURL = 'partner-list.php?success=Partner+data+deleted+successfully.';
           // header('Location:'.$redirectURL); ?>
           <script type="text/javascript">
               window.location.href = '<?php echo $redirectURL; ?>';
           </script>
   <?php
           exit();
       } else {
           // Deletion failed
           $redirectURL = 'partner-list.php?success=Partner+data+failed+to+delete.'; ?>
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