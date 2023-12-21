<?php
session_start();
include_once('dashboard_sidebar.php');
$uid    =   $_SESSION['uid'];

$resPosts    =   $objMember->getMyPostsUser($uid);
//print_r($resPosts);
//*************************************

  $totalItems = count($resPosts); // Total number of items
$itemsPerPage = 6; // Number of items to display per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Ensure that the current page is within valid bounds
if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

// Calculate the offset and limit for slicing the array
$offset = ($currentPage - 1) * $itemsPerPage;
$limit = $itemsPerPage;

// Slice the array to get the items for the current page
$items = array_slice($resPosts, $offset, $limit);
?>
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h4 mb-0">
                                My Posts
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row g-3">
                             <?php 
                             if(count($resPosts)>0){
                             foreach($items as $k => $val){ 
                                              $postTitle  =    $val['Title'];
                                            $postImage =   $val['Image_upload'];
                                             $postDescription   =   $val['Description'];
                                               $postFile    =   $val['file_upload'];
                                             $public_visisble   =   $val['file_public_visible'] ;
                                              $mem_visisble   =   $val['mem_hide_status'] ;
                                             $postDate  =   $val['created_at'] ;
                                              $postedBy =   $val['first_name'] .$resPosts[0]['last_name'];
                                             $postImageURL =   "uploads/postimages/".$postImage;
                                              if((empty($postImage)) || (!file_exists($postImageURL))) {                                        
                                             $dummyPostImageURL = "images/no-image.png"; // URL of the dummy image
                                             $postImageURL = $dummyAgentImageURL;
                                              }
                                             //----------date 
                                             $timestamp = strtotime($postDate);
                                            // Format the timestamp
                                            $formattedDate = date("M d, Y", $timestamp);
                                             if($public_visisble == 0){
                                            $publish    =   "UnPublished";
                                           // $status_change_need =   1;// update to 1 on db needed
                                        } else{
                                             $publish    = "Published";
                                            // $status_change_need =   0;// update to 0 on db needed
                                        }
                                         if($mem_visisble == 0){
                                            $publish_mem    =   "Hidden"; //hidden from other members
                                           // $status_change_need =   1;// update to 1 on db needed
                                        } else{
                                             $publish_mem    = "Visible";
                                            // $status_change_need =   0;// update to 0 on db needed
                                        }
                                             ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="white-bg blue-text rounded-2 p-4 h-100">
                                        <div class="img-wrp mb-2">
                                            <img src="<?php echo $postImageURL; ?>" alt="">
                                        </div>
                                        <a href="post-details_user.php?id=<?php echo base64_encode($val['id']); ?>" class="link-dark"><?php echo $postTitle;  ?></a>
                                         <div>Posted on:<?php echo $formattedDate; ?> <b><?php echo  $publish;?></b>  <b><?php echo  $publish_mem;?></b> </div>
                                    </div>
                                </div>
                                 <?php }
                             }
                             else{
                                 ?><div>No Posts Yet </div>
                                 <?php
                             }?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex w-100 justify-content-center">
                                <nav aria-label="...">
                                    <ul class="pagination mt-4">
                                        <?php 
                                        if ($totalPages > 1) { 
                                                    if ($currentPage > 1) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo ($currentPage - 1); ?>">Previous</a>
                                                </li>
                                                    <?php } 
                                                // Page links
                                                    for ($i = 1; $i <= $totalPages; $i++) {
                                                         if ($i == $currentPage) {
                                                             ?>
                                                             <li class="page-item active" aria-current="page">
                                                              <a class="page-link" href="#"><?php echo $i; ?></a>
                                                               </li>
                                                                <?php       
                                           
                                                         } else { ?>

                                                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                                                    <?php
                                                                }
                                                    }
                                                               ?>
                                        
                                                                    <li class="page-item">
                                                                        <?php if ($currentPage < $totalPages) {?>
                                                                            <a class="page-link" href="?page=<?php echo ($currentPage + 1); ?>">Next</a>                                
                                                                            <?php  } ?>
                                                                    </li>
                                                                    <?php
                                                               
                                                     
                                                    
                                          }          ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once('dashboard_footer.php'); ?>