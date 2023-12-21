<?php
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
include_once 'includes/class.cms.php'; 
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

 $partnerDetails     =   $objGen->getPartnerDetails($id); 
 if(!empty($partnerDetails['url'])){
 $redirectURL = $partnerDetails['url'];?>
<script>
    window.location="<?php $redirectURL ?>"  </script>
     
 <?php }
//   ------------------ menu publish/unpublish--------------------
$cmsObj = new CMS();//call cms class
$projectData = $cmsObj->getPartners_status($id);
// print_r($projectData);
$data = '';
// //  print_r($cmsData);
   if($projectData['status_i'] == 1){ 
       $data_title = $partnerDetails['title'];
       $data_content = $partnerDetails['content'];
   }else{  
        $data_title ='No title published';
       $data_content = 'No content published';  
   } 
//--------------------------------end------------------------------

}

?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $data_title; ?></h2>
        </div>
    </section>
    <section class="partners-section details-page mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
        <?php echo $data_content; ?>
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