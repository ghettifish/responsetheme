<?php
/**
Template Name: Three Column
*
* This template is used to display three column pages featuring two sidebars.
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
	
		<!-- BEGIN .three columns -->
		<div class="three columns">
		
			<?php get_sidebar('left'); ?>
			
		<!-- END .three columns -->
		</div>
	
	    <!-- BEGIN .eight columns -->
	    <div class="eight columns">
	    
	        <?php get_template_part( 'loop', 'page' ); ?>
			
		<!-- END .eight columns -->
		</div>
		
		<!-- BEGIN .five columns -->
		<div class="five columns">
		
		    <?php get_sidebar(); ?> 
		
		<!-- END .five columns -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>