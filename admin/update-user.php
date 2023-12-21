<?php
include_once 'includes/header.php';
@include 'config.php';
if(isset($_GET['uid'])) {
$uid=intval($_GET['uid']);	
}
    else{
        ?>
        <div class="alert alert-danger" id="error-message">
            <center><?php echo "No USer selected here" ; ?></center>
        </div>
    <?php }

if(isset($_POST['submit']))
{
   // print_r($_POST);
$fname=trim($_POST['first_name']);
$lname=trim($_POST['last_name']);	
$email=trim($_POST['email']);
 $oldPassword = trim($_POST['old_password']);
  $newPassword = trim($_POST['passwor']);
   $cpassword = trim($_POST['cpassword']);

    // You may want to validate and sanitize input data here

    if (!empty($newPassword)) {
         if ($newPassword !== $cpassword) {
            $error = "Password and confirm password do not match.";
        }else{
            $passwor=md5($newPassword);
        }
    } else {
        $passwor=$oldPassword;
    }	
    if (!isset($error)) {
        $sql="UPDATE users set first_name=:fname,last_name=:lname,email=:email,passwor=:passwor WHERE _id=:uid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':passwor',$passwor,PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_INT);
        $query->execute();
         echo '<div id="successMEssage" class="alert alert-success"><center>Data updated successfully.</center></div>';
    }
}
?>

            <!-- Info cards Start -->
            <div class="min-vh-100">
                <!-- User List Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row border-primary rounded mx-0 p-3">
                        <div class="col-12">
                        <?php 
                            $uid=intval($_GET['uid']);
                            $sql = "SELECT * from users where _id=:uid";
                            $query = $dbh -> prepare($sql);
                            $query -> bindParam(':uid', $uid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {	?>
                            <form method="post" >
                                <div class="row" id="editprofile" style="display: flex;">
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger" id="error-message">
                                        <center><?php echo $error; ?></center>
                                    </div>
                                <?php endif; ?>
                                    <!-- <strong class="fs-16 fw-500 light-blue-txt mb-3 d-block">Add User</strong> -->
                                    <h5 class="fw-normal">Update User</h5>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3" >
                                                <label>First Name</label>
                                                <input type="text" class="form-control border" name="first_name" id="first_name" value="<?php echo htmlentities($result->first_name);?>" required></div>
                                            <div class="col-12 mb-3" ><label>Last Name</label><input type="text" value="<?php echo htmlentities($result->last_name);?>" 
                                                    class="form-control border" name="last_name" id="last_name" required></div>
                                            <div class="col-12 mb-3" ><label>Email</label><input type="email" value="<?php echo htmlentities($result->email);?>"
                                                    class="form-control border" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}\.[a-z]{2,}$" required></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3"><label>Pasword</label>
                                                <input type="hidden" name="old_password" value="<?php echo $result->passwor; ?>">

                                            <input type="password" class="form-control border" name="passwor" id="passwor" value=""></div>
                                            <div class="col-12 mb-3"><label>Confirm Password</label><input
                                                    type="password" class="form-control border" name="cpassword"  
                                                    ></div> 
                                        </div>
                                    </div>
                                    <?php }} ?>

                                    <script>
                                    function redirectToAnotherPage() {
        
                                        window.location.href = "user-list.php"; 
                                    }
                                </script>

                                    <div class="col-12 d-flex"><button type="submit" name="submit" class="btn btn-primary btn-typ4">SAVE</button>
                                            <button type="reset" value="Clear" onclick="redirectToAnotherPage();"  class="btn btn-primary btn-typ3 ms-2">CANCEL</button></div>
                                </div>
                                
                                
                            </form>
                      
                        </div>
                    </div>
                </div>
                <!-- User List End -->
            </div>
            <?php  include_once 'includes/footer.php';   ?> 
</body>

</html>