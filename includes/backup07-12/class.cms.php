<?php 

include_once('includes/class.dbact.php');
 class CMS  extends Dbact{
	public function __construct() {
        parent::__construct(); // Call the constructor of the parent class (MyDatabaseClassPDO)
    }

    public function getContentDetails($id)
    {
        $tblname  =   "header_slider";
        $result =   $this->getHSById($tblname,$id);
        return $result;	
    }
    public function getCMSDetails($id)
    {
        $tblname  =   "cms";
        $result =   $this->getcmsById($tblname,$id);
        return $result;	
    }
    public function getProjectDBDetails($id)
    {
        // $sql = "SELECT ";
        // $result =   $this->getcmsById($tblname,$id);
        // return $result;	
    }
    public function getProject_status($id)
    {
        $tableName = "projects";
        $result = $this->db->getProject_Dbstatus($tableName,$id);
        return $result;
    }
}