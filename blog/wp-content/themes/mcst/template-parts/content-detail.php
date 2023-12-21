<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mcst
 */

?>   
<style>
.post-thumbnail img{width:100% !important}
</style>
 <div class="col-lg-4 " style="border:1px solid #eee; padding-top:15px;>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
              <?php mcst_post_thumbnail(); ?> 
              
 <div class="news_desc" style="margin-top:40px">
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title ">', '</h1>' );
		else :
			the_title( '<h3 class="entry-title text-capitalize font-light darkcolor"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
			<ul class="meta-tags top20 bottom20">
			 <li> <i class="fa fa-calendar"></i> 
				<?php
				mcst_posted_on();?>
				</li>
				
				   <li>  <i class="fa fa-user-o"></i>
				<?php 
				mcst_posted_by();
				?>
				</li>
				</ul>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	

	<div class="entry-content">
	<p class="bottom35">	<?php
 
 
     the_excerpt();
  
 
	 

	 
		?>

  <a href="<?php echo get_post_permalink($post->ID) ?>" rel="bookmark" class="button btnprimary btn-gradient-hvr"> Read more</a>	
		</p>
	</div><!-- .entry-content -->
 

 
	</div>
</article> 
 </div>




