<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>MCST</title>
<link href="<?php echo get_template_directory_uri(); ?>/fa1.png" rel="icon">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/plugins.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
<style>
  .side-menu{width:300px !important;}
  .side-menu .inner-wrapper {
    padding: 1.5rem 2.5rem !important;
  }
  .side-menu .side-nav a{font-size:12px;}
  .side-menu .side-nav li {border-bottom:1px solid #fff;}
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
<header class="site-header" >
   <nav class="navbar navbar-expand-lg transparent-bg static-nav">
      <div class="container">
         <a class="navbar-brand" href="http://mcst-rmi.org/">
 <img style="width:150px; " src="<?php echo get_template_directory_uri(); ?>/logo.png"  />
	 
         </a>
         <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#xenav">
            <span> </span>
            <span> </span>
            <span> </span>
         </button>
         <div class="collapse navbar-collapse" id="xenav" style="margin-left:100px;">
             
               <form    class="widget_search" role="search" method="get" id="searchform"
	class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
	   <div class="input-group" >
		<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
		<input type="text" class="form-control"  placeholder="search..."   value="<?php echo get_search_query(); ?>" name="s" id="s" />
		 
			
			 <button type="submit"  class="input-group-addon" id="searchsubmit"
			value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>"  class="input-group-addon"><i class="fa fa-search"></i> </button>
			
			</div>
	</div>
</form>
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
            <!--<ul class="social-icons-simple white top40">
            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i> </a> </li>
            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i> </a> </li>
            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i> </a> </li>
         </ul> -->
         <p class="whitecolor">&copy; 2023 MCST.  </p>
         </div>
      </div>
   </div>
   <a id="close_side_menu" href="javascript:void(0);"></a>
   <!-- End side menu -->
   
</header>
<!-- header -->   
