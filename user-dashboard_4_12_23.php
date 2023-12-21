<?php
session_start();
include_once('dashboard_sidebar.php');
$uid    =   $_SESSION['uid'];
$resPosts    =   $objMember->getAllPostsHome($uid);

?>
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h4 mb-0">
                                All Posts
                            </div>
                        </div>
                        <?php foreach($resPosts as $k => $val){ 
                                              $postTitle  =    $val['Title'];
                                            $postImage =   $val['Image_upload'];
                                             $postDescription   =   $val['Description'];
                                               $postFile    =   $val['file_upload'];
                                             $public_visisble   =   $val['file_public_visible'] ;
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

                                             ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="white-bg blue-text rounded-2 p-4 h-100">
                                <div class="img-wrp mb-2">
                                    <img src="<?php echo $postImageURL; ?>" alt="">
                                </div>
                                <a href="post-details.php?id=<?php echo base64_encode($val['id']); ?>" class="link-dark"><?php echo $postTitle;  ?></a>
                                <div>Posted By :<?php echo $postedBy; ?></div>
                                <div>on:<?php echo $formattedDate; ?> </div>
                            </div>
                        </div>
                        <?php } ?>
                       
                        <div class="col-12">
                            <div class="d-flex w-100 justify-content-center">
                                <nav aria-label="...">
                                    <ul class="pagination mt-4">
                                        <li class="page-item disabled">
                                            <a class="page-link">Previous</a>
                                        </li>
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
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