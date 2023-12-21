<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
include_once 'includes/class.cms.php';
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

 $projectDetails     =   $objGen->getProjectDetails($id); 
//   ------------------ menu publish/unpublish--------------------
    $cmsObj = new CMS();//call cms class
    $projectData = $cmsObj->getProject_status($id);
    // print_r($projectData);
    $data = '';
    // //  print_r($cmsData);
       if($projectData['status_i'] == 1){ 
           $data_title = $projectDetails['title'];
           $data_content = $projectDetails['content'];
       }else{  
            $data_title ='No title published';
           $data_content = 'No content published';  
       } 
//--------------------------------end------------------------------
}
?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $data_title; ?> </h2>
        </div>
    </section>
    <section class="projects-section listing-page pb-xl-5 pb-lg-4 pb-3">
        <div class="container">
            <h3 class="hd-typ2 mb-4"></h3>
            <p class="mb-lg-5 mb-4">
                <?php echo html_entity_decode($data_content, ENT_COMPAT, 'UTF-8');
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