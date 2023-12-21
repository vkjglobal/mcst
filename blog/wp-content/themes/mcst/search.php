
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>MCST</title>
<link href="x<?php echo get_template_directory_uri(); ?>/fa1.png" rel="icon">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/plugins.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
<style>
    .post-thumbnail img{width:100% !important;}
     .side-menu{width:300px !important;}
     .side-menu .inner-wrapper {
    padding: 1.5rem 2.5rem !important;
  }
      .side-menu .side-nav a{font-size:12px;}
        .side-menu .side-nav li {border-bottom:1px solid #fff;}
        
        .wp-block-image img{width : 100% !important;}
        
</style>
</head>
<body>

<!--PreLoader-->
<div class="loader">
   <div class="loader-inner">
      <div class="loader-blocks">
         <span class="block-1"></span>
         <span class="block-2"></span>
         <span class="block-3"></span>
         <span class="block-4"></span>
         <span class="block-5"></span>
         <span class="block-6"></span>
         <span class="block-7"></span>
         <span class="block-8"></span>
         <span class="block-9"></span>
         <span class="block-10"></span>
         <span class="block-11"></span>
         <span class="block-12"></span>
         <span class="block-13"></span>
         <span class="block-14"></span>
         <span class="block-15"></span>
         <span class="block-16"></span>
      </div>
   </div>
</div>
<!--PreLoader Ends-->


<!-- header -->
<header class="site-header">
   <nav class="navbar navbar-expand-lg transparent-bg static-nav">
      <div class="container">
   <a class="navbar-brand" href="<?php echo site_url();?>">
  <img style="width:150px; " src="<?php echo get_template_directory_uri(); ?>/logo.png"  />
	 
         </a>
         <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#xenav">
            <span> </span>
            <span> </span>
            <span> </span>
         </button>
         <div class="collapse navbar-collapse" id="xenav">
            <!-- <ul class="navbar-nav ml-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="#" data-text="Home">Category 1 </a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="#" data-text="Home">Category 2</a>
               </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#" data-text="Home">Category 3 </a>
               </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#" data-text="Home">Category 4 </a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="#" data-text="Home">Category 5 </a>
               </li>
             
            </ul>   -->
         </div>
      </div>

      <!--side menu open button-->
      <a href="javascript:void(0)" class="d-none d-lg-inline-block sidemenu_btn" id="sidemenu_toggle">
          <span></span> <span></span> <span></span>
       </a>
   </nav>

   <!-- side menu -->
   <div class="side-menu">
      <div class="inner-wrapper">
         <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
         <nav class="side-nav">
            
 <?php
	$recent_posts = wp_get_recent_posts();
	foreach( $recent_posts as $recent ) {
		printf( '<li style="list-style:none"><a style="color:white" href="%1$s">%2$s</a></li>',
			esc_url( get_permalink( $recent['ID'] ) ),
			apply_filters( 'the_title', $recent['post_title'], $recent['ID'] )
		);
	}
?>
		 
         </nav>

         <div class="side-footer w-100">
           <!-- <ul class="social-icons-simple white top40">
            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i> </a> </li>
            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i> </a> </li>
            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i> </a> </li>
         </ul> -->
         <p class="whitecolor">&copy; 2023 MCST. </p>
         </div>
      </div>
   </div>
   <a id="close_side_menu" href="javascript:void(0);"></a>
   <!-- End side menu -->
</header>
<!-- header -->

<!--page Header-->

<!--page Header-->
<section style="background-color:#1E3768" class=" parallaxie padding_top center-block">
   <div class="container">
  
   </div>
</section>
<!--page Header ends-->

<section style="background-color:#01a3d1" class=" parallaxie  center-block">
   <div class="container">
       
  <h2 class="whitecolor font-light top30 bottom30 text-center">Micronesian Center for Sustainable Transport   Blog</h2>
   </div>
</section>
<!--page Header ends-->

<!-- Our Blogs -->  
<section id="our-blog" class="padding bglight">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="news_item shadow">
               
			   
			   
			   
			   <?php if ( have_posts() ) : ?>

		 
				<p class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'mcst' ), '<span>' . get_search_query() . '</span>' );
					?>
				</p>
	 

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
 

 
         
                  </div>
               </div>
        
         <div class="col-md-4">
            <aside class="sidebar whitebox">
               <div class="widget heading_space">
                  <h4 class="text-capitalize darkcolor bottom20">Recent Posts</h4>
                  
				  <div class="single_post bottom15"> 
				  <?php
	$recent_posts = wp_get_recent_posts();
	foreach( $recent_posts as $recent ) {
		printf( '<li><a href="%1$s">%2$s</a></li>',
			esc_url( get_permalink( $recent['ID'] ) ),
			apply_filters( 'the_title', $recent['post_title'], $recent['ID'] )
		);
	}
