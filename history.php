<?php
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
include_once 'includes/class.cms.php'; 
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id);

//----------------unpublic/public---------------------
    $cmsObj = new CMS();//call cms class

    $cmsData = $cmsObj->getCMSDetails($id);
    $data = '';
    // print_r($cmsData);
              if($cmsData['status'] == 0){ 
                  $data = $aboutUsList['content'];
              }else{  
                  $data = 'No content published';  
              }  
//-----------------------end----------------------------------
    $recentCurrentProj    =  end($objGen->getRecentcCurProj());
  //print_r($aboutUsList); exit;
}
?>
<!-- <section class="banner-section light-blue-bg mb-5 py-xl-5 py-lg-4 py-3">
    <div class="container">
        <div class="home-banner owl-carousel owl-theme">
            <div class="item">
                <div class="row">
                        <div class="col-lg-6 tab-abs">
                            <h2 class="mb-xl-4 mb-md-3 pe-xl-5 pe-lg-4">
                                <?php echo $recentCurrentProj['title']; ?>
                            </h2>
                            <p class="mb-xl-5 mb-xl-4 mb-md-3 me-lg-5 pe-lg-5">
                            <?php 
                            $content    =    $recentCurrentProj['content'];
                             $lines = explode("<p>", $content); // Split the content into lines
                       //  echo "LLLLLLLLLLLLLLLL"; print_r($lines);
                    // Remove lines 1 and 3, and keep the next 10 lines
                    unset($lines[0]);                

                    // Reconstruct the content with line breaks
                    $displayContent = implode("<p>", $lines);
                    $maxLength = 100; // Maximum length for the short description
                $shortDescription = substr($displayContent, 0, $maxLength);

                    echo $shortDescription;

                   
                            ?>
                            </p>
                            <a href="projects-listing.php?id=<?php echo base64_encode($recentCurrentProj['_id']);?>" class="btn more-btn">Learn More</a>
                        </div>
                    <div class="col-lg-6">
                        <div class="img-wrp">
                            <img src="images/slider-img1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="link-wrp container d-md-flex d-none justify-content-center">
        <div class="d-flex align-items-center">
                <a href="projects-listing.php?id=<?php echo base64_encode($recentCurrentProj['_id']);?>" class="rotate-link">
                <img src="images/round-text.svg" alt="">
            </a>
        </div>
    </div>
</section -->
<section class="about-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
    <div class="container">
         <?php echo $data; ?>
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