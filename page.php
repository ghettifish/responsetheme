<?php
/**
* The page template for our theme.
*
* This template is used to display page content.
*
* @package Response
* @since Response 1.0
* 
*/ 
get_header(); ?>
 
 <?php if ( has_post_thumbnail()) { $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner'); } ?>
 <?php if ( has_post_thumbnail()) { ?>
 	<div class="banner" style="background-image: url(<?php if (has_post_thumbnail()) { echo $thumb[0]; } ?>);"><span class="banner-img"><?php the_post_thumbnail( 'banner' ); ?></span></div>
 <?php } ?>

<!-- BEGIN #content -->
<div id="content">
	
	<!-- BEGIN .row -->
	<div class="row">
	
	    <!-- BEGIN .ten columns -->
	    <div class="ten columns">
	    
	        <?php get_template_part( 'loop', 'page' ); ?>
			
		<!-- END .ten columns -->
		</div>
		
		<!-- BEGIN .six columns -->
		<div class="six columns">
		
		    <?php get_sidebar('left'); ?>
		
		<!-- END .six columns -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>