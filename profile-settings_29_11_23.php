<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('dashboard_sidebar.php');
if(!isset($_SESSION)){
    session_start();
}
//print_r($_SESSION);
$uid    =   $_SESSION['uid'];
 $res    =   $objMember->getMEmberProfile($uid);
  $profile_pic    =   $res['profile_img'];
     $profileImageURL =     "uploads/images/profileimg".$profile_pic;
               
            if ((empty($profile_pic)) || (!file_exists($profileImageURL))) {
                $dummyImageURL = "images/avatar-new.png"; // URL of the dummy image
                $profileImageURL = $dummyImageURL;
            }  
 //echo "JJJ".$uid;
  //print_r($res);exit;
  $fname_res        =   "";
  $lname_res        =   "";
  $email_res        =   "";
  $email_res        =   "";
  $email1_res        =   "";
 $email2_res        =   "";
 
 if(isset($_POST['submit'])){ 
     
      $haserror    =   true;       
        $member_FNAme    = $objMember->sanitizeInput($_POST['first_name']);// print_r($fname);
        $member_LNAme    = $objMember->sanitizeInput($_POST['last_name']);      
       $mem_email    = $objMember->sanitizeInput($_POST['email']);
       
        
        //print_r($image);
        //==============================            
            $fname_res  = $objMember->validateInputStrings($member_FNAme);
            $lname_res  = $objMember->validateInputStrings($member_LNAme);
           if ($mem_email !== $existing_email_from_db) {
            $email_res  = $objMember->validateInputStrings($mem_email);
           
            $email1_res  = $objMember->validateInputEmail($mem_email);
            $email2_res  = $objMember->validateInputEmailExist($mem_email,$uid);//check whether same email exist for another user
           
            //================
            
            if(count($email2_res)>0){
                //email id exist for another user
                $email2_res =   false;
            }
            else{
                $email2_res =   true;
            }
              
           }//  $image_res_size    = $objMember->validateImage($_FILES['p-image']['size'],$_FILES['p-image']['name'],$_FILES['p-image']['type']);
              //  echo "PPPPPPPPPPPPPP";
              $imageErr   =   ""; 
   if(!empty($_FILES['p-image']['name'])){
       $image    = $_FILES['p-image']; 
        $image    =   $image['name'];
                $maxFileSize = 1000000; // 2MB (example maximum file size)
            if ($_FILES['p-image']['size'] > $maxFileSize) {
            //echo "Invalid file size";
            $imageErr   =   "Invalid file size";
            $haserror    =   false;
            } 
                $allowedTypes = array(
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG,
        IMAGETYPE_GIF
    );

    if ($_FILES['p-image']['error'] === UPLOAD_ERR_OK) {
        $imageType = exif_imagetype($_FILES['p-image']['tmp_name']);

        if (!in_array($imageType, $allowedTypes)) {
            // Invalid image file type
             $imageErr   =  "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
              $haserror    =   false;
        } 
    }
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif']; // Example allowed MIME types
        $fileMimeType = $_FILES['p-image']['type'];
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            $imageErr = "Invalid MIME type";
            $haserror    =   false;
        }
     }
     if($imageErr   ==  ""){
                        move_uploaded_file($_FILES["p-image"]["tmp_name"],"uploads/images/profileimg/".$image);
                         $haserror    =   true;
     }

//============
//var_dump($email2_res);
         
           if((!$fname_res)|| (!$lname_res)  || (!$email_res) || (!$email1_res) || (!$email2_res)){
               $haserror    =   false;
           }
         // echo "******************************"; var_dump($haserror);
           if( $haserror){ 
               // no error messages and update into db
                $upateArr   =   false;//var used to check success status after db updation
               $upateArr    =   $objMember->updateAdminProfile($id,$email,$fname,$lname,$phone,$image,$address);
                if($upateArr === true)
                { 
                      echo "<script>";
                echo "document.addEventListener('DOMContentLoaded', function() {";
                echo "    var addsuccesspop = document.getElementById('addsuccesspop');";
                echo "    if (addsuccesspop) {";
                echo "        addsuccesspop.classList.add('show');";
                echo "        addsuccesspop.style.display = 'block';";
                echo "    }";
                echo "});";
                echo "</script>";
                    
               // echo "update success ";
                }
               
           }       
 }else{
      $member_FNAme    =  $res['first_name'];
    $member_LNAme    = $res['last_name'];
    $existing_email_from_db  =   $res['email'];

     $fname_res  = $objMember->validateInputStrings($member_FNAme);
            $lname_res  = $objMember->validateInputStrings($member_LNAme);
           
           $email_res  = $objMember->validateInputStrings($existing_email_from_db);
           
            $email1_res  = $objMember->validateInputEmail($existing_email_from_db);
            $email2_res  = true;
     
    
 } 
?><div class="col-lg-9">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4 h4 mb-0">
                                Settings
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="white-bg blue-text rounded-2 p-4">
                                <form action="" class="row g-2" method="post" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">First Name</label>
                                                <input type="text" class="form-control shadow-none" value="<?php  echo $member_FNAme;?>" name="first_name">
                                                 <?php if(!$fname_res){ ?>
                                            <sapan class="errortext" style="color:red">Please fill your FirstName / Invalid name length </span>
                                            <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Last Name</label>
                                                <input type="text" class="form-control shadow-none" value="<?php  echo $member_LNAme;?>" name="last_name">
                                                 <?php if(!$lname_res){ ?>
                                            <sapan class="errortext" style="color:red">Please fill your LastName / Invalid name length </span>
                                            <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">E-mail ID</label>
                                                <input type="email" class="form-control shadow-none" value="<?php  echo $existing_email_from_db;?>" name="email">
                                                <?php if(!$email_res){ ?>
                                            <sapan class="errortext" style="color:red">Enter Email</span>
                                            <?php } else if(!$email1_res){ ?>
                                            <sapan class="errortext" style="color:red">Enter Email in required  format</span>
                                            <?php } else if(!$email2_res){ ?>
                                            <sapan class="errortext" style="color:red">Entered Email already Exist for another user</span>
                                            <?php } ?>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Profile Picture</label>
                                                <div class="form-control p-0">
                                                    <input type="file" id="inputGroupFile" class="form-control shadow-none border-0" name="p-image">
                                                    <img src="<?php  echo $profileImageURL ?>" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
                                                    <?php if(!empty($imageErr)){ ?>
                                            <sapan class="errortext" style="color:red"><?php echo $imageErr; ?></span>
                                            <?php } ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">New Password</label>
                                                <input type="password" class="form-control shadow-none"  name="passwor" id="passwor">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control shadow-none"  name="cpassword">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">                                   
                                        <button type="button" class="btn border btn-typ4 px-4" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()">Cancel</button>
                                         <input type="submit" name="submit" value="Save" id="submit" class="btn border btn-typ4 px-4 ms-2">

                                     <!--   <button type="button" class="btn border btn-typ4 px-4 ms-2">Save</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--Start -->
             <div class="modal fade" id="addsuccesspop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addMore" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Profile Updated</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="backuserpage()" ></button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--  End -->
     <?php include_once('dashboard_footer.php'); ?>
    