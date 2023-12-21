<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('includes/header.php');
include_once('includes/dbConnect.php');
$itemsPerPage = 3; // Change this to 3 items per page
try {
    $query1 = "SELECT * FROM `cms` WHERE `menu__-` LIKE 'Break%' ORDER BY `created_at` DESC ";
    $totalItems = $conn->query($query1)->rowCount();
    $totalPages = ceil($totalItems / $itemsPerPage);
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;
    $query1 .= " LIMIT $offset, $itemsPerPage";
    $stmt = $conn->prepare($query1);
    $stmt->execute();
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<body>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1">Breaking News</h2>
        </div>
    </section>
    <section class="news-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <ul class="post-wrp">
                <?php
                foreach ($history as $h) { ?>
                    <li class="news-list-item">
                        <div class="row g-lg-5 g-3">
                            <h3 class="hd-typ2 mb-3"><a href="hlpu.php?id=<?php echo base64_encode($h['_id']); ?>"><?php echo $h['title']; ?></a></h3>
                            <div class="news-text-content">
                                <p><?php echo $h['content']; ?></p>
                                <?php
                                $date = $h['created_at']; // Assuming $p['created_at'] contains the date-time value
                                $formattedDate = date('Y-m-d', strtotime($date));
                                ?>
                                Posted on - <?php echo $formattedDate; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <ol class="post-list-bottom">
                <?php
                if (count($history) == $itemsPerPage && $currentPage < $totalPages) {
                    $nextPage = $currentPage + 1;
                    $nextPageOffset = $offset + $itemsPerPage;
                    $nextPageQuery = "SELECT * FROM `cms` WHERE `menu__-` LIKE 'Break%' ORDER BY `created_at` DESC LIMIT $nextPageOffset, $itemsPerPage";
                    $stmt = $conn->prepare($nextPageQuery);
                    $stmt->execute();
                    $nextPageItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($nextPageItems as $h) : ?>
                        <li><a href="hlpu.php?id=<?php echo base64_encode($h['_id']); ?>"><?php echo $h['title']; ?></a></li>
                    <?php endforeach;
                }
                ?>
            </ol>
            <div class="pagination">
                <p class="counter pull-right order-lg-1"> Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?> </p>
                <ul>
                    <li class="pagination-start"><a href="?page=1" class="pagenav">Start</a></li>
                    <li class="pagination-prev">
                        <?php if ($currentPage > 1) : ?>
                            <a href="?page=<?php echo ($currentPage - 1); ?>" class="pagenav">Prev</a>
                        <?php else : ?>
                            <span class="pagenav">Prev</span>
                        <?php endif; ?>
                    </li>

                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) {
                            echo '<li><span class="pagenav">' . $i . '</span></li>';
                        } else {
                            echo '<li><a href="?page=' . $i . '" class="pagenav">' . $i . '</a></li>';
                        }
                    }
                    ?>

                    <li class="pagination-next">
                        <?php if ($currentPage < $totalPages) : ?>
                            <a href="?page=<?php echo ($currentPage + 1); ?>" class="pagenav">Next</a>
                        <?php else : ?>
                            <span class="pagenav">Next</span>
                        <?php endif; ?>
                    </li>
                    <li class="pagination-end"><a href="?page=<?php echo $totalPages; ?>" class="pagenav">End</a></li>
                </ul>
            </div>
        </div>
    </section>
    <?php include_once('includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/top-megamenu.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.home-banner').owlCarousel({
                loop: false,
                autoplay: false,
                mouseDrag: false,
                nav: false,
                dots: false,
                items: 1,
                smartSpeed: 450
            });
        })
    </script>
</body>
</html>
