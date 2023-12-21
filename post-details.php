<?php
session_start();
include_once('dashboard_sidebar.php');
$uid    =   $_SESSION['uid'];

if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);
  
  $res           =   $objMember->getPostById($id);   
    $postTitle   =    $res['Title'];
      $postImage =   $res['Image_upload'];
      $postDescription   =   $res['Description'];
    $postFile            =   $res['file_upload'];
    $public_visisble     =   $res['file_public_visible'] ;
    $postDate            =   $res['created_at'] ;
    $postedBy               =   $res['first_name'] .$res['last_name'];
    $postImageURL =   "uploads/postimages/".$postImage;
   if((empty($postImage)) || (!file_exists($postImageURL))) {                                        
    $dummyPostImageURL = "images/no-image.png"; // URL of the dummy image
     $postImageURL = $dummyAgentImageURL;
     }
                                             //----------date 
     $timestamp = strtotime($postDate);
                                            // Format the timestamp
    $formattedDate = date("M d, Y", $timestamp);
    $fileLink   =   "uploads/postfiles/".$postFile;

//=========comments====================

  $res_Comments           =   $objMember->getPostCommentsById($id);  
}
 //print_r($res_Comments);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
     $commentText = trim($_POST["comment"]);
     if(!empty($commentText)){
       
           $Ins_Comments           =   $objMember->InsPostCommentsById($id,$uid,$commentText);  

             if ($Ins_Comments) {
                  $success =  "Comment posted successfully!";
                 //  header("Location: post-details.php?id=".$_GET['id']);
                 // exit();
                } else {
                    $error = "Error posting comment.";
                }
     } else {
        $error = "Please add your comment.";
    }
}

?>
                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4">
                               <?php echo $postTitle; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="white-bg blue-text rounded-2 p-4 h-100">
                                        <div class="img-wrp">
                                            <img src="<?php echo $postImageURL;?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="white-bg blue-text rounded-2 p-4">
                                        <div class="border rounded-2 p-3 mb-3 shadow-none">
                                            <div class="d-flex align-items-center">
                                                <span class="h2 mb-0">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                </span>
 
                                                <a href="<?php echo $fileLink;?>" class="link-dark text-break ms-2"><?php echo  $postFile; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="white-bg blue-text rounded-2 p-4 h-100">
                                <div class="border rounded-2 p-3 mb-3 shadow-none">
                                    <p>
                                       <?php echo $postDescription; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex w-100 justify-content-end">
                                <a href="" class="btn border btn-typ4 px-4">
                                   Posted By : <?php echo $postedBy; ?>
                                </a>
                                <button type="button" class="btn border btn-typ4 px-4 ms-2">Date : <?php echo $postDate;?></button>
                              
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h-100">
                                <h3>Comments</h3>
                                <ul class="list-group">
                                <?php 
                                if(!empty($res_Comments)){
                                foreach($res_Comments as $key => $val){ 
                                    $user   =   $val['first_name'].$val['last_name'];
                                    $comm_date  =   $val['created_date'];
                                    $timestamp_commnt = strtotime($comm_date);
                                            // Format the timestamp
                                            $formattedDate_commnt = date("F j, Y \a\\t g:i a", $timestamp_commnt);
                                  //  $formattedDate_commnt = date("M d, Y", $timestamp_commnt);
                                    ?>
                                    <li class="list-group-item">
                                        <div class="d-flex mb-2">
                                            <div class="user-img rounded-circle overflow-hidden"><img src="images/avatar-new.png" alt="" class="d-block img-fluid"></div>
                                            <div class="d-flex flex-column align-items-start ms-2">
                                                <strong><?php echo $user; ?></strong>
                                                <time datetime="" class="small"><?php  echo $formattedDate_commnt; ?></time>
                                            </div>
                                        </div>
                                        <p class="small">
                                           <?php echo $val['comment']; ?>
                                        </p>
                                    </li>
                                    
                                    <?php } 
                                }
                                else{
                                    ?> <p class="small">No Comments Received</p><?Php

                                }?>
                                </ul>
                                <form action="#" class="mt-4" method="post">
                                    <h4>Leave a Comment</h4>
                                    <textarea name="comment" id="" cols="30" rows="5" class="form-control shadow-none mb-3"></textarea>
                                    <button type="submit" class="btn border btn-typ3">Post Comment</button>
                                    <?php if (!empty($error)) { ?>
                                         <div class="error-message"><?php echo $error; ?></div>
                                         <?php } ?>
                                          <?php if (!empty($success)) { ?>
                                                <div class="success-message"><?php echo $success; ?></div>
                                            <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Add New Post Start-->
    <!-- <div class="modal fade" id="addNewPostModal" tabindex="-1" aria-labelledby="addNewPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content dark-blue-bg">
                <div class="modal-header border-0 p-4 pb-md-0">
                    <button type="button" class="btn-close white-bg" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="row g-2">
                        <div class="col-md-12">
                            <textarea name="" id="" cols="30" rows="1" class="form-control shadow-none border-0" placeholder="Type the title for your post..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-control py-2">
                                        <input type="file" id="inputGroupFile" class="form-control shadow-none border-0 my-1">
                                        <img src="" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea name="" id="" cols="30" rows="4" class="form-control shadow-none border-0" placeholder="Type something..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <textarea name="" id="" cols="30" rows="4" class="form-control shadow-none border-0 h-100" placeholder="Type the description for your post..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn border btn-typ4 px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn border btn-typ4 px-4 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
 <?php include_once('dashboard_footer.php'); ?>