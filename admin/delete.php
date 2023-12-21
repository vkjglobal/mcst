
<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];

    // Perform the delete operation
    $sql = "DELETE FROM users WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);

    if ($query->execute()) {
            // Set a success message in URL parameter
            $redirectURL = 'user-list.php?success=user+data+deleted+successfully.';
            // header('Location:'.$redirectURL); ?>
            <script type="text/javascript">
                window.location.href = '<?php echo $redirectURL; ?>';
            </script>
    <?php
            exit();
        } else {
            // Set a success message in URL parameter
            $redirectURL = 'user-list.php?success=user+data+failed+to+delete.';
            // header('Location:'.$redirectURL); ?>
            <script type="text/javascript">
                window.location.href = '<?php echo $redirectURL; ?>';
            </script>
    <?php
    exit();
        }
        // Redirect to user-list.php
        // header('Location: user-list.php');
} else {
    echo "Invalid request method or user ID not specified.";
}
?>