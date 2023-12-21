<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['_id'])) {
    $_id = $_GET['_id'];

    try {
        // Check if the selected category has child categories
        $sqlCheckParent = "SELECT COUNT(*) FROM categories WHERE parent_category_id = :_id";
        $queryCheckParent = $dbh->prepare($sqlCheckParent);
        $queryCheckParent->bindParam(':_id', $_id, PDO::PARAM_INT);
        $queryCheckParent->execute();
        $childCategoryCount = $queryCheckParent->fetchColumn();
        echo $childCategoryCount;

        if ($childCategoryCount > 0) {
            echo "<script>
                    var result = confirm('This category is a parent category and has child categories. Are you sure you want to delete it?');
                    if (result) {
                        window.location.href = 'deletecategory.php?_id=' + $_id;
                    } else {
                        window.location.href = 'category-list.php';
                    }
                  </script>";
        } else {
            // The selected category is not a parent category, so it can be deleted
            // Perform the delete operation
            $sqlDeleteCategory = "DELETE FROM categories WHERE _id = :_id";
            $queryDeleteCategory = $dbh->prepare($sqlDeleteCategory);
            $queryDeleteCategory->bindParam(':_id', $_id, PDO::PARAM_INT);

            if ($queryDeleteCategory->execute()) {
                // Redirect back to the category list page after deletion
                header('Location: category-list.php?success=1');
                exit();
            } else {
                // Handle the error, if any
                header('Location: index1.php?error=1');
                exit();
            }
        }
    } catch (PDOException $e) {
        // Handle database-related errors
        echo "Database Error: " . $e->getMessage();
        error_log("Database Error: " . $e->getMessage(), 0);
    }
} else {
    echo "Invalid request method or category ID not specified.";
}
?>
