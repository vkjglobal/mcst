<?php 
 include_once('includes/class.General.php');
 $menu_usefulLinks     =   $objGen->getMenuList(37); //useful links id on menu
// print_r($menu_usefulLinks);
?>

<footer class="py-4">
        <div class="container">
            <div class="row g-md-3 g-4">
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-3">
                    <div class="footer-contact-info">
                        <strong class="mb-2">Meet Us</strong>
                        <address class="mb-4">
                            MCST, The College of the Marshall Islands, <br>
                            College of the Marshall 
Ocean View 1258,<br>
Majuro MH, 96960

                        </address>
                        <strong class="mb-2">Phone</strong>
                        <a href="tel:+(692) 625-3394" class="mb-4">+(692) 625-3394 (Ext. 359 or 376)</a>
                        <strong class="mb-2">Email</strong>
                        <a href="mailto:info@mcst-rmiusp.org">info@mcst-rmi.org</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row footer-links">
                        <div class="col-sm-4 col-6 mb-md-0 mb-3">
                            <ul>
                                <li><strong>About Us</strong></li>
                                <li>
                                    <a href="about-us.php?id=Mg==">Welcome from the Chair</a>
                                </li>
                                <li>
                                    <a href="history.php?id=Mw==">History</a>
                                </li>
                                <li>
                                    <a href="board-members.php?id=NA==">Board Members</a>
                                </li>
                                <li>
                                    <a href="rebbelib-2050.php?id=NQ==">Rebbelib 2050</a>
                                </li>
                                <li>
                                    <a href="laucala-declaration.php?id=Ng==">Laucala Declaration</a>
                                </li>
                                <li>
                                    <a href="http://mcst-rmi.org/our-team.php?id=ODAz">Our Team</a>
                                </li>
                               
                                <li>
                                    <a href="partners-listing.php?id=ODI3">Partners</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-4  col-6 mb-md-0 mb-3">
                             <ul>
                                <li><strong>News</strong></li>
                                <li>
                                    <a href="http://mcst-rmi.org/hlpu.php?id=MjAzMw==">E-Bwebwenato Series</a>
                                </li>
                                <li>
                                    <a href="http://mcst-rmi.org/hlpu.php?id=ODI5">Virtual Ocean Dialogues 2020</a>
                                </li>
                                <li>
                                    <a href="http://mcst-rmi.org/hlpu.php?id=ODMw">Charting the way forwared workshop</a>
                                </li>
                                <li>
                                    <a href="break.php">Breaking Stories</a>
                                </li>
                               
                                <li>
                                    <a href="lscience.php">Latest Science & Reports</a>
                                </li>

                                <li>
                                    <a href="latestp.php">Latest Presentations</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul>
                                <li>
                                    <a href="hlpu.php?id=ODA0"><strong>Research</strong></a>
                                </li>
                                <li>
                                    <a href="projects-all_listing.php?id=ODI2"><strong>Projects</strong></a>
                                </li>
                                <!-- <li>
                                    <a href="hlpu.php?id=ODA3"><strong>Resources</strong></a>
                                </li> -->
                                <li>
                                    <a href="http://mcst-rmi.org/blog/"><strong>Our Blog</strong></a>
                                </li>
                                <li>
                                    <a href="reference-library.php"><strong>Reference Library</strong></a>
                                </li>
                                <li>
                                    <a href="contact-us.php"><strong>Contact Us</strong></a>
                                </li>
                              <!--  <li>
                                    <a href="#"><strong>Logout</strong></a>
                                </li> -->
                                <li>
                                    <button type="button" class="btn usefullinksbtn fw-600">Useful Links</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 copyright-wrp">
                <div class="col-xl-7 copyright-text mb-xl-0 mb-3">
                    Copyright &copy; 2017 - 2023 Micronesian Center for Sustainable Transport (MCST)
                </div>
                <div class="col-xl-5">
                    <div class="footer-social-links">
                        <span>Social Links: </span>
                        <a href="https://twitter.com/mcst_rmi"><img src="images/twitter-icon.svg" alt=""></a>
                        <a href="https://www.facebook.com/MicronesianCenterforSustainableTransport"><img src="images/fb-icon.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="usefullinks-wrp">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-xl-5 mb-md-4 mb-3">Useful Links</h5>
                    <button type="button" class="btn-close close-button"></button>
                </div>
                <ul class="row g-2">
                <?php foreach($menu_usefulLinks as $k =>$v){
                    $pagename   =$v['pagename'];
                    ?>
                    <li class="col-lg-3 col-sm-6"><a href="<?php echo $pagename ?>" target="_blank"><?php echo $v['menu']; ?></a></li>
                    <?php } ?>
                              </ul>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="js/top-megamenu.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script> 
    $(".usefullinksbtn, .close-button").click(function(){
                $(".usefullinks-wrp").slideToggle();
            });
            $(document).ready(function(){
        // $('#container').addClass('loaded');
        // // Once the container has finished, the scroll appears
        // if ($('#container').hasClass('loaded')) {
        // // It is so that once the container is gone, the entire preloader section is deleted
        // $('#preloader').delay(4000).queue(function() {
        //     $(this).remove();
        // });}
        setTimeout(function() {
        $('#container').addClass('loaded');
        // Once the container has finished, the scroll appears
        if ($('#container').hasClass('loaded')) {
        // It is so that once the container is gone, the entire preloader section is deleted
        $('#preloader').delay(4000).queue(function() {
            $(this).remove();
        });}
    }, 3000);
    })
    
    </script>