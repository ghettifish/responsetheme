<?php 
/**
* This template is used to display archive posts, e.g. tag post indexes. 
* This template is also the fallback template to 'category.php'. 
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
	
		<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
	
		    <!-- BEGIN .eleven columns -->
		    <div class="eleven columns">
		
				<?php get_template_part( 'loop', 'archive' ); ?>
		
			<!-- END .eleven columns -->
		    </div>
		            
		    <!-- BEGIN .five columns -->
		    <div class="five columns">
		    
		        <?php get_sidebar(); ?> 
		    
		    <!-- END .five columns -->
		    </div>
	    
	    <?php else : ?>
	    
	    	<!-- BEGIN .sixteen columns -->
    	    <div class="sixteen columns">
    	
    			<?php get_template_part( 'loop', 'archive' ); ?>
    	
    		<!-- END .sixteen columns -->
    	    </div>
    	    
    	<?php endif; ?>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>