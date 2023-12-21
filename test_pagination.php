<?php
echo phpinfo();exit;
if (extension_loaded('zip')) {
    echo 'Zip extension is enabled.';
} else {
    echo 'Zip extension is not enabled.';
}
//============================================
echo "hhhh";exit;
// Sample data (you should replace this with your actual data)
$totalItems = 50; // Total number of items
$itemsPerPage = 10; // Number of items to display per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Calculate the offset for the SQL query based on the current page
$offset = ($currentPage - 1) * $itemsPerPage;

// Your data retrieval logic goes here (e.g., fetching items from a database)
$items = range($offset + 1, $offset + $itemsPerPage); // Sample items, replace with your data

// Display the items for the current page
echo '<ul>';
foreach ($items as $item) {
    echo '<li>Item ' . $item . '</li>';
}
echo '</ul>';

// Display pagination links
echo '<div class="pagination">';
if ($totalPages > 1) {
    echo '<span>Page ' . $currentPage . ' of ' . $totalPages . '</span>';
    
    // Previous page link
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
    }
    
    // Page links
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo '<span>' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }
    
    // Next page link
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
    }
}
echo '</div>';
?>
