<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/ 
error_reporting(0);
 include_once('includes/class.General.php');
 $objGen    =   new General();
 $projectList     =   $objGen->getProjectTitle('completed'); 
 $projectListCurrent     =   $objGen->getProjectTitle('current'); 
  $partnersList     =   $objGen->getPartnersList(); 
//  $resouseDetails=$objGen->getResoures();
 
 
 // $menu_aboutUsList     =   $objGen->getMenuList(9); 
   // $menu_hlpuList     =   $objGen->getMenuList(7); 
  //about us 
  //$aboutUsList     =   $objGen->getcmsSubMenuList(9); 
 //$page_name 		= end(explode("/",$_SERVER['PHP_SELF']));
 $page_name =   "projects-listing.php";
 $page_name_partner =   "partners-details.php";
  $page_name_hlpu =   "hlpu.php";
//  $page_name_resources="resoures-listing.php";
//$menu_all     =   $objGen->generateMenu($parent_id = 0);exit;

// print_r($menu_hlpuList);exit;
?>
<div class="top-link d-md-block d-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 top-text mb-xl-0 mb-2">
                        Micronesian Center for Sustainable Transport, College of the Marshall Islands
                    </div>
                    <div class="col-xl-6">
                        <ul class="top-right-links">
                            <li>
                                Email: <a href="mailto:info@mcst-rmi.org">info@mcst-rmi.org</a>
                            </li>
                            <li>
                                Contact: <a href="tel:+(692) 625-3394 ">+(692) 625-3394 (Ext. 359 or 376)</a>
                            </li>
                            <li class="social-links">
                                <a href="https://twitter.com/mcst_rmi"><img src="images/twitter-icon.svg" alt=""></a>
                                <a href="https://www.facebook.com/MicronesianCenterforSustainableTransport"><img src="images/fb-icon.svg" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_header_area animated">
            <div class="container">
                <nav id="navigation1" class="navigation">
                    <div class="nav-header">
                        <a class="nav-brand" href="#">
                            <h1 class="m-0"><img src="images/logo.png" alt="logo"></h1>
                        </a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper">
                    <ul class="nav-menu align-to-right">
                         <!--   <li class="active">
                                <a href="index.php" target="_blank">Home</a>
                            </li> -->
                    <?php 
                    $menu_all     =   $objGen->generateMenu($parent_id = 0);
                    ?>

                       
                         <!--   
                                <a href="index.php" target="_blank">Home</a>
                            </li>
                            <li>
                                <a href="about-us.php">About Us</a>
                                <ul class="nav-dropdown">
                                 <?php  foreach($menu_aboutUsList as $k => $val){
                                        $aboutUsList     =   $objGen->getMenuList($val['_id']); 
                                        $page_name_about_welcome   =   $val['pagename'];                                     
                                         $cmsID     =   $objGen->getcmsSubMenuId($val['menu'],$val['_id']); 
                                         $cmsTableId    =   $cmsID['_id'];
                                        if(count($aboutUsList) == 0 ){
                                        
                                       ?>
                                    <li>
                                        <a href="<?php echo $page_name_about_welcome."?id=".base64_encode($cmsTableId); ?>" target="_blank"><?php echo $val['menu']; ?></a>
                                    </li>
                                     <?php } else {
                                         
                                     ?>
                                     <li>
                                        <a href="<?php echo $page_name_about_welcome."?id=".base64_encode($cmsTableId); ?>"><?php echo $val['menu']; ?></a>
                                        <ul class="nav-dropdown">
                                        <?php
                                        foreach($aboutUsList as $k => $vals){
                                            $cmsIDsub     =   $objGen->getcmsSubMenuId($vals['menu'],$vals['_id']); 
                                         $cmsTableId_sub    =   $cmsIDsub['_id'];
                                         $page_name_about_welcome   =   $vals['pagename'];       
                                            ?>
                                            <li>
                                                <a href="<?php echo $vals['pagename']."?id=".base64_encode($cmsTableId_sub); ?>" target="_blank"><?php echo $vals['menu']; ?></a>
                                            </li>
                                             <?php } ?>
                                        </ul>
                                         <?php } ?>
                                    </li>
                                     <?php } ?>
                                </ul>
                            </li>
                     <!--       <li>
                                <a href="breaking-stories.php">News</a>
                                <ul class="nav-dropdown">
                                    <li>
                                        <a href="#" target="_blank">breaking-stories-details.php</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 2</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 3</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 4</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 5</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="hlpu.php">High Level Policy Unit</a>
                                <ul class="nav-dropdown">
                                    <li>
                                        <a href="#">Menu Level 2</a>
                                        <ul class="nav-dropdown">
                                            <li>
                                                <a href="#" target="_blank">Link 1</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 2</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 3</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Menu Level 2</a>
                                        <ul class="nav-dropdown">
                                            <li>
                                                <a href="#">Menu Level 3</a>
                                                <ul class="nav-dropdown">
                                                    <li>
                                                        <a href="#">Link 1</a>
                                                        <ul class="nav-dropdown">
                                                            <li>
                                                                <a href="#" target="_blank">Link 1</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" target="_blank">Link 2</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" target="_blank">Link 3</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" target="_blank">Link 4</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" target="_blank">Link 5</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">Link 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">Link 2</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">Link 3</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">Link 4</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" target="_blank">Link 5</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 1</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 2</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 3</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 4</a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">Link 5</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 1</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 2</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 3</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 4</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Link 5</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="projects-all_listing.php">Projects</a>
                                <ul class="nav-dropdown">
                                    <li>
                                        <a href="#">Current Projects</a>                                    

                                        <ul class="nav-dropdown">
                                         <?php  foreach($projectListCurrent as $k => $val){
                                         // print_r($val);
                                       ?>
                                            
                                            <li>
                                                <a href="<?php echo $page_name."?id=".base64_encode($val['_id']); ?>" target="_blank"><?php echo $val['title']; ?></a>
                                            </li>
                                           <?php } ?> 
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Completed Projects</a>
                                       
                                      
                                        <ul class="nav-dropdown">
                                           <?php  foreach($projectList as $k => $val){
                                         // print_r($val);
                                       ?>
                                            <li>
                                                <a href="<?php echo $page_name."?id=".base64_encode($val['_id']); ?>" target="_blank"><?php echo $val['title']; ?></a>
                                            </li>
                                             <?php } ?>
                                          
                                        </ul>
                                       
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="partners-listing.php">Partners</a>
                                <ul class="nav-dropdown">
                                 <?php  foreach($partnersList as $k => $val){
                                        
                                       ?>
                                    <li>
                                        <a href="<?php echo $page_name_partner."?id=".base64_encode($val['_id']); ?>" target="_blank"><?php echo $val['title']; ?></a>
                                    </li>
                                     <?php } ?>
                                </ul>
                            </li>
                            <li>
                                <a href="resoures-listing.php">Resources</a>
                                <ul class="nav-dropdown">
                                <?php  foreach($resouseDetails as $k => $val){
                                        ?>
                                     <li>
                                         <a href="<?php echo $page_name_resources."?id=".base64_encode($val['_id']); ?>" target="_blank"><?php echo $val['menu']; ?></a>
                                         <ul class="nav-dropdown">
                                        <li>
                                            <?php  foreach($resouseDetails as $k => $val){
                                                  ?>
                                                <a href="<?php echo $page_resources."?id=".base64_encode($val['_id']); ?>" target="_blank"><?php echo $val['menu']; ?></a>
                                                <?php } ?>
                                        </li>
                                     <li>
                                      <a href="#">Subitem 2</a>
                                    </li>
                
                                </ul>
                                        </li>
                                      
                                     <?php } ?>
                                     
                                     </li>
                                      
                                </ul>
                            </li>
                            <li>
                                <a href="#">Our Blog</a>
                            </li>
                            <li>
                                <a href="reference-library.php">Reference Library</a>
                            </li>
                            <li>
                                <a href="contact-us.php">Contact Us</a>
                            </li>   -->
                            <li class="login">
                                <a href="login.php" class="login-btn">Login</a>
                            </li>

                          
                        </ul>
                    </div>
                </nav>
            </div>
        </div>