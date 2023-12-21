<?php
session_start();
include_once('dashboard_sidebar.php');
$uid    =   $_SESSION['uid'];

if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);
  
  $res           =   $objMember->getPostById($id);
  //echo "<pre/>";print_r($res);
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
    if($public_visisble == 0){
        $publish    =   "Publish To Public";
        $status_change_need =   1;// update to 1 on db needed
    } else{
         $publish    = "Unpublish";
         $status_change_need =   0;// update to 0 on db needed
    }
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
                                <button type="button" class="btn border btn-typ4 px-4 ms-2"  onclick="publicStatus(<?php echo $id; ?>,<?php echo $status_change_need;?>)"><?php echo $publish; ?></button>
                                <!--  <button type="button" class="btn border btn-typ4 px-4 ms-2" onclick="publicStatus(<?php echo $id; ?>, <?php echo $status_change_need ? 'true' : 'false'; ?>)"><?php echo $publish; ?></button>  -->

                                 <button type="button" class="btn border btn-typ4 px-4 ms-2">Edit</button>
                                 <!-- Your Delete Button -->
                                <button type="button" id="delModal" class="btn border btn-typ4 px-4 ms-2" data-toggle="modal" data-target="#deleteConfirmationModal" data-post-id="<?php echo $id; ?>">Delete</button>
                                                               
                              
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
    <!-- Modal HTML -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addMore" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Deleted successfully</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--  update success -->
            <div class="modal fade" id="updatesuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addMore" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Updated successfully</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                        </div>
                        
                    </div>
                </div>
            </div>
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
    <!-- Add these links to your HTML -->

<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

 <?php include_once('dashboard_footer.php'); ?>
 <script>
$(document).ready(function () {
    // Store the post ID when the Delete button is clicked
    var postIdToDelete;

    // Listen for the Delete button click to capture the post ID
    $('#delModal').on('click', function () {
        postIdToDelete = $(this).data('post-id'); // Assuming you have a data attribute for post ID
       //  alert(postIdToDelete);
    });
   
    // Listen for the confirmation delete button click
    $('#confirmDeleteBtn').on('click', function () {
        if (postIdToDelete) {
          // alert(postIdToDelete);
            // Perform the delete operation using AJAX or redirect to a delete script
            
            //=============================
       
        $.ajax({
                url: 'ajax_mypost.php', // Replace with your form processing script
                type: 'POST',
             //data: { firstEdit: firstEdit, secondEdit: secondEdit,bannerImageEdit: filename ,homeId: homeId,oldImage: oldImage },
             data: { postId: postIdToDelete},
            success: function(response) {                  
       $('#deleteConfirmationModal').modal('hide');
        
                    // Handle the response here
                    if (response === 'success') {
                         $('#delsuccesspop').modal('show');
                        
                        //alert('kkkkk');
                        //  bannerImageEditError.textContent = 'Updated successfully';
                         
                          // Refresh the form on modal close
                    $('#delsuccesspop').on('hidden.bs.modal', function() {
                       window.location="my-posts.php" 
                      });

                         
                    } else if (response === 'err1') {
                    //  alert('hhh');
                     //   bannerImageEditError.textContent = 'Error in Image Type ';
                         
                          // Refresh the form on modal close
                          $('#delsuccesspop .modal-title').text('Error in Delete');
                                    $('#delsuccesspop').modal('show');
                     
                     
                    }
                    else{
                      console.error('Post ID is not available.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error); // Log any AJAX errors
                }
             
        });


            //=============================
            // Example: $.post('delete_post.php', {postId: postIdToDelete}, function(response) { /* Handle response */ });

            // Close the modal
           
        } else {
            console.error('Post ID is not available.');
        }
    });
});
function publicStatus(postId,publicStatuschange){
    
                  $.ajax({
                            url: 'ajax_mypost.php', // Replace with your form processing script
                            type: 'POST',
                         //data: { firstEdit: firstEdit, secondEdit: secondEdit,bannerImageEdit: filename ,homeId: homeId,oldImage: oldImage },
                         data: { UpdatepostId: postId,publicStatuschange: publicStatuschange},
                        success: function(response){  
                        
                             response = response.trim();
                         //   alert(response);
                            if (response === 'success') {
                               // alert("HHHHHHH");
                                 $('#updatesuccesspop').modal('show');                       
                                           
                                              // Refresh the form on modal close
                                        $('#updatesuccesspop').on('hidden.bs.modal', function() {
                                            location.reload();
                                         });
                            }
                             else if (response == 'err1') {
                              //  alert("error on updation");
                                 $('#updatesuccesspop .modal-title').text('Error in update');
                                    $('#updatesuccesspop').modal('show');
                     
                             }
                             else{
                                  console.error('Post ID is not available.');
                            } 
                        },
                        error: function(xhr, status, error) {
                                console.log(error); // Log any AJAX errors
                        }
             
                    });
                    }
</script>
