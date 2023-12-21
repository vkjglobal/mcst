<?php 

error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.cms.php');
 $cmsObj    =   new CMS();
if(isset($_GET['id'])){
    
    $id =  $_GET['id'];

    $hsDetails = $cmsObj->getContentDetails($id); 
}
?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $hsDetails['title']; ?> </h2>
        </div>
    </section>
    <section class="projects-section listing-page pb-xl-5 pb-lg-4 pb-3">
        <div class="container">
            <h3 class="hd-typ2 mb-4"></h3>
            <p class="mb-lg-5 mb-4">
                <?php echo html_entity_decode($hsDetails['description']);
                 ?>
            </p>
            
        </div>
    </section>
    <?php
include_once('includes/footer.php');
?>
    <script>
        $(document).ready(function () {
            $('.project-slider').owlCarousel({
                loop: true,
                autoplay: false,
                mouseDrag: true,
                nav: false,
                dots: true,
                margin: 12,
                items: 3,
                smartSpeed: 450,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    992:{
                        items:3
                    }
                }
            });
        })
    </script>
</body>

</html>