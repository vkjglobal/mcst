<?php 
// echo "PPPPPPPPPPP";exit;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


include_once('includes/header.php');
include_once('includes/dbConnect.php');
include_once('includes/dbblog.php');

try {
    $query = "SELECT `_id`,image FROM partners";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM `cms` WHERE `menu__-` LIKE 'Hig%' ORDER BY `created_at` LIMIT 1;";
    $stmt1 = $conn->prepare($sql);
    $stmt1->execute();
    $result = $stmt1->fetch(PDO::FETCH_ASSOC);
    $query1 = "SELECT * FROM cms where title LIKE 'histor%'";
    $stmt = $conn->prepare($query1);
    $stmt->execute();
    $history=$stmt->fetch(PDO::FETCH_ASSOC);
    $query3 = "SELECT * FROM projects where title LIKE 'ceru%'";
    $stmt = $conn->prepare($query3);
    $stmt->execute();
    $project=$stmt->fetch(PDO::FETCH_ASSOC);
    $query4 = "SELECT * FROM cms  where menu_id=14";
    $stmtt = $conn->prepare($query4);
    $stmtt->execute();
    $pro=$stmtt->fetchAll(PDO::FETCH_ASSOC);
    $query3 = "SELECT * FROM header_slider where status = 0 ORDER BY id DESC ";
    $stmt = $conn->prepare($query3);
    $stmt->execute();
    $projects=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //blog db
   
    $query4 = "SELECT * FROM wp_posts WHERE post_status LIKE 'publish%' LIMIT 4";
    $stmt_blog = $dbh->prepare($query4);
    $stmt_blog->execute();
    $blog = $stmt_blog->fetchAll(PDO::FETCH_ASSOC);

    
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();

}


?>
    <section class="banner-section light-blue-bg py-xl-5 py-lg-4 py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 mb-xl-0 mb-lg-5 mb-3">
                    <div class="home-banner owl-carousel owl-theme">
                    <?php foreach ($projects as $partner): ?>
    <div class="item">
        <div class="row">
            <div class="col-lg-6 tab-abs">
             <div class="d-flex h-100 flex-column justify-content-between px-1">
                <div class="mb-lg-5">
                <h2 class="mb-md-3"><?php echo $partner['title']; ?></h2>
                <?php
                    // Get the content and strip HTML tags
                    $content = strip_tags(html_entity_decode($partner['short_desc']));
                    
                    // Find the first period (.) in the content
                    $firstPeriodPosition = strpos($content, '.');
                    
                    // If a period is found, extract the content up to that point, including the period
                    if ($firstPeriodPosition !== false) {
                        $firstLine = substr($content, 0, $firstPeriodPosition + 1);
                        
                    } else {
                        // If no period is found, use the entire content
                        $firstLine = $content;
                    }
                ?>
                <p class="mb-md-3"><?php echo $firstLine; ?></p>
                </div>
                <a href="header_slider_listing.php?id=<?php echo $partner['id']; ?>" class="btn more-btn">Learn More</a>
                
                <!-- You can add other content here as needed -->
            </div>
            </div>
            <div class="col-lg-6">
            <div class="img-wrp mb-xl-5" style="background-image: url(admin/uploads/<?php echo $partner['image']; ?>);">
                <!-- Output the image here -->
             <!--   <img src="<?php echo $partner['image']; ?>" alt=""> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
                        
                    </div>
                </div>
                <div class="col-xl-5">
    <div class="d-flex flex-column align-items-stretch h-100 justify-content-between position-relative mb-2">
        <h2 class="align-items-start h6 mb-0">News and Press Release</h2>
        <div class="slider">
            <?php foreach ($pro as $p) : ?>
                <div class="bx-item">
                <?php
$date = $p['created_at']; // Assuming $p['created_at'] contains the date-time value

// Format the date as YYYY-MM-DD
$formattedDate = date('Y-m-d', strtotime($date));