?>
		 </div>
				  		  
				 
                    
				  
				  
				  
                   
               </div>
               <div class="widget heading_space">
                  <h4 class="text-capitalize darkcolor bottom20">Categories</h4>
<?php 
	foreach((get_the_category()) as $category){
		echo $category->name."<br>";
		echo category_description($category);
		}
	?>


				 
               </div>
               <div class="widget heading_space">
                  <h4 class="text-capitalize darkcolor bottom20">Tags</h4>
                 
                    <?php the_tags( '<ul class="webtags"><li>', '</li><li>', '</li></ul>' ); ?>
                
               </div>
               <div class="widget heading_space">
                  <h4 class="text-capitalize darkcolor bottom20">search</h4>
                  
				  <form   class="widget_search" role="search" method="get" id="searchform"
	class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
	   <div class="input-group">
		<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
		<input type="text" class="form-control"  placeholder="search..."   value="<?php echo get_search_query(); ?>" name="s" id="s" />
		 
			
			 <button type="submit"  class="input-group-addon" id="searchsubmit"
			value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>"  class="input-group-addon"><i class="fa fa-search"></i> </button>
			
			</div>
	</div>
</form>
				  
				  
				  
               </div>
            </aside>
         </div> </div>
      </div>
   </div>
</section>
<!--Our Blogs Ends-->
                        
      
<!--Site Footer Here-->
<footer id="site-footer" class="padding_half">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 text-center">
            <ul class="social-icons bottom25">
               <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i> </a> </li>
               <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i> </a> </li>
               <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i> </a> </li>
               <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i> </a> </li>
               <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i> </a> </li>
               <li><a href="javascript:void(0)"><i class="fa fa-envelope-o"></i> </a> </li>
            </ul>
             <p class="copyrights"> &copy; 2023 MCST.  </p>
         </div>
      </div>
   </div>
</footer>
<!--Footer ends-->   



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.1.1.min.js"></script>

<!--Bootstrap Core-->
<script src="<?php echo get_template_directory_uri(); ?>/js/popper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>

<!--to view items on reach-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.appear.js"></script>

<!--Equal-Heights-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.matchHeight-min.js"></script>

<!--Owl Slider-->
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>

<!--number counters-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-countTo.js"></script>
 
<!--Parallax Background-->
<script src="<?php echo get_template_directory_uri(); ?>/js/parallaxie.js"></script>
  
<!--Cubefolio Gallery-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cubeportfolio.min.js"></script>

<!--FancyBox popup-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.min.js"></script>       

<!-- Video Background-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.background-video.js"></script>

<!--TypeWriter-->
<script src="<?php echo get_template_directory_uri(); ?>/js/typewriter.js"></script> 
      
<!--Particles-->
<script src="<?php echo get_template_directory_uri(); ?>/js/particles.min.js"></script>
  
<!--WOw animations-->
<script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>                                         
   
<!--Revolution SLider-->
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/jquery.themepunch.revolution.min.js"></script>
<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.actions.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.migration.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.navigation.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/revolution/extensions/revolution.extension.video.min.js"></script>
  
<script src="<?php echo get_template_directory_uri(); ?>/js/functions.js"></script>
</body>
</html>

 