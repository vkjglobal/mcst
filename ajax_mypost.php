<?php
 include_once "includes/class.Db_client.php";

 if(isset($_POST['postId'])) {
   
    $objDB		= 	new Db_client();
    
     $rowid     =   $_POST['postId'];
     $table =   'posts' ;
     $deleteMypostByID  =   $objDB->deleteData($table,$rowid);
     if($deleteMypostByID  == 1){
         echo "success";exit;
     }
     else{
         echo "err1";exit;
     }
     echo "err2";exit;
 }
 //update publish status 
 if(isset($_POST['UpdatepostId'])) {
 
    $objDB		= 	new Db_client();
    
     $rowid     =   $_POST['UpdatepostId'];
     $file_public_visible   =    $_POST['publicStatuschange'];
     $tableName =   'posts' ;
     //====================
      $updateData = array(
                   
                    'file_public_visible' =>$file_public_visible
                );
                $condition = "`id` =".$rowid;
             //    LIKE '%MF23720823%' 
     
        $result =   $objDB->update($tableName, $updateData, $condition);
      //  var_dump($result);
     //====================
     //$deleteMypostByID  =   $objDB->deleteData($table,$rowid);
     if($result  == 1){
         echo "success";exit;
     }
     else{
         echo "err1";exit;
     }
     echo "err2";exit;
 }
 //update publish status to other members
 if(isset($_POST['MemPostId'])) {
 
    $objDB		= 	new Db_client();
    
     $rowid     =   $_POST['MemPostId'];
     $mem_public_visible   =    $_POST['publicStatuschangeMem'];
     $tableName =   'posts' ;
     //====================
      $updateData = array(
                   
                    'mem_hide_status' =>$mem_public_visible
                );
                $condition = "`id` =".$rowid;
             //    LIKE '%MF23720823%' 
     
        $result =   $objDB->update($tableName, $updateData, $condition);
      //  var_dump($result);
     //====================
     //$deleteMypostByID  =   $objDB->deleteData($table,$rowid);
     if($result  == 1){
         echo "success";exit;
     }
     else{
         echo "err1";exit;
     }
     echo "err2";exit;
 }
?>