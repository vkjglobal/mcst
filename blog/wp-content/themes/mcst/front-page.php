<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mcst
 */

get_header();
?>
 
 

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




<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
			//	the_archive_title( '<h1 class="page-title">', '</h1>' );
				//the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->



<section id="our-blog" class="bglight padding text-center">
	  <div class="container">
	     <div class="row">
		
	  <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		 
		</div>   
</div>
	 </div>
		</div>
</section>
 




	</main><!-- #main -->











<?php
//get_sidebar();
get_footer();
