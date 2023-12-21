<?php 
//error_reporting(0);
 include_once('includes/class.Db_client.php');
 class Member  extends Db_client{
	public function __construct() {
        parent::__construct(); // Call the constructor of the parent class (MyDatabaseClassPDO)
    }
		  public function getMEmberProfile($id){			
				$tableName = "users";        
				 $result =   $this->getContentByID($tableName,$id) ;     
			   return $result;	     
		
			}
			public function getAllPostsHome($id){					       
				 $result =   $this->getAllPosts($id) ;     
			   return $result;	     
		
			}
			public function getMyPostsUser($id){					       
				 $result =   $this->getMyPosts($id) ;     
			   return $result;	     
		
			}
			 public function getPostById($id){			
				  
				 $result =   $this->getPostContentByIDNew($id) ;   
			   return $result;	     
		
			}
			 public function getPostCommentsById($id){			
				 
				 $result =   $this->getPostsCommentsById($id) ;   
			   return $result;	     
		
			}
			 public function InsPostCommentsById($id,$uid,$commentText){
    
					$tableName = "post_comments"; 
     
					$params = ['post_id'=>$id,'user_id'=>$uid,'comment'=>$commentText];
				
					$result =   $this->insertInto($tableName, $params) ;
				  //print_r($result);exit;
				   return $result;		
			}
			//=============
			public function sanitizeInput($input) {
    // Trim whitespace from the beginning and end of the input
    $input = trim($input);

    // Remove backslashes
    $input = stripslashes($input);

    // Convert special characters to HTML entities
    $input = htmlspecialchars($input, ENT_QUOTES);
    return $input;
    }
    
   public function validateInputStrings($input) {
    // Perform your validation rules on the input
    // Return true if the input is valid, otherwise return false
    //  validation for a name field
    if($input == ""){
        return false;
    }
    if (strlen($input) < 2 || strlen($input) > 50) {
        // Invalid name length
        return false;
    }
    return true;
   }
   public function validateInputEmail($input) {
    //  validation for an email field
    if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        return false;
    }
   
    return true;
    }   
    public function validateInputEmailExist($email,$uid) {
    //  validation for an email exist for any other users
        $tableName = "users";
		$result = $this->selectByEmailExist($tableName,$email,$uid);
      //  print_r($result);echo "hhh";exit;
		return $result;   
    }   
   public  function validatePhoneNumber($phoneNumber) {
    $pattern = '/^\d{7}$/'; // Assumes a 7-digit phone number without any formatting

  // Perform the validation
  return preg_match($pattern, $phoneNumber);
    }

    //====
    public function validateImage($imageSize,$imageName,$imageType){
        $maxFileSize = 1000000; // 2MB (example maximum file size)
        if ($imageSize > $maxFileSize) {
        echo "Invalid file size";
        return false;
        }
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Example allowed file extensions
    $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Invalid file type";
            return false;
        }
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif']; // Example allowed MIME types
        $fileMimeType = $imageType;
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            echo "Invalid MIME type";
            return false;
        }
        return true;

    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        //update profile
        public function updateAdminProfile($id,$email,$fname,$lname,$image,$updatepw){	
		//echo $id.$email.$fname.$lname.$image;
		$tableName = "users";
		$result = $this->updateProfile($id,$email,$fname,$lname,$image,$updatepw);
		return $result;
		
	}
     //update post
        public function updatePost($id,$title,$descriptionValue,$postImage,$fileUploadValue,$fileUloadPublic){	
		//echo $uid.$title.$descriptionValue.$postImage.$fileUploadValue."rrrrrrrrrrrrrrrrrrrrrrr";exit;
		$tableName = "posts";
		$result = $this->updatePosts($id,$title,$descriptionValue,$postImage,$fileUploadValue,$fileUloadPublic,$tableName);
		return $result;
		
	}
    //published/unpublished on elaeraning  post

    public function getMyPostsUserPublish($uid,$fileVisible){					       
				 $result =   $this->getMyPostsPublishOrNot($uid,$fileVisible);     
			   return $result;	     
		
			}
    //get all member names for elearning menu
    public function getAllMembersName(){
    $tablename  =   "users";
     $result =   $this->getListData($tablename);     
       return $result;	
    
    }
    public function getFilesByMember($memId){
    $tablename  =   "posts";
    
     $result =   $this->getFileListDataByMemId($memId);
   //  print_r($result);
       return $result;	
    
}
          

}

?>