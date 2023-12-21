<?php
// Include the config.php file and any necessary database connections here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_id'])) {
    $_id = $_POST['_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update the user's details in the database
    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE _id = :_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':_id', $_id, PDO::PARAM_INT);
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    if ($query->execute()) {
        // Redirect back to the user list page after updating
        header('Location: user-list.php');
        exit();
    } else {
        // Handle the error, if any
        echo "Error updating user.";
    }
} else {
    echo "Invalid request method or user ID not specified.";
}
?>
