<?php
/**
Template Name: Full Width
*
* This template is used to display full-width pages.
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
<div id="content" class="full-width">
	
	<!-- BEGIN .row -->
	<div class="row">
	
	    <!-- BEGIN .sixteen columns -->
	    <div class="sixteen columns">	
	    
	        <?php get_template_part( 'loop', 'page' ); ?>
			
		<!-- END .sixteen columns -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>