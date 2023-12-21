<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();
 if((isset($_GET['member']))){

$_GET['id'] =   "ODA2";// to retain url structure elearning page for member files 
$memId= $_GET['member'];
}
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
           <?php echo $aboutUsList['content']; 
           if(($id   ==  '806') || (isset($_GET['member']))){
                 include_once('includes/class.Member.php');
                 $objMember		= 	new Member();
               $result     =   $objGen->getFilesPublic(); 
               //sort 
               // echo "nowwwwww "; print_r($_GET['member']);
                                  $allMembers = $objMember->getAllMembersName(); // Replace with your method to get all members
                                 
                                      

                                    // Check if a member is selected
                                    $selectedMember = isset($_GET['member']) ? $_GET['member'] : 'all';

                                    // Get the list of files based on the selected member
                                    if ($selectedMember == 'all') {
                                        $result = $objGen->getFilesPublic(); // Default: All files
                                    } else {
                                     //  echo "reached "; print_r($_GET['member']);
                                        $result = $objMember->getFilesByMember($memId); // Replace with your method for getting files by member
                                    }


               
             //   print_r($FileList); 
               // special content like member pdfs for e learning menu
               ?>
                <h2>Files From MCST Members</h2>
                <!-- drop down -->
               <form action="hlpu.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="get">
                    <label for="member">Select Member:</label>
                    <select name="member" id="member" onchange="this.form.submit()">
                        <option value="all" <?php echo ($selectedMember == 'all') ? 'selected' : ''; ?>>All Members</option>
                        <?php
                        foreach($allMembers as $key => $vals){
                                      $memId    =  $vals ['_id'];
                                      $memName  =   $vals ['first_name'].$vals ['last_name'];
                                 
                            ?>
                            <option value="<?php echo $memId; ?>" <?php echo ($selectedMember == $memId) ? 'selected' : ''; ?>>
                                <?php echo $memName; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </form>
                <!-- end of drop down -->
                <ul>
                <?php
                if(empty($result)){
                   ?> <li>No files posted yet </li>
            <?php    }
                else{
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
  Posted By: <span><?php echo $postedBy; ?></span>,   Posted On: <span><?php echo $postDate ?></span></li>


<?php            }
                }
                ?>
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