<?php 
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  $CurrentProj    =  $objGen->getProjectTitle('Current');
   $CompletedProj    =  $objGen->getProjectTitle('Completed');
 // print_r($CurrentProj); exit;
}
?>

    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $aboutUsList['title'] ?></h2>
        </div>
    </section>
    <section class="projects-section listing-page pb-xl-5 pb-lg-4 pb-3">
        <div class="container">
            <h3 class="hd-typ2 mb-4"></h3>
            <p class="mb-lg-5 mb-4">
               <?php echo $aboutUsList['content']; ?>
            </p>
            <h4 class="hd-typ5 mb-5"><span>Current Projects</span></h4>
            <div class="row g-2">
                <div class="project-slider owl-carousel owl-theme">
                <?php foreach($CurrentProj as $k => $val){ ?>
                    <div class="item">
                        <div class="item-wrp">
                            <div class="img-wrp flex-column mb-4">
                                <h3 class="hd-typ2 mb-3"><?php echo $val['title']; ?></h3>
                              <!--  <img src="images/mcst-website-pic-tlcseat1.png" alt=""> -->
                             <div class="thumbImg" style="background-image: url(<?php echo $val['image']; ?>);"></div>

                           <!--   <img src="<?php echo $val['image']; ?>"  class="img-fluid" alt=""> -->
                            </div>
                            <p class="text-justify">
                            <?php
                            $content    =    $val['content'];
                             $lines = explode("<p>", $content); // Split the content into lines
                       //  echo "LLLLLLLLLLLLLLLL"; print_r($lines);
                    // Remove lines 1 and 3, and keep the next 10 lines
                    unset($lines[0]);                

                    // Reconstruct the content with line breaks
                    $displayContent = implode("<p>", $lines);
                  // echo "MMMMMMMMM"; print_r($displayContent);
                  $plainTextContent = strip_tags($content);
                    $maxLength = 100; // Maximum length for the short description
                $shortDescription = substr($plainTextContent, 0, $maxLength);

                    echo $shortDescription;
                    ?>
                            </p>
                            <a href="projects-listing.php?id=<?php echo base64_encode($val['_id']);?>" class="btn more-btn more-btn-blue">Learn More</a>
                        </div>
                    </div>
                    <?php } ?>
                  
                </div>
                
            </div>
        </div>
    </section>
    <section class="projects-section completed-projects listing-page pt-4 pb-xl-5 pb-lg-4 pb-3">
        <div class="container">
            <h4 class="hd-typ5 mb-5"><span>Completed Projects</span></h4>
            <div class="row g-2">
                <div class="project-slider owl-carousel owl-theme">
                 <!-- ===================================== --> 
                 <?php foreach($CompletedProj as $k => $val){ ?>
                    <div class="item">
                        <div class="item-wrp">
                            <div class="img-wrp flex-column mb-4">
                                <h3 class="hd-typ2 mb-3"><?php echo $val['title']; ?></h3>
                                  <div class="thumbImg" style="background-image: url(<?php echo $val['image']; ?>);"></div>
                              <!--  <img  class="img-fluid" src="<?php echo $val['image']; ?>" alt=""> -->
                            </div>
                            <p class="text-justify">
                                 <?php
                            $content    =    $val['content'];
                             $lines = explode("<p>", $content); // Split the content into lines
                       //  echo "LLLLLLLLLLLLLLLL"; print_r($lines);
                    // Remove lines 1 and 3, and keep the next 10 lines
                    unset($lines[0]);                

                    // Reconstruct the content with line breaks
                    $displayContent = implode("<p>", $lines);
                  // echo "MMMMMMMMM"; print_r($displayContent);
                  $plainTextContent = strip_tags($content);
                    $maxLength = 100; // Maximum length for the short description
                $shortDescription = substr($plainTextContent, 0, $maxLength);

                    echo $shortDescription;
                    ?>
                            </p>
                            <a href="projects-listing.php?id=<?php echo base64_encode($val['_id']);?>" class="btn more-btn">Learn More</a>
                        </div>
                    </div>
                     <?php } ?>
                     <!-- ===================================== -->
                    
                </div>
            </div>
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