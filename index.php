<?php
/*
 * The single post template for our theme.
 *
 * Displays content when viewing a single post. Used in place of single.php.
 *
 * @package Response
 * @since Response 1.0
 * 
 */ 
 get_header(); ?>

<!-- BEGIN #content -->
<div id="content">

	<!-- BEGIN .row -->
	<div class="row">
	
	    <!-- BEGIN .eleven columns -->
	    <div class="eleven columns">
	
			<?php get_template_part( 'loop', 'post' ); ?>
	
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