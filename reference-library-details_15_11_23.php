<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();
if(isset($_GET['id'])){
     $id =   base64_decode($_GET['id']);
}
  $categoryList     =   $objGen->getREfCatDetails($id);
    $categoryListDropdown     =   $objGen->getREfLibraryCatList();
  //=============================

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // print_r($_POST);exit;
    // Get the form field values
    $searchKeyword = isset($_POST['search_keyword']) ? $_POST['search_keyword'] : '';
    $searchFor = isset($_POST['searchFor']) ? $_POST['searchFor'] : '';
    $ordering = isset($_POST['ordering']) ? $_POST['ordering'] : '';
    $searchOnlyIn = isset($_POST['searchOnlyIn']) ? $_POST['searchOnlyIn'] : '';
    $searchCategory = isset($_POST['search_category']) ? $_POST['search_category'] : '';
    print_r($searchCategory);
   //========================================================
/*
   $Where = " WHERE "; // Initialize the WHERE clause

if ($searchFor === 'All words') {
    $searchTerms = explode(" ", $searchKeyword);

    // Create placeholders for the search terms
    $placeholders = array_map(function ($term) {
        return " (title LIKE '%$term%' OR short_description LIKE '%$term%' OR long_description LIKE '%$term%') ";
    }, $searchTerms);

    // Combine placeholders with OR
    $Where .= implode(" AND ", $placeholders);
    echo $Where;exit;
} elseif ($searchFor === 'Any words') {
    $Where .= " (title LIKE '%".$searchKeyword."%' OR short_description LIKE '%".$searchKeyword."%' OR long_description LIKE '%".$searchKeyword."%') ";
} elseif ($searchFor === 'Exact Phrase') {
    $Where .= " (title LIKE '%".$searchKeyword."%') ";
}

// Check the "Search Type" filter
if ($searchType === 'Titles') {
    if ($searchFor !== 'All words' && $searchFor !== 'Any words') {
        $Where .= " AND "; // Add AND if needed
    }
    $Where .= " title LIKE '%$searchKeyword%' ";
} elseif ($searchType === 'Descriptions') {
    if ($searchFor !== 'All words' && $searchFor !== 'Any words') {
        $Where .= " AND "; // Add AND if needed
    }
    $Where .= " (short_description LIKE '%$searchKeyword%' OR long_description LIKE '%$searchKeyword%') ";
}

*/




   
    // Use the form field values in your MySQL query
    // Construct your SQL query based on the form field values
   // $sql = "SELECT * FROM libraries WHERE title LIKE '%$searchKeyword%'";

    // You can add conditions to your SQL query based on other form field values
   if ($searchFor === 'on') {
      //  echo "nn";exit;
    /*      $searchFor_word = $_POST['searchFor'];
          // You can check its value like this:
    if ($searchFor_word === 'All words') {
        // Radio button with "Titles" was selected.
      $Where    = " WHERE title LIKE '%".$searchKeyword."%'"; 
    } elseif ($searchFor_word === 'Any words') {
        // Radio button with "Descriptions" was selected.
         $Where    = " WHERE short_description LIKE '%".$searchKeyword."%' OR long_description LIKE '%".$searchKeyword."%'"; 
    } elseif ($searchFor_word === 'Exact Phrase') {
        // Handle other cases if needed.
              $Where    = " WHERE title LIKE '%".$searchKeyword."%'"; 

    }
    else{}

    */
        //============================
    }
    $Where = "";
    $searchType = $_POST['searchOnlyIn'];    
   
    // Now, $searchType will contain the value of the selected radio button.
    // You can check its value like this:
    if ($searchType === 'Titles') {
         
        // Radio button with "Titles" was selected.
      $Where    = " WHERE title LIKE '%".$searchKeyword."%'"; 
    } elseif ($searchType === 'Descriptions') {
        
        // Radio button with "Descriptions" was selected.
         $Where    = " WHERE short_description LIKE '%".$searchKeyword."%' OR long_description LIKE '%".$searchKeyword."%'"; 
    } 
    else{
         $Where    = " WHERE title LIKE '%".$searchKeyword."%'"; 
    }
    if ($searchCategory !== '') {
    // Append the category condition to the WHERE clause
//    $Where .= " AND category_id = ".$searchCategory; // Replace 'category_id' with your actual column name
}

 //   echo $Where;
        //================================
    

    if ($ordering !== '') {
        // Add logic for ordering
        // Modify the $sql query accordingly
    }

    if ($searchOnlyIn === 'on') {
        // Add logic for searching only in specific fields
        // Modify the $sql query accordingly
    }

    if ($searchCategory !== '') {
        // Add logic for searching within a specific category
        // Modify the $sql query accordingly
    }
    
    // Execute your SQL query and fetch the results
    // ...

    // Display the search results
    // ...

     $categoryListSearch     =   $objGen->searchLibraries($searchKeyword,$Where);
    $files_Search_count =   count($categoryListSearch);
 // echo "yyyy<pre/>";   print_r($categoryListSearch);exit;
}


  //=========================
  //print_r($categoryList);
  //exit;
  ?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1">Reference Library</h2>
        </div>
    </section>
    <section class="reference-library-details-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <div class="row search-bar g-2 mb-lg-5 mb-4">
                <div class="col-lg-6">
                   <!-- <form class="row align-items-center g-2">
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
                            <select id="cat_list" name="cat_list" class="select-overview" title="Select a View or Category" onchange="redirectToDetailsPage(this)">
                                <option></option>
                                <option value="-1">All Downloads</option>

                                 <?php 
                                $i = 0;
                                foreach($categoryListDropdown as $k => $val){
                                    $i++; 
                                    ?>
                                <option value="<?php echo $val['category_id']; ?>"><?php echo $val['category_name']; ?></option>
                                <?php 
                                if(!empty($val['subcategory_name'])){ 
                                    ?>
                                <option value="<?php echo $val['subcategory_id']; ?>">- <?php echo $val['subcategory_name']; ?></option> 
                             <?php   
                                }
                                } ?>
                              
                            </select>
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
                    </form> -->
                      <div class="col-md-3 col-6">
                            <button type="reset" class="btn more-btn-blue btn-typ1 reset-btn" onclick="goBack()">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Back 
                            </button>
                        </div>
                </div>
            </div>
            <form action="reference-library-downloads.php" method="post">
            <!-- =============this section for category under files listing sections -to display parent/sub categories == -->
           <?php  if(!empty($categoryList)) { ?>
                <div class="row mb-5">
                    <div class="col-12">
                        <a href="#" class="ref-link">
                            <span class="ref-link-text">
                                <strong class="mb-md-0 mb-2"><?php echo $categoryList['category'];?></strong>
                                <?php  $subcategoriesList   =   $objGen->getREfCategories($categoryList['_id']);
                             
                                $subcategories  =count($subcategoriesList);
                            $filescounts =0;
                             $filescount =0;
                           $filescounts   =    count($objGen->getREfLibraries($categoryList['_id']));// parent category files count 
                          /* foreach($subcategoriesList as $key => $val){
                                                   
                            $filescount   +=    count($objGen->getREfLibraries($val['_id']));
                           }  
                           $total_filecount =  $filescounts +  $filescount; */
                       //    echo "PPPPPPPPPPPPPPPPPPP".$total_filecount;
                          //    print_r($subcategoriesList);
                            ?>
                                <span class="d-flex flex-column align-items-md-start">
                                    <span>Subcategories: <?php echo $subcategories; ?></span>
                                    <span>Files: <?php 
                             echo   $filescounts;
                             ?></span>
                                </span>
                            </span>
                        </a>
                          <input type="hidden" name="selectedcatTitle" id="selectedcatTitle" value="<?php echo $categoryList['category'];?>">
                            <input type="hidden" name="subCatCount" id="subCatCount" value="<?php echo $subcategories; ?>">
                              <input type="hidden" name="filesCount" id="filesCount" value="<?php echo $filescounts ?>">
                    </div>
                </div>

                <!-- *********************************sub category folder listing needed-->
                <?php if($subcategories >=1){ 
                   
//print_r($subcategoriesList);
                        foreach($subcategoriesList as $key => $subcategoriesLists){
                         ?>
                <div class="row mb-5">
                    <div class="col-12">
                        <a href="?id=<?php echo base64_encode($subcategoriesLists['_id']); ?>" class="ref-link">
                            <span class="ref-link-text">
                                <strong class="mb-md-0 mb-2"><?php echo $subcategoriesLists['category'];?></strong>
                                <?php  $sub_child_categoriesList   =   $objGen->getREfCategories($subcategoriesLists['_id']);
                             
                                $sub_child_categoriesList_count  =count($sub_child_categoriesList);
                            $filescounts_sub =0;

                           $filescounts_sub   =    count($objGen->getREfLibraries($subcategoriesLists['_id']));// parent category files count 
                          /* foreach($subcategoriesList as $key => $val){
                                                   
                            $filescount   +=    count($objGen->getREfLibraries($val['_id']));
                           }  
                           $total_filecount =  $filescounts +  $filescount; */
                       //    echo "PPPPPPPPPPPPPPPPPPP".$total_filecount;
                          //    print_r($subcategoriesList);
                            ?>
                                <span class="d-flex flex-column align-items-md-start">
                                    <span>Subcategories: <?php echo $sub_child_categoriesList_count; ?></span>
                                    <span>Files: <?php 
                             echo   $filescounts_sub;
                             ?></span>
                                </span>
                            </span>
                        </a>
                          <input type="hidden" name="selectedcatTitle_sub" id="selectedcatTitle_sub" value="<?php echo $subcategoriesList['category'];?>">
                            <input type="hidden" name="subCatCount_child" id="subCatCount_child" value="<?php echo $sub_child_categoriesList_count; ?>">
                              <input type="hidden" name="filesCount_sub" id="filesCount_sub" value="<?php echo $filescounts_sub ?>">
                    </div>
                </div>
                <?php
                       
                        }//end foreach
                    } ?>
                <!-- ****************************** -->
                           <?php    } ?> <!-- =============End  section for category under files listing sections -to display parent/sub categories == -->

                <div class="row my-4 ">
                    <div class="col-12 text-end">
                        <span class="select-all-pdf">
                            <input id="SelectAll" type="checkbox">
                            <label for="SelectAll">Select All</label>
                        </span>
                    </div>
                </div>
                <div class="row g-lg-4 g-md-3 g-2">
                <?php if($filescounts !=0){ 
                  $files_parent =     $objGen->getREfLibraries($categoryList['_id']);
                }
                else if($files_Search_count !=0){
                     $files_parent = $categoryListSearch;
                }
                //  print_r($files_parent);
                if(!empty($files_parent)){
                foreach($files_parent as $key => $val){
                    $originalDate_created = $val['created_at'];
                     $originalDate_updated = $val['updated_at'];
                $newDate_created = date("Y-m-d", strtotime($originalDate_created));
                 $newDate_updated = date("Y-m-d", strtotime($originalDate_updated));
                 $sizeInBytes = $val['fileSize'];
                $sizeInMB = $sizeInBytes / 1048576; // 1 MB = 1,048,576 bytes
               $sizeInMB = round($sizeInMB, 2);
                $author =$val['author'];
                $downloads  =   $val['downloads'];



                ?>
                    <div class="col-lg-6">
                        <div class="ref-lib-pdf-dwnd">
                            <div class="d-flex justify-content-between">
                                <div class="title-sec">
                                    <a href="#" class="hd-typ2"><?php echo $val['title']; ?></a>
                                    <p><?php echo $val['short_description']; ?></p>
                                </div>
                                <span class="select-pdf">
                                    <input id="checkbox_<?php echo $key; ?>" type="checkbox" name="selectedFiles[]" value="<?php echo $val['_id']; ?>">
                                    <label for="checkbox_<?php echo $key; ?>"></label>
                                    <span>HOT</span>
                                </span>
                            </div>
                            <hr>
                            <strong class="d-block mb-2">Information</strong>
                            <div class="row g-2 library-post-info">
                                <div class="col-xl-4 col-12">
                                    <div class="d-flex flex-column">
                                        <span>Created <?php echo $newDate_created; ?></span>
                                        <span>Changed <?php echo $newDate_updated;?></span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="d-flex flex-column">
                                        <span>Version</span>
                                        <span>Size <?php echo $sizeInMB;?> MB</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="d-flex flex-column">
                                        <span>Created by <?php echo $author; ?></span>
                                        <span>Downloads <?php echo $downloads;?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- <input type="hidden" name="selectedFiles[]" value="<?php echo $val['_id']; ?>">; -->

                        <input type="hidden" name="selectedIds" id="selectedIds" value="<?php echo $val['_id']; ?>">

                    <?php }
                } ?>
                    <!-- ===================== -- >
                    

                    <!-- ====== -->
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <button class="btn more-btn more-btn-blue btn-typ1 ms-auto me-0" id="continueButton" >Continue</button>
                    </div>
                </div>
            </form>
          <!--   <div class="pagination">
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
            </div>
            -->
        </div>
    </section>
    <!-- Add a hidden modal dialog -->
