<?php 
//error_reporting(0);
 include_once('includes/class.Db_client.php');
 class General  extends Db_client{
	public function __construct() {
        parent::__construct(); // Call the constructor of the parent class (MyDatabaseClassPDO)
    }
  /*  public function insCncelSts($bookingId,$userId,$precancelsts,$errorCode='',$mfreNum,$traceId='',$http_code_response,$PTRId='',$PTRType='',$SLAInMinutes='',$PTRStatus='',$VoidingWindow='',$ticket_num ='',$AdminCharges='',$GSTCharge='',$TotalVoidingFee='',$TotalRefundAmount='',$Currency='',$cancel_status='',$meesage_new=''){
    
        $tableName = "cancel_booking"; //cms table name
      //cho "**********************".$TotalRefundAmount;
        $params = ['user_agent_id'=>$userId,'booking_id'=>$bookingId,'pre_post_ticket_status'=>$precancelsts,'err_code'=>$errorCode,'mf_ref_num'=>$mfreNum,'trace_id'=>$traceId,'http_code_response' =>$http_code_response,'ptr_id'=>$PTRId,'ptr_type' =>$PTRType,'sla_minutes'=>$SLAInMinutes,'ptr_status'=>$PTRStatus,'void_window'=> $VoidingWindow ,'ticket_number'=>$ticket_num,'admin_charge' =>$AdminCharges,
                    'gst_charge' =>$GSTCharge,'total_void_fee'=>$TotalVoidingFee,'total_refund_amount'=>$TotalRefundAmount,'currency'=>$Currency,'cancel_status'=>$cancel_status,'message'=>$meesage_new];
  //  print_r($params);exit;
        $result =   $this->insertInto($tableName, $params) ;
      //print_r($result);exit;
       return $result;		
       }

       //===
       public function insCncelSts_Search($bookingId,$userId,$BookingStatus,$Resolution, $mfreNum,$ProcessingMethod,$PTRId,$PTRType,$CreditNoteNumber,$PTRStatus,$CreditNoteStatus, $ticket_num ,$pax_booking_id_transaction ,$PaxId,$TicketStatus,$TotalRefundAmount,$Currency,$is_active_booking_status,$cancel_status,$message=''){
    
        $tableName = "search_cancel_ptr"; //cms table name
      //  echo $PTRType;
        $params = ['user_agent_id'=>$userId,'booking_id'=>$bookingId,'BookingStatus'=>$BookingStatus,'Resolution'=>$Resolution,'mfref'=>$mfreNum,'ProcessingMethod'=>$ProcessingMethod,'PTRId'=>$PTRId,'PTRtype' =>$PTRType,'CreditNoteNumber' =>$CreditNoteNumber,'PTRStatus'=>$PTRStatus,'CreditNoteStatus'=>$CreditNoteStatus,'ticket_num'=>$ticket_num,'pax_booking_id_transaction'=> $pax_booking_id_transaction ,'PaxId' =>$PaxId,
                    'ticket_status' =>$TicketStatus,'total_refund_amount'=>$TotalRefundAmount,'currency' =>$Currency,'is_active_booking_status'=>$is_active_booking_status,'search_cancel_success_status'=>$cancel_status,'message'=>$message];
   // print_r($params);exit;
        $result =   $this->insertInto($tableName, $params) ;
    //  print_r($result);exit;
       return $result;		
       }


       //====
        public function updateInDB_temp_book($tableName,$mfrefNum){
    
        $tableName = "temp_booking"; //cms table name
        $updateData = array(
                    'ticket_status' => 'cancelled'
                );
                $condition = "`mf_reference` LIKE '%".$mfrefNum."%'";
             //    LIKE '%MF23720823%' 
     
        $result =   $this->update($tableName, $updateData, $condition);
      //print_r($result);exit;
       return $result;		
       }
        public function updateInDB_trav($tableName,$ticketNum){
    
        $updateData = array(
                    'ticket_status' => 'cancelled'
                );
                $condition = "`e_ticket_number` LIKE '%".$ticketNum."%'";
             //    LIKE '%MF23720823%' 
     
        $result =   $this->update($tableName, $updateData, $condition);
      //print_r($result);exit;
       return $result;		
       }
       //update cancelbooking table


        public function updateInDB_cancelbooking($tableName,$ticketNum){
    
        $updateData = array(
                    'ptr_status' => 'completed',
                    'cancel_status' =>1
                );
                $condition = "`ticket_number` LIKE '%".$ticketNum."%'";
             //    LIKE '%MF23720823%' 
     
        $result =   $this->update($tableName, $updateData, $condition);
     
       return $result;		
       }
       //===
       public function count_ticketed__temp_book($tableName,$bookingId){

            $condition = "`flight_booking_id` = $bookingId   AND (`ticket_status` LIKE '%Ticketed%' OR `ticket_status` LIKE '%TktInProcess%' OR `ticket_status` IS NULL)";
           // " `flight_booking_id` = 233 AND `ticket_status` LIKE '%Ticketed%'";
             //    LIKE '%MF23720823%' 
     
        $result =   $this->getCount($tableName,$condition);
      //print_r($result);exit;
       return $result;		
       }
    // Example method that uses the inherited methods from MyDatabaseClassPDO
    public function insertDataIntoDB($name, $email) {
        // You can now use the inherited methods to perform database operations
        if ($this->insertData($name, $email)) {
            echo "Data inserted successfully.";
        } else {
            echo "Failed to insert data.";
        }
    }
        // Example method that uses the inherited getListData method
    public function displaySelectDropdown() {
        $selectData = $this->getListData('temp_booking');

        if (!empty($selectData)) {
            echo '<select name="selectOption">';
            foreach ($selectData as $option) {
                echo '<option value="' . $option['id'] . '">' . $option['dep_location'] . '</option>';
            }
            echo '</select>';
        } else {
            echo 'No data found.';
        }
    }


    public function MArkup_percentage_value($roleId)
    {
    $MarkupData = $this->executeMarkupQuery($roleId);
        return $MarkupData;
    }

    */
    // Add more methods to use the inherited database class methods as needed


public function getProjectTitle($status=''){
    $tablename  =   "projects";
     $result =   $this->getProjectTitleCMS($status,$tablename);
      //print_r($result);exit;
       return $result;	
    
}
public function getProjectDetails($id){
    $tablename  =   "projects";
     $result =   $this->getDataById($tablename,$id);
     
       return $result;	
    
}
public function getPartnersList(){
    $tablename  =   "partners";
     $result =   $this->getListData($tablename);
     
       return $result;	
    
}
public function getPartnerDetails($id){
    $tablename  =   "partners";
     $result =   $this->getDataById($tablename,$id);
     
       return $result;	
    
}
/*
public function getResoures(){
  $tablename  =   "menus";
  $id = 4;
   $result =   $this->getResourceDetails($tablename,$id);
   
     return $result;	
}


public function getResourceList($id){
  $tablename  =   "menus";
   $result =   $this->getResourceById($tablename,$id);
   
     return $result;	
  
}
*/
public function getMenuList($id){
    $tablename  =   "menus";
    
     $result =   $this->getMenuLists($tablename,$id);
     
       return $result;	
    
}
public function getcmsSubMenuList($mid){
  
    $tablename  =   "cms";
     $result =   $this->getsubMenuLists($tablename,$mid);
     
       return $result;	
    
}
public function getcmsSubMenuId($title,$id){
  
    $tablename  =   "cms";
     $result =   $this->getCmsIdByTitle($tablename,$title,$id);
     
       return $result;	
    
}

// cms content by id
public function getcmsContentById($id){
  
    $tablename  =   "cms";
     $result =   $this->getContentByID($tablename,$id);
     
       return $result;	
    
}
public function generateMenu($parent_id = 0){
   // echo $parent_id."********************";
 // echo "LLLLL";exit;
    $menuItems = $this->getMenuList($parent_id);
    
 // echo "<pre/>"; print_r($menuItems);
    if (!empty($menuItems)) {
       
       // echo "<ul class='nav-menu align-to-right'>";
      //echo "<ul class='nav-dropdown'>";
        foreach ($menuItems as  $k => $menuItem) {
     $page_name_about_welcome   =   $menuItem['pagename'];                                     
    $cmsID     =   $this->getcmsSubMenuId($menuItem['menu'],$menuItem['_id']); 
   
    //project menu 
    if($page_name_about_welcome == "projects-listing.php"){
        $cmsTableId  =   $this->getProjectCMSById($menuItem['_id'],'projects');
    }
    else if($page_name_about_welcome == "partners-details.php"){
        $cmsTableId  =   $this->getProjectCMSById($menuItem['_id'],'partners');
    }
    else{
        $cmsTableId    =   $cmsID['_id'];
    }
      //  echo "PPP";  $cmsTableId;
            echo "<li>";
            if(!empty($cmsTableId)){
                $id     =  "?id=" .base64_encode($cmsTableId);
            }
            else{
                $id="";
            }
    if($page_name_about_welcome !=""){
     
   
               // echo "<a href='" . $page_name_about_welcome . "?id=" . base64_encode($cmsTableId) . "' target='_blank'>" . $menuItem['menu'] . "</a>";
                echo "<a href='" . $page_name_about_welcome .$id . "' >" . $menuItem['menu'] . "</a>";

    }
    else{
              
                 // echo "<a  href='' style='pointer-events: none;cursor: not-allowed;' >" . $menuItem['menu'] . "</a>";
                  echo "<a  href='' style='cursor: not-allowed;' >" . $menuItem['menu'] . "</a>";

    }
           
        //  echo "<a href='" . $page_name_about_welcome . "?id=" . base64_encode($cmsTableId) . "' target='_blank'>" . $menuItem['menu'] . "</a>";
         
    
            if($menuItem['child_menu_status'] == 1){
          echo '<ul class="nav-dropdown">';
         $this->generateMenu($menuItem['_id']); // Recursively generate submenus
              echo "</ul>";
            }
           echo "</li>";
      
        }
        //echo "</ul>";
    }
    
}
//reference library category
public function getREfCategories($id){
    $tablename  =   "categories";
    
     $result =   $this->getREfCat($tablename,$id);
     
       return $result;	
    
}
public function getREfLibraries($id){
    $tablename  =   "libraries";
    
     $result =   $this->getREfLib($tablename,$id);
     
       return $result;	
    
}
public function getRecentcCurProj(){
    $tablename  =   "projects";
    
     $result =   $this->getProjectTitle('Current');
     
       return $result;	
    
}
public function getREfCatDetails($id){
    $tablename  =   "categories";
    
     $result =   $this->getContentByID($tablename,$id) ;
     
       return $result;	
    
}
public function getREfLibraryById($id){
    $tablename  =   "libraries";
    
     $result =   $this->getContentByID($tablename,$id) ;
     
       return $result;	
    
}
public function getREfLibraryCatList(){
     $result =   $this->catLsit();
     
       return $result;	
    
}
public function searchLibraries($searchKeyword,$Where){
     $result =   $this->searchList($searchKeyword,$Where);
    // echo "LL";print_r($result);
       return $result;	
    
}
public function getFilesPublic(){
    $tablename  =   "posts";
    
     $result =   $this->getFileListData();
   //  print_r($result);
       return $result;	
    
}

/*
public function generateMenu($parent_id = 0){
 $menuItems = $this->getMenuList($parent_id);

    if (!empty($menuItems)) {
       
        foreach ($menuItems as $k => $menuItem) {
            echo '<li>';
            echo '<a href="# "target="_blank">' . $menuItem['menu'] . '</a>';
            
            // Check if there are child menu items
            $childMenuItems = $this->getMenuList($menuItem['_id']);
            if (!empty($childMenuItems)) {
                
                foreach ($childMenuItems as $childMenuItem) {
                    echo '<li">';
                    echo '<a href="#"  target="_blank">' . $childMenuItem['menu'] . '</a>';
                    echo '<ul class="nav-dropdown">';
                     $this->generateMenu($childMenuItem['_id']);
                      echo '</ul>';
                    echo '</li>';
                }
               
            }
            
            echo '</li>';
        }
        
    }
}
*/
  public function getContentDetails($id)
  {
      $tblname  =   "header_slider";
      $result =   $this->getHSById($tblname,$id);
      return $result;	
  }
}

?>