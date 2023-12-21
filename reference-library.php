<?php
error_reporting(0);

include_once('includes/header.php');
include_once('includes/class.General.php');

 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);
}

  //$categoryList     =   $objGen->getREfCategories(0);
   $categoryList     =   $objGen->getREfCategories(1);
  $categoryListDropdown     =   $objGen->getREfLibraryCatList();

  
//echo "<pre/>"; print_r($categoryListDropdown);
  //===================================
 /*  $totalItems = count($categoryList); // Total number of items exit;
$itemsPerPage = 2; // Number of items to display per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Calculate the offset for the SQL query based on the current page
$offset = ($currentPage - 1) * $itemsPerPage;

// Your data retrieval logic goes here (e.g., fetching items from a database)
//$items = range($offset + 1, $offset + $itemsPerPage); // Sample items, replace with your data
*/
  //*************************************

  $totalItems = count($categoryList); // Total number of items
$itemsPerPage = 6; // Number of items to display per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the total number of pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Ensure that the current page is within valid bounds
if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

// Calculate the offset and limit for slicing the array
$offset = ($currentPage - 1) * $itemsPerPage;
$limit = $itemsPerPage;

// Slice the array to get the items for the current page
$items = array_slice($categoryList, $offset, $limit);



// Pagination links go here (e.g., displaying page numbers with links)




  //*******************************

 //echo "<pre/>"; print_r(count($filescount)); exit;

?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1">Reference Library</h2>
        </div>
    </section>
    <section class="reference-library-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
        <form action="reference-library-details.php" method="POST" class="row search-bar g-2 mb-lg-5 mb-4">
           
                <div class="col-lg-6">
                    <div class="row align-items-center g-2">
                   
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
                                <input id="searchkey" type="search" placeholder="Search keyword" class="form-control" name="search_keyword">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn more-btn-blue btn-typ1">Search</button>
                        </div>
                     </div> 
                </div>
                <div class="col-lg-6">
                     <div  id="filterForm" class="row g-2"> 
                        <div class="col-md-6">
                            <select id="cat_list" name="cat_list" class="select-overview" title="Select a View or Category" onchange="redirectToDetailsPage(this)">
                                <option></option>
                              <!--  <option value="-1">All Downloads</option> -->
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
                            <button type="button" class="btn more-btn-blue btn-typ1 reset-btn" onclick="resetForm()">
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
                                    <select id="" name="ordering" class="sort-by" title="">
                                        <option value="">Newest first</option>
                                        <option value="">Oldest first</option>
                                    </select>
                                </div>
                                <strong class="mb-3">Search only in:</strong>
                                <div class="input-group d-flex mb-3">
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test4">
                                        <input type="radio" id="test4" name="searchOnlyIn" checked="checked" value="Titles">
                                        <span class="checkmark"></span>
                                        <span>Titles</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test5">
                                        <input type="radio" id="test5" name="searchOnlyIn" value="Descriptions">
                                        <span class="checkmark"></span>
                                        <span>Descriptions</span>
                                    </label>
                                 <!--   <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test6">
                                        <input type="radio" id="test6" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Changelog</span>
                                    </label> 
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test7">
                                        <input type="radio" id="test7" value="Author Name" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Author Name</span>
                                    </label>
                                    <label class="position-relative cstm-rdo mb-md-0 mb-2" for="test8">
                                        <input type="radio" id="test8" name="searchOnlyIn">
                                        <span class="checkmark"></span>
                                        <span>Meta-Tags</span>
                                    </label> -->
                                </div>
                                <div class="d-flex align-items-center flex-wrap">
                                    <strong class="me-3 my-2">Category:</strong>
                                    <select id="filter_cat_list" name="search_category" class="sort-by-category" title="">
                                        <option></option>
                                        <?php foreach($categoryListDropdown as $k => $val){
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
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row g-lg-4 g-md-3 g-2">
            <?php
            foreach($items as $key =>$val){ ?>
                <div class="col-md-4 col-6">
                    <a href="reference-library-details.php?id=<?php echo base64_encode($val['_id']); ?>" class="ref-link">
                        <span class="d-flex flex-column ref-link-text">
                            <strong class="mb-xl-3 mb-2"><?php echo $val['category'] ?></strong>
                            <?php  $subcategoriesList   =   $objGen->getREfCategories($val['_id']);
                            $subcategories   =   count($objGen->getREfCategories($val['_id']));
                            $filescounts =0;
                             $filescount =0;
                            $filescounts   +=    count($objGen->getREfLibraries($val['_id'])); //parent category files count 
                            foreach($subcategoriesList as $keys => $vals){
                                                   
                            $filescount   +=    count($objGen->getREfLibraries($vals['_id'])); // files from subcategories 
                           }  
                           $total_filecount =  $filescounts +  $filescount;
                           
                            
                            ?>

                            <span class="d-flex flex-column">
                                <span>Subcategories: <?php echo $subcategories; ?></span>
                        <?php /*   foreach($subcategories as $k => $vals){ 
                             $filescount   +=    count($objGen->getREfLibraries($vals['_id']));
                        }
                         $filescounts   +=   $filescount;
                         */
                        ?>
                                <span>Files: <?php 
                             echo   $total_filecount;
                             ?>
                        </span>
                         
                            </span>
                        </span>
                    </a>
                </div>
                <?php } ?>
           
            </div>
            <div class="pagination">
            <?php 
                if ($totalPages > 1) { ?>
                <p class="counter pull-right order-lg-1"><?php 
    echo 'Page ' . $currentPage . ' of ' . $totalPages;
                
                ?></p>
                <ul>

                    <li class="pagination-prev"><span class="pagenav"><?php
                     // Previous page link
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Prev</a>';
    }?></span></li>
    
    <?php
    // Page links
    for ($i = 1; $i <= $totalPages; $i++) {
        ?>
        <li>
      <?php   if ($i == $currentPage) {
            echo '<span class="pagenav">' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . '" class="pagenav">' . $i . '</a>';
        }
        ?>
        </li>
         <?php 
    }
                         ?>
                    
                   
               
             <li class="pagination-next">   <?php 
                
                 // Next page link
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '" class="hasTooltip pagenav" data-original-title="Next">Next</a>';
    }
                
                } ?>
                 </li> 
                  </ul>
            </div>
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
         function resetForm() {
        // Clear values from search boxes
        document.getElementById('searchkey').value = ''; // Replace 'searchBox' with the actual ID of your search box

        // Clear values from filters
        // You can add similar lines for other filter elements

        // Reset dropdown lists to their default values
        document.getElementById('cat_list').value = ''; // Replace 'dropdown1' with the actual ID of your dropdown list
       // document.getElementById('dropdown2').selectedIndex = 0; // Replace 'dropdown2' with the actual ID of another dropdown list

        // Add more lines as needed for other form elements
    }
    </script>
</body>

</html>