<!-- <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Please select at least one checkbox before continuing.</p>
  </div>
</div> -->
<div id="myModal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Please select minimum one checkbox before continuing.</p>
            </div>
        </div>
    </div>
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
            $('#SelectAll').click(function(event) {   
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;                        
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;                       
                    });
                }
            }); 
        })
        //**************************** */
// Show the modal dialog
function showModal() {
  const modal = document.getElementById('myModal');
  modal.style.display = 'block';
}

// Hide the modal dialog
function hideModal() {
  const modal = document.getElementById('myModal');
  modal.style.display = 'none';
}
const continueButton = document.getElementById('continueButton');
    const selectedIdsInput = document.getElementById('selectedIds');
    const individualCheckboxes = document.querySelectorAll('input[type="checkbox"]:not(#SelectAll)');

    // Function to collect selected checkbox values
    function collectSelectedIds() {
        const selectedIds = Array.from(individualCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);
        selectedIdsInput.value = selectedIds.join(','); // Store selected IDs as a comma-separated string
    }

    // Function to check if at least one checkbox is checked
    function isAnyCheckboxChecked() {
        return Array.from(individualCheckboxes).some(checkbox => checkbox.checked);
    }

    // Show the modal if no checkbox is checked when "Continue" is clicked
    function showModalIfNeeded(event) {
        if (!isAnyCheckboxChecked()) {
            event.preventDefault(); // Prevent the button click action
            showModal();
        }
    }

    // Attach click event listeners to checkboxes
    individualCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('click', collectSelectedIds);
    });

    // Attach click event listener to the "Continue" button
    continueButton.addEventListener('click', showModalIfNeeded);
     // Hide the modal when the close button is clicked
    const closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', hideModal);

     function goBack() {
        // Go back to the previous page
        window.history.back();
    }
    </script>
</body>

</html>