?>
                   <a href="hlpu.php?id=<?php echo base64_encode ($p['_id']); ?>"><?php echo $formattedDate ?> - <?php echo $p['title']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

            </div>
        </div>
        <div class="link-wrp container d-none justify-content-center">
            <div class="d-flex align-items-center">
                <a href="#" class="rotate-link">
                    <img src="images/round-text.svg" alt="">
                </a>
            </div>
        </div>
    </section>               
    <section class="current-project-section dark-blue-bg info-section pt-4 pb-lg-5 pb-3">
    <div class="container">
        <h2 class="hd-typ1 text-center mb-lg-5 mb-4">Current Projects</h2>
        <div class="row g-xl-5">
            <div class="col-lg-6">
                <div class="img-wrp">
                    <img src="<?php echo $projects[0]['image']; ?>" class="rounded-5" alt="">
                </div>
            </div>
            <div class="col-lg-6 ps-xl-5">
                <h3 class="hd-typ1 black-text"><?php echo $projects[0]['title']; ?>                   
                </h3>
                <p class="info-text-typ1 mb-xl-5 mb-lg-4 mb-3">
                    <?php
                    $content = $projects[0]['content']; // Get the content from the database
                    
                    // Split the content into sentences (assuming sentences end with '.', '!', or '?')
                    $sentences = preg_split('/(?<=[.!?])\s+/', $content);

                    // Remove the first two sentences and keep the next 4 sentences
                    $firstSentencesRemoved = array_slice($sentences, 1, 1, 0);

                    // Reconstruct the content with line breaks
                    $displayContent = implode("\n", $firstSentencesRemoved);
                    echo ($displayContent);
                    
                   /*  $lines = explode("<p>", $content); // Split the content into lines
                       //  echo "LLLLLLLLLLLLLLLL"; print_r($lines);
                    // Remove lines 1 and 3, and keep the next 10 lines
                    unset($lines[0]);                

                    // Reconstruct the content with line breaks
                    $displayContent = implode("<p>", $lines);
                  // echo "MMMMMMMMM"; print_r($displayContent);
                  $plainTextContent = strip_tags($content);
                    $maxLength = 100; // Maximum length for the short description
                $shortDescription = substr($plainTextContent, 0, $maxLength);

                    echo $shortDescription;
                    */
                    ?>
                </p>
                <div class="d-flex justify-content-lg-start">
                    <a href="projects-all_listing.php?id=ODI2" class="btn more-btn ">More Projects</a>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="img-right-section orange-bg info-section pt-4 pb-lg-5 pb-3">
    <div class="container">
        <h2 class="hd-typ1 text-center mb-lg-5 mb-4">What is the MCST and where did it come from?</h2>
        <div class="row g-xl-5">
            <div class="col-lg-6 order-lg-1">
                <div class="img-wrp">
                    <img src="images/img6.png" class="rounded-5" alt="">
                </div>
            </div>
            <div class="col-lg-6 pe-xl-5 order-lg-0">
               <!-- <strong class="hd-typ2 white-text mb-xl-4 mb-3">History</strong>-->
                <p class="info-text-typ1 mb-xl-5 mb-lg-4 mb-3">
                    <?php
                    $content = $history['content']; // Get the content from the database
                    $lines = explode("\n", $content); // Split the content into lines

                    // Remove lines 1 and 3, and keep the next 10 lines
                    unset($lines[0], $lines[3]);
                    $firstLines = array_slice($lines, 0, 12);

                    // Reconstruct the content with line breaks
                    $displayContent = implode("\n", $firstLines);
                    echo ($displayContent); // Use nl2br to convert newlines to <br> tags
                    ?>
                </p>
                <div class="d-flex justify-content-lg-start">
                <a href="hlpu.php?id=<?php echo base64_encode($history['_id']); ?>" class="btn more-btn more-btn-white">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="img-left-section light-blue-bg info-section pt-4 pb-lg-5 pb-3">
        <div class="container">
            <h2 class="hd-typ1 text-center mb-lg-5 mb-4">High Level Policy Unit</h2>
            <div class="row g-xl-5">
                <div class="col-lg-6">
                    <div class="img-wrp">
                        <img src="images/img7.png" class="rounded-5" alt="">
                    </div>
                </div>
                <div class="col-lg-6 ps-xl-5">
                    
                    
                    <p class="info-text-typ1 mb-xl-5 mb-lg-4 mb-3">
                        <?php echo $result['content'];?>
                    </p>
                    <div class="d-flex justify-content-lg-start">
                        <a href="hlpu.php?id=<?php echo base64_encode($result['_id']); ?>" class="btn more-btn more-btn-blue">Learn More</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section info-section pt-4 pb-5">
    <div class="container">
        <div class="row g-xl-5 mb-4">
            <div class="col-lg-6 pe-xl-5 order-lg-0">
                <h3 class="hd-typ3 black-text mb-xl-5 mb-4">
                    Micronesian Center for Sustainable 
                    Transport (MCST) Blog
                </h3>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-end">
                    <a href="http://mcst-rmi.org/blog/" class="btn more-btn more-btn-blue">View All</a>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <?php
            // URL of the WordPress API
            $api_url = 'http://mcst-rmi.org/blog/wp-json/wp/v2/posts';

            // Make the API request with error handling
            $response = file_get_contents($api_url);

            if ($response === false) {
                // Handle network error or API request failure
                echo "Error: Unable to fetch blog posts.";
            } else {
                // Attempt to decode the JSON response
                $posts = json_decode($response);

                if ($posts === null) {
                    // Handle JSON decoding error
                    echo "Error: Unable to parse blog posts data.";
                } else {
                    // Check if the response is an empty array
                    if (empty($posts)) {
                        echo "No blog posts available.";
                    } else {
                        // Loop through the blog posts and display images and links
                        foreach ($posts as $post) {
                            $title = $post->title->rendered;
                            $content = $post->content->rendered;
                            $featuredImage = $post->featured_media;

                            // Define the path to your local default image
                            $defaultImageURL = 'images/no-image-292x292.png';

                            if ($featuredImage) {
                                // Fetch the featured image URL
                                $imageURL = file_get_contents('http://mcst-rmi.org/blog/wp-json/wp/v2/media/' . $featuredImage);

                                if ($imageURL !== false) {
                                    $imageData = json_decode($imageURL);

                                    if ($imageData !== null) {
                                        $imageURL = $imageData->source_url;
                                    } else {
                                        // Handle featured image data decoding error
                                        $imageURL = $defaultImageURL;
                                    }
                                } else {
                                    // Handle featured image retrieval error
                                    $imageURL = $defaultImageURL;
                                }
                            } else {
                                // Handle missing featured image
                                $imageURL = $defaultImageURL;
                            }

                            echo "<div class='col-lg-3 col-md-4 col-sm-6'>";
                            echo "<a href='" . $post->link . "' class='post'>";
                            echo "<span class='img-wrp'>";
                            echo "<img src='$imageURL' alt=''>";
                            echo "</span>";
                            echo "<strong>" . $title . "</strong>";
                            echo "<span class='more-link w-100'>Learn More</span>";
                            echo "</a>";
                            echo "</div>";
                        }
                    }
                }
            }
            ?>   
        </div>
    </div>
