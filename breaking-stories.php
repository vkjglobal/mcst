<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
 $objGen    =   new General();
if(isset($_GET['id'])){
  echo  $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  //print_r($aboutUsList); exit;
}
?>
    <section class="page-title-section mb-lg-5 mb-4">
        <div class="container">
            <h2 class="hd-typ1">Breaking Stories</h2>
        </div>
    </section>
    <section class="news-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <ul class="post-wrp">
                <li class="news-list-item">
                    <div class="row g-lg-5 g-3">
                        <div class="col-lg-8">
                            <h3 class="hd-typ2 mb-3"><a href="#">Press Releases [14 - 17 March 2023]</a></h3>
                            <div class="news-text-content">
                                <ul class="mb-lg-5 mb-4 top-link-wrp">
                                    <li><a href="#">[PR-14-03-23] Price on GHG emissions from international shipping</a>
                                    </li>
                                    <li><a href="#">[PR-16-03-23] PICs propose emissions reduction targets for shipping
                                            GHG</a></li>
                                    <li><a href="#">[PR-16-03-23] Pacific nations demand a clear framework of principles
                                            for the reduction
                                            of GHG emissions from international shipping.</a></li>
                                    <li><a href="#">[PR-17-03-23] Fiji, Marshall Islands and Solomon Islands propose
                                            ways that revenues
                                            accruing from the implementation of the Revised IMO Strategy on the
                                            reduction of GHG emissions
                                            from ships could be used</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="news-list-item">
                    <div class="row g-lg-5 g-3">
                        <div class="col-lg-4 order-lg-1">
                            <div class="img-wrp">
                                <img src="images/marine-environment-protection-committee.jpg"
                                    alt="marine-environment-protection-committee">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h3 class="hd-typ2 mb-3"><a href="#">Patient persistent Pacific research and diplomacy moves
                                    shipping
                                    ambition</a></h3>
                            <div class="news-text-content">
                                <p>$80 billion p.a. in pollution levies on the table at IMO
                                    <br>
                                    And how much will be committed to the priority needs of the climate vulnerable
                                    depends on
                                    the
                                    skill and stamina of our Pacific negotiating teams over the next 6 months. This week
                                    the
                                    Republic of the Marshall Islands and the Solomon Islands lodged four new submissions
                                    at the
                                    International Maritime Organization calling for greatly increased and 1.5
                                    commensurate
                                    levels of
                                    ambition, commitment to an equitable global transition and for shipping to agree a
                                    high
                                    price on
                                    GHG. It is the largest and most ambitious carbon price call for any sector in the
                                    world.
                                    They
                                    need other Pacific high ambition voices to join them.<br><br>
                                    The science and the economics are clear, the transition requires a paradigm shift,
                                    but it is
                                    technically possible and achievable – if we go hard now. And it could be a
                                    game-breaker for
                                    Pacific states. In Fiji we have known this for a decade. It was the first lesson
                                    from a
                                    brand-new research program I founded with then USP Economics Professor Prasad in
                                    2012. A
                                    decade
                                    on, the costs and risks are much higher. Our research partners at UCL calculate that
                                    failure
                                    to
                                    act will cost shipping a $100billion p.a. from now on in. Delaying will always cost
                                    more.
                                    The
                                    Pacific will always pay the highest price if it isn’t proactive. This time, thanks
                                    to the
                                    continual leadership of the Marshalls and Solomons, it is on the front foot.
                                    Since the late Tony de Brum led a high-level diplomatic delegation to the IMO in
                                    2015, a
                                    steady
                                    and disciplined high-ambition Pacific coalition, supported by the best available
                                    local and
                                    international research, has continued to consistently move the dial on forcing 1.5
                                    to the
                                    top of
                                    shipping's emissions reduction program.
                                    <br><br>
                                    Author: Dr Peter Nuttall, Micronesian Centre for <br>
                                    Sustainable Transport <a href="mailto:pete@s4sfiji.com">Email: pete@s4sfiji.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="news-list-item">
                    <div class="row g-lg-5 g-3">
                        <div class="col-lg-4 order-lg-1">
                            <div class="img-wrp">
                                <img src="images/pbsp.png" alt="Pacific Blue Shipping Partnership">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h3 class="hd-typ2 mb-3"><a href="#">MCST prepares new narratives for the Pacific Blue
                                    Shipping
                                    Partnership</a></h3>
                            <div class="news-text-content">
                                <p>As Pacific high ambition pressure at IMO for a paradigm shift for
                                    international shipping decarbonization builds and we inch closer to a real price on
                                    shipping
                                    emissions, we turn back to how to organize a parallel shift for our domestic fleets.
                                    In our latest technical working paper, MCST suggests alternative narratives for the
                                    governance,
                                    financing and technology transition pathways for the Pacific Blue Shipping
                                    Partnership.
                                    The speed and scale of transition required to implement our country’s NDC’s domestic
                                    maritime
                                    targets are unprecedented. It demands a complete revolution in technology and a
                                    paradigm
                                    shift
                                    in fleet management and operations as well as the financial investment and program
                                    delivery
                                    away
                                    from existing structures. A dedicated bespoke solution is required.Our research
                                    considers a
                                    collective country approach with governance via a Ministerial Council of
                                    participating
                                    countries
                                    the most appropriate and efficient structure. Central to PBSP’s design is the need
                                    for a
                                    country-owned and -driven program. In essence PBSP is a formal agreement between a
                                    number of
                                    states to:
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="news-list-item">
                    <div class="row g-lg-5 g-3">
                        <div class="col-lg-4 order-lg-1">
                            <div class="img-wrp">
                                <img src="images/delegation-meeting.png" alt="delegation-meeting">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h3 class="hd-typ2 mb-3"><a href="#">PSIDS to lobby for a long-term commitment to
                                    decarbonise
                                    shipping sector at next round of IMO Negotiations</a></h3>
                            <div class="news-text-content">

                                <p>
                                    Meetings during the 79th Session of the Marine Environment Protection Committee
                                    (MEPC 79)
                                    and the Inter-Sessional Working Group on Greenhouse Gases (ISWG-GHG 13) are going to
                                    be key
                                    for Pacific Small Island Developing States (PSIDS) in ensuring a 1.5 agenda is built
                                    into
                                    the revised International Maritime Organisation (IMO) Strategy, which will be
                                    adopted during
                                    MEPC 80, in 2023. <br>
                                    A bundle of four submissions has been submitted to ISWG-GHG 13 and MEPC 79 in
                                    December,
                                    building up to MEPC 80.
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ol class="post-list-bottom">
                <li><a href="#">MCST researcher Atina Schutz makes the case for an equitable transition at Second IMO
                        Symposium on alternative low- and zero- carbon fuels</a></li>
                <li><a href="#">The Pacific frames high ambition for the International Maritime Organisation’s (IMO)
                        Revised Strategy</a></li>
                <li><a href="#">This Is How A Pacific Atoll Dies': Drowning Island Nations On Climate Change Threat</a>
                </li>
                <li><a href="#">Build tender for MISC's low carbon ship confirmed</a></li>
            </ol>
            <div class="pagination">
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
                    <li class="pagination-next"><a title="" href="#" class="hasTooltip pagenav" data-original-title="Next">Next</a></li>
                    <li class="pagination-end"><a title="" href="#" class="hasTooltip pagenav" data-original-title="End">End</a></li>
                </ul>
            </div>
        </div>
    </section>
     <?php
include_once('includes/footer.php');
?>
    <script>
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
        })
    </script>
</body>

</html>