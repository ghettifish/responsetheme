<?php
/**
Template Name: Slideshow
*
* This template is used to display a page with a slideshow.
*
* @package Response
* @since Response 1.0
*
*/
get_header(); ?>
 
<!-- BEGIN #content -->
<div id="content" class="slideshow-page">

	<!-- BEGIN .row -->
	<div class="row">
	
	    <!-- BEGIN .eleven columns -->
	    <div class="eleven columns">	
	    
	        <?php get_template_part( 'loop', 'page' ); ?>
			
		<!-- END .eleven columns -->
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