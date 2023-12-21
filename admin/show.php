<?php
@include 'config.php';

$id = $_GET['d_id'];
$status = $_GET['status'];
$table=$_GET['table'];
$name=$_GET['name'];

$sql = "UPDATE $table SET status_i = :status WHERE `_id` = :id";
$stmt = $dbh->prepare($sql);


$stmt->bindParam(':status', $status, PDO::PARAM_INT);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the update
if ($stmt->execute()) {

    header("location: $name");
} else {
    // Handle the case where the update fails (e.g., display an error message)
    echo "Update failed!";
}
?>
