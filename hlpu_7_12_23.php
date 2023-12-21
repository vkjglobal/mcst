<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
include_once 'includes/class.cms.php';
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  //print_r($aboutUsList); exit;
}
//   ------------------pupblish/unpublish--------------------
$cmsObj = new CMS();//call cms class

$cmsData = $cmsObj->getCMSDetails($id);
$data = '';
// print_r($cmsData);
            if($cmsData['status'] == 0){ 
                $data_title = $aboutUsList['title'];
                $data_content = $aboutUsList['content'];
            }else{  
                $data_title = 'no data';
                $data_content = 'No content published';  
            } 
//---------------------end------------------------------
?>
 <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1"><?php echo $data_title; ?></h2>
        </div>
    </section>
    
    <section class="partners-section details-page mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
           <?php echo $data_content; 
           if($id   ==  '806'){
               $result     =   $objGen->getFilesPublic(); 
               
             //   print_r($FileList); 
               // special content like member pdfs for e learning menu
               ?>
                <h2>Files From MCST Members</h2>
                <ul>
                <?php
                foreach($result as $k =>$res){
                    $postFile            =   $res['file_upload'];
               $postDate            =   $res['created_at'] ;
                $postedBy               =   $res['first_name'] .$res['last_name'];
                $timestamp = strtotime($postDate);
                // Format the timestamp
                $formattedDate = date("M d, Y", $timestamp);
                $fileLink   =   "uploads/postfiles/".$postFile;
                ?>
<li><span style="font-size: 12pt; font-family: georgia, palatino, serif;"><a href="<?php echo $fileLink; ?>"><?php echo $postFile; ?></a></span>
 Posted By: <span><?php echo $postedBy; ?></span></li>


<?php } ?>
</ul>


                <?php
           }

           ?>
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