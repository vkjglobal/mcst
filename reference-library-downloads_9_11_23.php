<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo phpinfo();exit;
//error_reporting(0);
session_start();
//include_once('includes/header.php');
 include_once('includes/class.General.php');
$objGen    =   new General();
  $categoryListDropdown     =   $objGen->getREfLibraryCatList();

//print_r($_POST);
if(isset($_POST['DownloadClick'])){
   
     if (isset($_SESSION["downloadFiles"]) && !empty($_SESSION["downloadFiles"])) {
         $downloadFiles =   $_SESSION["downloadFiles"];
         //  $tempDir = sys_get_temp_dir() . '\mytempdir_' . time();
       // mkdir($tempDir);
       
        //===============================
        foreach ($downloadFiles as $libraryId) {
             $selectedFile     =   $objGen->getREfLibraryById($libraryId); //from library id 
            
             $parent_sub_cat     =   $objGen->getREfCatDetails($selectedFile['category_id']); // to get parent/sub category folder name 
            
             if($parent_sub_cat['parent_category_id'] != 1){
                 //name of parentcategory  folder 
                 $parent_cat     =   $objGen->getREfCatDetails($parent_sub_cat['parent_category_id'] );

             }
            
                    
                 $fileName  =   $selectedFile['file'];
                $filenameWithExtension = basename($fileName);
                //=========================================


       
                //**************************************************************
$mainCategory =   $parent_sub_cat['category']; // Replace with actual parent category name
$parentCategory    ='';
if(!empty($parent_cat)){
$parentCategory = $parent_cat['category']; // Replace with actual subcategory name
$parentCategory =  '/'. $parentCategory . '/';
}
//$filename = "example.pdf"; // Replace with actual filename

// Define the base directory where your files are stored
$baseDirectory = "files"; // Replace with the actual file path on your server

// Construct the complete file path
$filePath  = $baseDirectory .$parentCategory.'/'. $mainCategory . '/'. $fileName;
//echo $libraryId."#############".$filePath."\n";

//echo $fileName;
        $tempDir    ="uploads/zip";
        //echo $tempDir . '/selected_files.zip';
       // echo "************************************\n";
        //=================================
        // Directory where your files are located
        $filesDirectory = $baseDirectory .$parentCategory.'/'. $mainCategory . '/';
        if(!empty($fileName)){
        copy($filePath, $tempDir . '/' . basename($fileName));
        }
        }
        // Create a ZIP archive for the selected files
         $zipFilename = $tempDir . '/selected_files.zip'; 
        $zip = new ZipArchive();
        if ($zip->open($zipFilename, ZipArchive::CREATE) === true) {
            // Add all files from the temporary directory to the ZIP archive
            foreach (scandir($tempDir) as $file) {
                if (is_file($tempDir . '/' . $file)) {
                    $zip->addFile($tempDir . '/' . $file, $file);
                }
            }
            $zip->close();
        }
       

        if (headers_sent()) {
    echo 'HTTP header already sent';
} 
       //echo dirname(__FILE__)."/".$zipFilename;
       //*******************
       header('Content-Type: application/x-download');
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' .filesize($zipFilename));
header('Content-Disposition: attachment; filename="selected_files.zip"');
readfile($zipFilename);
// Clean up: remove the temporary files and directory
        foreach (scandir($tempDir) as $file) {
            if (is_file($tempDir . '/' . $file)) {
                unlink($tempDir . '/' . $file);
            }
        }
        unset($_SESSION["downloadFiles"]);
exit;
       //******************
      
    }     
    
}
   if(isset($_POST)) {
    $selectedcatTitle   =   $_POST['selectedcatTitle'];   
     $subCatCount   =   $_POST['subCatCount'];
      $filesCount   =   $_POST['filesCount'];
    //   $libraryId   =   $_POST['selectedIds'];       
       
} 
include_once('includes/header.php');
?><section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1">Reference Library</h2>
        </div>
    </section>
    <section class="reference-library-details-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <div class="row search-bar g-2 mb-lg-5 mb-4">
                <div class="col-lg-6">
                    <form class="row align-items-center g-2">
                        <div class="col-9">
                            <div class="search-input">
                                <span class="d-flex ps-3 pe-0">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.2049 12.952L18 16.7462L16.7462 18L12.952 14.2049C11.5402 15.3366 9.78419 15.9522 7.9748 15.9496C3.57271 15.9496 0 12.3769 0 7.9748C0 3.57271 3.57271 0 7.9748 0C12.3769 0 15.9496 3.57271 15.9496 7.9748C15.9522 9.78419 15.3366 11.5402 14.2049 12.952ZM12.4274 12.2945C13.5519 11.138 14.18 9.58786 14.1774 7.9748C14.1774 4.54741 11.4013 1.77218 7.9748 1.77218C4.54741 1.77218 1.77218 4.54741 1.77218 7.9748C1.77218 11.4013 4.54741 14.1774 7.9748 14.1774C9.58786 14.18 11.138 13.5519 12.2945 12.4274L12.4274 12.2945Z"
                                            fill="#000000"></path>
                                    </svg>
                                </span>
                                <input type="search" placeholder="Search keyword" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn more-btn-blue btn-typ1">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form action="" class="row g-2">
                        <div class="col-md-6">
                            <select id="cat_list" name="cat_list" class="select-overview" title="Select a View or Category"  onchange="redirectToDetailsPage(this)">
                                <option></option>
                                <option value="-1">All Downloads</option><?php 
                                $i = 0;
                                foreach($categoryListDropdown as $k => $val){
                                    $i++; 
                                    ?><option value="<?php echo $val['category_id']; ?>"><?php echo $val['category_name']; ?></option><?php 
                                if(!empty($val['subcategory_name'])){ 
                                    ?><option value="<?php echo $val['subcategory_id']; ?>">- <?php echo $val['subcategory_name']; ?></option><?php   
                                }
                                } ?></select>
                        </div>
                        <div class="col-md-3 col-6">
                            <button type="button" class="form-control filter-btn">
                                <i class="fa fa-filter"></i>
                                Fitters
                                <span></span>
                            </button>
                        </div>
                        <div class="col-md-3 col-6">
                            <button type="reset" class="btn more-btn-blue btn-typ1 reset-btn">
                                <i class="fa-solid fa-rotate-right me-2"></i>
                                Reset
                            </button>
                        </div>
                        <div class="filter-dropdown">
                            <div class="d-flex flex-column">
                                <strong class="mb-3">Search for:</strong>
                                <div class="input-group d-flex mb-3">
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test1">
                                        <input type="radio" id="test1" name="searchFor" checked="checked">
                                        <span class="checkmark"></span>
                                        <span>All words</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test2">
                                        <input type="radio" id="test2" name="searchFor">
                                        <span class="checkmark"></span>
                                        <span>Any words</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test3">
                                        <input type="radio" id="test3" name="searchFor">
                                        <span class="checkmark"></span>
                                        <span>Exact Phrase</span>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center flex-wrap mb-3">
                                    <strong class="me-3 my-2">Ordering:</strong>
                                    <select id="" name="" class="sort-by" title="">
                                        <option value="">Newest first</option>
                                        <option value="">Oldest first</option>
                                    </select>
                                </div>
                                <strong class="mb-3">Search only in:</strong>
                                <div class="input-group d-flex mb-3">
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test4">
                                        <input type="radio" id="test4" name="searchOnlyIn" checked="checked">
                                        <span class="checkmark"></span>
                                        <span>Titles</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test5">
                                        <input type="radio" id="test5" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Descriptions</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test6">
                                        <input type="radio" id="test6" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Changelog</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test7">
                                        <input type="radio" id="test7" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Author Name</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test8">
                                        <input type="radio" id="test8" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Meta-Tags</span>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center flex-wrap">
                                    <strong class="me-3 my-2">Category:</strong>
                                    <select id="" name="" class="sort-by-category" title="">
                                        <option></option>
                                        <option>Marshall Islands</option>
                                        <option>Cook Islands</option>
                                        <option>Fisheries fuel and emissions</option>
                                        <option>Fiji Shipping</option>
                                        <option>Green Port and Port Efficiency</option>
                                        <option>IMO Reports</option>
                                    </select>
                                </div>                     
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <a href="#" class="ref-link">
                        <span class="ref-link-text">
                            <strong class="mb-md-0 mb-2"><?php echo  $selectedcatTitle; ?></strong>
                            <span class="d-flex flex-column align-items-md-start">
                                <span>Subcategories:<?php echo $subCatCount ?></span>
                                <span>Files:<?php echo $filesCount ?></span>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row g-lg-4 g-md-3 g-2"><?php 
            //*****************************
            
                //*************************new with multiple file ids selected**********
                if (isset($_POST["selectedFiles"])) {
        $selectedFiles = $_POST["selectedFiles"];
        $_SESSION['downloadFiles']  =   $selectedFiles;
       // print_r($selectedFiles);exit;
        // Loop through the selected file IDs and initiate downloads
        foreach ($selectedFiles as $libraryId) {
             $selectedFile     =   $objGen->getREfLibraryById($libraryId); //from library id 
              //=============
        $originalDate_created = $selectedFile['created_at'];
                     $originalDate_updated = $selectedFile['updated_at'];
                $newDate_created = date("Y-m-d", strtotime($originalDate_created));
                 $newDate_updated = date("Y-m-d", strtotime($originalDate_updated));
                 $sizeInMB = $selectedFile['size'];
               // $sizeInMB = $sizeInBytes / 1048576; // 1 MB = 1,048,576 bytes
             //  $sizeInMB = round($sizeInMB, 2);
                $author =$selectedFile['author'];
                $downloads  =   $selectedFile['downloads'];
                //==========================
                 $parent_sub_cat     =   $objGen->getREfCatDetails($selectedFile['category_id']); // to get parent/sub category folder name 
            
             if($parent_sub_cat['parent_category_id'] != 1){
                 //name of parentcategory  folder 
                 $parent_cat     =   $objGen->getREfCatDetails($parent_sub_cat['parent_category_id'] );

             }
            
                    
                 $fileName  =   $selectedFile['file'];
                $filenameWithExtension = basename($fileName);
                //=========================================


       
                //**************************************************************
$mainCategory =   $parent_sub_cat['category']; // Replace with actual parent category name
$parentCategory    ='';
if(!empty($parent_cat)){
$parentCategory = $parent_cat['category']; // Replace with actual subcategory name
$parentCategory =  '/'. $parentCategory . '/';
}
//$filename = "example.pdf"; // Replace with actual filename

// Define the base directory where your files are stored
$baseDirectory = "files"; // Replace with the actual file path on your server

// Construct the complete file path
$fileName  = $baseDirectory .$parentCategory.'/'. $mainCategory . '/'. $fileName;



                //=============================

                /*
                 $fileName  =   $selectedFile['file'];
                $filenameWithExtension = basename($fileName);
                //=========================================


       
                //**************************************************************
$parentCategory = $selectedcatTitle; // Replace with actual parent category name
$subCategory = "SubCategory"; // Replace with actual subcategory name
//$filename = "example.pdf"; // Replace with actual filename

// Define the base directory where your files are stored
$baseDirectory = "files"; // Replace with the actual file path on your server

// Construct the complete file path
$fileName = $baseDirectory .'/'. $parentCategory . '/'. $fileName;
//echo $fileName;

// Now $filePath contains the full path to your file

 */
            //*******************************
                ?><div class="col-lg-6">
                    <div class="ref-lib-pdf-dwnd">
                        <div class="d-flex justify-content-between">
                            <div class="title-sec">
                                <a href="#" class="hd-typ2"><?php echo  $selectedFile['title']; ?></a>
                                <p><?php echo  $selectedFile['short_description']; ?></p>
                            </div>
                            <span class="select-pdf">
                             <!--   <input id="checkbox1" type="checkbox">
                                <label for="checkbox1"></label> -->
                                <span>HOT</span>
                            </span>
                        </div>
                        <hr>
                        <strong class="d-block mb-2">Information</strong>
                        <div class="row g-2 library-post-info">
                            <div class="col-12">
                             <!--   <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">License</span>
                                    <span class="col-8 text-end"> </span>
                                </div> -->
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">Size</span>
                                    <span class="col-8 text-end"><?php echo $sizeInMB;?></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">File Date</span>
                                    <span class="col-8 text-end"></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">File name</span>
                                    <span class="col-8 text-end"><?php echo $filenameWithExtension;?></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">Downloads</span>
                                    <span class="col-8 text-end"><?php echo $downloads;?></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">Created</span>
                                    <span class="col-8 text-end"><?php echo $newDate_created; ?></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                    <span class="col-4">Changed</span>
                                    <span class="col-8 text-end"><?php echo $newDate_updated;?></span>
                                </div>
                                <div class="row justify-content-between align-items-center mb-2">
                                  <!--  <span class="col-4">Version</span> -->
                                    <span class="col-8 text-end"></span>
                                </div>
                                <div class="row justify-content-between align-items-center mt-5">
                                    <span class="col-6"><button type="button" class="btn more-btn btn-typ1 more-btn-blue" onclick="goBack()">Back</button></span>
                                  <?php if(count($selectedFiles) == 1){ ?><span class="col-6 text-end"><button type="button"  class="btn more-btn btn-typ1 me-0 ms-auto" id="downloadButton" data-fileurl="<?php echo $fileName; ?>">Download</button></span><?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php }
                } ?></div>
 <div class="row mt-5">
 <form name="downloadAll" action="" method="post">
 <?php if(count($selectedFiles) >1){ ?>
                    <div class="col-12">
                        <button class="btn more-btn more-btn-blue btn-typ1 ms-auto me-0" id="continueButton" type="submit" name="DownloadClick">DownloadAll</button>
                    </div><?php } ?></form>
                </div>
        <!--    <div class="pagination">
                <p class="counter pull-right order-lg-1"> Page 1 of 280 </p>
                <ul>
                    <li class="pagination-start"><span class="pagenav">Start</span></li>
                    <li class="pagination-prev"><span class="pagenav">Prev</span></li>
                    <li><span class="pagenav">1</span></li>
                    <li><a href="#" class="pagenav">2</a></li>
                    <li><a href="#" class="pagenav">3</a></li>
                    <li><a href="#" class="pagenav">4</a></li>
                    <li><a href="#" class="pagenav">5</a></li>
                    <li><a href="#" class="pagenav">6</a></li>
                    <li><a href="#" class="pagenav">7</a></li>
                    <li><a href="#" class="pagenav">8</a></li>
                    <li><a href="#" class="pagenav">9</a></li>
                    <li><a href="#" class="pagenav">10</a></li>
                    <li class="pagination-next"><a title="" href="#" class="hasTooltip pagenav"
                            data-original-title="Next">Next</a></li>
                    <li class="pagination-end"><a title="" href="#" class="hasTooltip pagenav"
                            data-original-title="End">End</a></li>
                </ul>
            </div> -->
        </div>
    </section>
    <?php
include_once('includes/footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      function redirectToDetailsPage(selectElement) {
        var selectedValue = selectElement.value;
        if (selectedValue) {
           // var url = 'reference-library-details.php?id=' + selectedValue;
           // window.location.href = url;
            var encodedValue = btoa(selectedValue); // Encode the selectedValue
            var url = 'reference-library-details.php?id=' + encodedValue;
            window.location.href = url;
        }
    }
        $(document).ready(function () {
            $('.home-banner').owlCarousel({
                loop: false,
                autoplay: false,
                mouseDrag: false,
                nav: false,
                dots: false,
                items: 1,
                smartSpeed: 450
            });
            $(".filter-btn").click(function(){
                $(this).toggleClass("open");
                $(".filter-dropdown").slideToggle();
            });
            $('.select-overview').select2({
                minimumResultsForSearch: Infinity,
                placeholder: "Overview"
            });
            $('.sort-by').select2({
                minimumResultsForSearch: Infinity
            });
            $('.sort-by-category').select2({
                minimumResultsForSearch: Infinity,
                placeholder: "Select Category"
            });
        })
        //=====
        function goBack() {
          
            window.history.back();
        }
        //=====
        document.getElementById("downloadButton").addEventListener("click", function() {
    // Get the file URL from the data-fileurl attribute of the button
    var fileUrl = this.getAttribute("data-fileurl");
    
    // Check if a valid file URL is present
    if (fileUrl) {
        // Create an anchor element (hidden) to trigger the download
        var a = document.createElement("a");
        a.href = fileUrl;
        a.download = "downloaded_file.pdf"; // Rename the file if needed
        a.style.display = "none"; // Hide the anchor element
        
        // Append the anchor element to the document
        document.body.appendChild(a);
        
        // Trigger a click event on the anchor element to start the download
        a.click();
        
        // Remove the anchor element from the document
        document.body.removeChild(a);
    } else {
        // Handle the case when no file URL is available
        alert("File URL is not defined.");
    }
});
    </script>
</body>

</html>