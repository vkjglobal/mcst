<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();

if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  
   $partners    =  $objGen->getPartnersList();
//  print_r($partners); exit;
}

?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $aboutUsList['title'] ?></h2>
        </div>
    </section>
    <section class="partners-section listing-page mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
           <?php echo $aboutUsList['content']; ?>
            <h4 class="hd-typ5 mb-5"><span>Our Partners</span></h4>
            <div class="row g-2">
            <!-- ======================  -->
             <?php foreach($partners as $k => $val){
                 if(!empty($val['image'])) {?>
                <div class="col-md-4 col-sm-6">
                    <div class="item-wrp">
                        <div class="img-wrp">
                            <img src="<?php echo $val['image']; ?>" alt="">
                        </div>
                        <a href="partners-details.php?id=<?php echo base64_encode($val['_id']);?>" class="btn more-btn more-btn-blue">View Partners</a>
                    </div>
                </div>
                   <?php } } ?>
                <!-- ======================  -->
                <!-- ======================  -->
            </div>
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