</section>
    <section class="logo-slider-section">
    <div class="container">
        <div class="logo-slider owl-carousel owl-theme">
        <?php foreach ($images as $image): ?>
                <div class="item">
                    <div class="img-wrp">
                    <a href="partners-details.php?id=<?php echo base64_encode($image['_id']); ?>">
                        <img src="<?php echo $image['image']; ?>" alt="">
                    </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    <?php include_once('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.home-banner').owlCarousel({
                loop: true,
                autoplay: true,
                mouseDrag: true,
                nav: false,
                dots: true,
                items: 1,
                smartSpeed: 450
            });
            $('.logo-slider').owlCarousel({
                loop: true,
                autoplay: true,
                dots: false,
                nav: true,
                margin: 30,
                autoWidth: true,
                items: 6,
                smartSpeed: 450,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        dots: false,
                        autoWidth: false
                    },
                    600: {
                        items: 3,
                        nav: true,
                        dots: false,
                        autoWidth: false
                    },
                    767: {
                        items: 4,
                        nav: true,
                        dots: false,
                        autoWidth: true
                    },
                    1200: {
                        items: 6,
                        nav: true,
                        dots: false
                    }
                }
            });
            $('.announcements-slider').owlCarousel({
                loop: true,
                autoplay: true,
                mouseDrag: true,
                nav: false,
                dots: true,
                margin: 7,
                items: 4,
                smartSpeed: 3000,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        dots: false
                    },
                    600: {
                        items: 2,
                        nav: true,
                        dots: false
                    },
                    767: {
                        items: 3,
                        nav: true,
                        dots: false
                    },
                    1200: {
                        items: 4,
                        nav: true,
                        dots: false
                    }
                }
            });

           
            // var owl = $('.marquee-news');
            // owl.owlCarousel({
            //     loop:true,
            //     autoplay:false,
            //     nav:true,
            //     dots:false,
            //     margin:10,
            //     responsive:{
            //         0:{
            //             items:1
            //         },
            //         600:{
            //             items:3
            //         },            
            //         960:{
            //             items:5
            //         },
            //         1200:{
            //             items:6
            //         }
            //     }
            // });
            // owl.on('mousewheel', '.owl-stage', function (e) {
            //     if (e.deltaY>0) {
            //         owl.trigger('next.owl');
            //     } else {
            //         owl.trigger('prev.owl');
            //     }
            //     e.preventDefault();
            // });
            // $(".slider").bxSlider({
            //     mode: 'vertical',
            //     auto:true,
            //     speed:1000,
            //     pause:2000,
            //     autoHover:true,
            //     slideMargin: 0,
            //     minSlides: 7,
            //     moveSlides:1,
            //     wrapperClass:"bx-wrapper marquee-news",
            //     nextText:"Next",
            //     prevText:"Prev",
            //     pager:false,
            //     infiniteLoop:true,
            //     touchEnabled:false,
            //     responsive:false
            // });
            setTimeout(function(){
                $(".slider").bxSlider({
                    mode: 'vertical',
                    auto:true,
                    speed:1000,
                    pause:2000,
                    autoHover:true,
                    slideMargin: 0,
                    minSlides: 5,
                    moveSlides:1,
                    wrapperClass:"bx-wrapper marquee-news",
                    // nextText:"Next",
                    // prevText:"Prev",
                    pager:false,
                    infiniteLoop:true,
                    touchEnabled:false,
                    responsive:false
                });
            }, 200);
        })
        $(window).resize(function(){
            $(".slider").bxSlider({
                mode: 'vertical',
                auto:true,
                speed:1000,
                pause:2000,
                autoHover:true,
                slideMargin: 0,
                minSlides: 5,
                moveSlides:1,
                wrapperClass:"bx-wrapper marquee-news",
                // nextText:"Next",
                // prevText:"Prev",
                pager:false,
                infiniteLoop:true,
                touchEnabled:false,
                responsive:false
            });
        });
        $( window ).on( "orientationchange", function( event ) {
            $(".slider").bxSlider({
                mode: 'vertical',
                auto:true,
                speed:1000,
                pause:2000,
                autoHover:true,
                slideMargin: 0,
                minSlides: 5,
                moveSlides:1,
                wrapperClass:"bx-wrapper marquee-news",
                // nextText:"Next",
                // prevText:"Prev",
                pager:false,
                infiniteLoop:true,
                touchEnabled:false,
                responsive:false
            });
        });
    </script>
    </body>

</html>