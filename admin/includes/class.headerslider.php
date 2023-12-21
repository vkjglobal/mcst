<?php
/**************************************************************************** 
   Project Name	::> MCST
   Module 	::> Class for heder slider management
   Programmer	::> 
   Date		::> 01-12-2023
   DESCRIPTION::::>>>>
   This is a Class code used to manage heder slider CMS 
*****************************************************************************/
include "class.dbaction.php";
class  Class_headerslider extends Dbaction
{
	public function __construct()
    {
       $this->db = new Dbaction();
				
	}
   public function selectHSvalue()
   {
      $tableName = 'header_slider';
      $result = $this->db->selectTablevalues($tableName);
      //print($result);
      return $result;
   }

    public function add_HeaderSliders($title,$desc1,$desc2,$image1)
    {
      $tableName = "header_slider";
      $sss =  date("Y-m-d H:i:s");
      $params = ['title'=>$title, 'image'=>$image1, 'description'=>$desc1, 'short_desc'=>$desc2, 'created_at'=>$sss, 'updated_at'=>$sss];
      //print_r($params);exit;
      $result =   $this->db->insertInto($tableName, $params) ;
      return $result;
    }
    public function selectHeaderSliderbyId($id)
    {
      $tableName = "header_slider";           
      $result = $this->db->selectById($tableName, $id);
      return $result;
    }
    public function update_HeaderSliders($title,$desc1,$desc2,$image1,$id)
    {
      // print_r($content);
      $result =   $this->db->updateDBcmsContent($title,$desc1,$desc2,$image1,$id);
      return $result;
    }
    public function DeleteHS($pid)
    {
      $tableName	= "header_slider"; 
      $id = $pid; 
      $result = $this->db->deleteData($tableName,$id);        
      return $result;
    }
    public function enable_disable($status, $id)
    { 
      $result = $this->db->updateStatus($status, $id);
      return $result;
    }
    public function sanitizeInput($input) 
    {
    // Trim whitespace from the beginning and end of the input
    $input = trim($input);
    
    // Remove backslashes
    $input = stripslashes($input);
    
    // Convert special characters to HTML entities
    $input = htmlspecialchars($input, ENT_QUOTES);
    return $input;
    }
    public function enable_disable_cms($status, $id)
    {
      $result = $this->db->updateCMSstatus($status, $id);
      return $result; 
    }
}