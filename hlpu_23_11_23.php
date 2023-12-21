<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  //print_r($aboutUsList); exit;
}
?>
 <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $aboutUsList['title']; ?></h2>
        </div>
    </section>
    
    <section class="partners-section details-page mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
           <?php echo $aboutUsList['content']; ?>
        </div>
    </section>
        <?php
include_once('includes/footer.php');
?>
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