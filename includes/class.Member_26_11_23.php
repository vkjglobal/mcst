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

}

?>