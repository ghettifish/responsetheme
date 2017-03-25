<?php 
/**
* This page template is used to display category post indexes. 
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
		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		        
		        <div <?php post_class('archive-result content holder'); ?> id="page-<?php the_ID(); ?>">
		        
		        	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?>
		        
		        </div>
		
				<?php endwhile; else: ?>         
		        <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
				<?php endif; ?>
		        
		        <?php if($wp_query->max_num_pages > 1) { ?>
		        	<!-- BEGIN .pagination -->
		        	<div class="pagination">
		        		<?php echo response_get_pagination_links(); ?>
		        	<!-- END .pagination -->
		        	</div>
		        <?php } ?>
		
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
		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		        
		        <div <?php post_class('archive-result content holder'); ?> id="page-<?php the_ID(); ?>">
		        
		        	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?>
		        
		        </div>
		
				<?php endwhile; else: ?>         
		        <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
				<?php endif; ?>
		        
		        <?php if($wp_query->max_num_pages > 1) { ?>
		        	<!-- BEGIN .pagination -->
		        	<div class="pagination">
		        		<?php echo response_get_pagination_links(); ?>
		        	<!-- END .pagination -->
		        	</div>
		        <?php } ?>
		
			<!-- END .sixteen columns -->
		    </div>
			    
		<?php endif; ?>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>