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
 //echo "JJJ".$uid;
  //print_r($res);exit;
 if(isset($_POST['submit'])){ 
     echo "test here ";exit;
 }else{
      $member_FNAme    =  $res['first_name'];
    $member_LNAme    = $res['last_name'];
    $mem_email  =   $res['email'];
    $profile_pic    =   $res['profile_img'];
     $profileImageURL =     "uploads/images/profileimg".$profile_pic;
               
            if ((empty($profile_pic)) || (!file_exists($profileImageURL))) {
                $dummyImageURL = "images/avatar-new.png"; // URL of the dummy image
                $profileImageURL = $dummyImageURL;
            }   
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
                                <form action="" class="row g-2">
                                    <div class="col-12">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">First Name</label>
                                                <input type="text" class="form-control shadow-none" value="<?php  echo $member_FNAme;?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Last Name</label>
                                                <input type="text" class="form-control shadow-none" value="<?php  echo $member_LNAme;?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">E-mail ID</label>
                                                <input type="email" class="form-control shadow-none" value="<?php  echo $mem_email;?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Profile Picture</label>
                                                <div class="form-control p-0">
                                                    <input type="file" id="inputGroupFile" class="form-control shadow-none border-0" name="p-image">
                                                    <img src="<?php  echo $profileImageURL ?>" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
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
                                        <button type="button" class="btn border btn-typ4 px-4" data-bs-dismiss="modal">Cancel</button>
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
     <?php include_once('dashboard_footer.php'); ?>
    