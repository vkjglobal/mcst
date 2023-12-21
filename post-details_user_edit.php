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
    $fileUloadPublic   =   $public_visisble;
    $postDate            =   $res['created_at'] ;
    $postedBy               =   $res['first_name'] .$res['last_name'];
    $postImageURL =   "uploads/postimages/".$postImage;
       if((empty($postImage)) || (!file_exists($postImageURL))) {                                        
        $dummyPostImageURL = "images/no-image.png"; // URL of the dummy image
         $postImageURL = $dummyAgentImageURL;
         $postImage     =   "images/no-image.png";
         }
         //check file empty case
          $fileLink   =   "uploads/postfiles/".$postFile;
          $fileUploadValue = $postFile;
         
                                             //----------date 
     $timestamp = strtotime($postDate);
                                            // Format the timestamp
    $formattedDate = date("M d, Y", $timestamp);
   
        if($public_visisble == 0){
            $publish    =   "Publish To Public";
            $status_change_need =   1;// update to 1 on db needed
        } else{
             $publish    = "Unpublish";
             $status_change_need =   0;// update to 0 on db needed
        }
}

// Initialize variables to hold form data and error messages
$form_data = array('title' => '', 'description' => '');
$form_errors = array();

if (isset($_POST['edit'])) {

 $haserror    =   true;  
    // Retrieve form data
     $user_id = $uid ;
  // print_r($_POST);
         $form_data['title'] = trim($_POST['title']);
    
   
   
    $form_data['description'] = $_POST['description'];

    // Validate title
    if (empty($form_data['title'])) {
        $form_errors['title'] = 'Title is required';
    }
        // Validate description
    if (empty($form_data['description'])) {
        $form_errors['description'] = 'Description is required';
    }
    // Validate featured image
    $imgErr = "";
    if (!isset($_FILES['featured_image']['name']) || empty($_FILES['featured_image']['name'])) { //check if uploaded img null 
           if(empty($postImage)){ // check whether this post has img on db 
           $imgErr    = 'Featured image is required';
            $form_errors['featured_image'] = 'Featured image is required';
              $haserror    = false;
        }
        else{
            $postImage   =   $postImage; 
        }
    }
    else {
        $allowed_image_extensions = array('jpg', 'jpeg', 'png');
        $uploaded_image_extension = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($uploaded_image_extension), $allowed_image_extensions)) {
              $imgErr = 'Invalid featured image type. Please upload a valid image (JPEG, JPG, PNG)';
            $form_errors['featured_image'] = 'Invalid featured image type. Please upload a valid image (JPEG, JPG, PNG)';
              $haserror    = false;
        }
        if(empty($imgErr)){
                    // Image Upload Handling
                    $image_upload = $_FILES['featured_image']['name'];
                    $image_temp = $_FILES['featured_image']['tmp_name'];
                    $image_dest = "uploads/postimages/" . basename($image_upload);

                            $postImage = basename($image_dest);
                             move_uploaded_file($image_temp,$image_dest);
                         $haserror    =   true;
        }       // echo "LLLL". $postImage;
    }
    

     $descriptionValue = $form_data['description'];
    
    //files
    // Validate file upload
    $fileErr    =   "";
    if (!isset($_FILES['file_upload']['name']) || empty($_FILES['file_upload']['name'])) {
            if(empty($postFile)){
                $fileErr = 'File upload is required';
            $form_errors['file_upload'] = 'File upload is required';
              $haserror    = false;
            }
            else{
                $fileUploadValue = $postFile;
            }
    } else {
            $allowed_file_extensions = array('pdf');
            $uploaded_file_extension = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($uploaded_file_extension), $allowed_file_extensions)) {
                $form_errors['file_upload'] = 'Invalid file type. Please upload a PDF file';
                $fileErr    =   'Invalid file type. Please upload a PDF file';
                  $haserror    = false;
            }
   // }
    if(!empty($fileErr)){
        // Check file upload errors
        if ($_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
            $form_errors['file_upload'] = 'File upload failed. Error code: ' . $_FILES['file_upload']['error'];
              $haserror    = false;
        }
    }
    else{
    // File Upload Handling
                    $file_upload = $_FILES['file_upload']['name'];
                    $file_temp = $_FILES['file_upload']['tmp_name'];
                    $file_dest = "uploads/postfiles/" . basename($file_upload);
                    //&& move_uploaded_file($file_temp, $file_dest)
               $fileUploadValue = basename($file_dest);
                  move_uploaded_file($file_temp, $file_dest);
                    $haserror    = true;
    }
    }//not empty file 
    if($haserror){ //no err
            //echo "reached ".$postImage.$fileUploadValue;
             // no error messages and update into db
               
               $upateArr    =   $objMember->updatePost($id,$form_data['title'],$descriptionValue,$postImage,$fileUploadValue,$fileUloadPublic);
                if($upateArr === true)
                { 
                     // Set success message
            $success_message = "Post successfully Edited!";
               // echo "update success ";
                }
               

    }
    else{
         $form_errors['updateAct'] = "Error on Edit";
    }
    
}
else{
    $form_data['title'] =   $postTitle;
    $form_data['description']   =   $postDescription;
    $imageUploadValue   =    $postImage ;
    $fileUploadValue    =$postFile;
}
//echo "HERE".$imageUploadValue;
//echo "now".$fileUploadValue; 
?>

                <div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h4 mb-0">
                                New Post
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4">
                            <form action="" method="POST" enctype="multipart/form-data">
    <div class="col-12">
        <div class="row g-2">
            <div class="col-md-6">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control shadow-none" id="title" name="title" value="<?php echo  $form_data['title']; ?>">
            </div>

            <div class="col-md-6">
                <label for="featured_image" class="form-label">Featured Image</label>
                <div class="form-control p-0">
                    <input type="file" id="featured_image" class="form-control shadow-none border-0" name="featured_image">
                    <img src="<?php echo $postImageURL; ?>" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
                </div>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" cols="30" rows="4" class="form-control shadow-none" placeholder="Type something..."><?php echo isset($_SESSION['form_data']['description']) ? htmlspecialchars($_SESSION['form_data']['description']) : $postDescription; ?></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label for="file_upload" class="form-label">Upload File</label>
        <div class="form-control p-0">
            <input type="file" id="file_upload" class="form-control shadow-none border-0" name="file_upload">
          <!--  <img src="" id="imgPreview" class="img-fluid d-grid rounded-2" alt=""> -->
         
        </div>
         <a href="<?php echo $fileLink;?>" class="link-dark text-break ms-2"><?php echo  $postFile; ?></a>
    </div>

    <div class="d-flex justify-content-end">
        <button type="button" class="btn border btn-typ4 px-4" onclick="history.back()">Cancel</button>
        <button type="submit" name="edit" class="btn border btn-typ4 px-4 ms-2">Save</button>
    </div>
</form>

<!-- Display error or success messages -->
<?php
if (!empty($form_errors)) {
    echo '<div class="alert alert-danger mt-3" role="alert">';
    foreach ($form_errors as $error) {
        echo $error . '<br>';
    }
    echo '</div>';
} elseif (isset($success_message)) {
    echo '<div class="alert alert-success mt-3" role="alert">' . $success_message . '</div>';
}
?>

<!-- Display error or success messages -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Add JavaScript to hide the messages after 5 seconds
    setTimeout(function () {
        var errorMessages = document.querySelectorAll(".alert-danger");
        var successMessages = document.querySelectorAll(".alert-success");

        errorMessages.forEach(function (message) {
            message.style.display = "none";
        });

        successMessages.forEach(function (message) {
            message.style.display = "none";
        });
    }, 5000); // 5000 milliseconds (5 seconds)
});
</script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <?php include_once('dashboard_footer.php'); ?>