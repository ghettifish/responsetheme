<?php
/*
 *
 Template Name: Blog
 *
 * This is the custom blog page template.
 *
 */ 
 get_header(); ?>
 
 <?php if ( has_post_thumbnail()) { $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner'); } ?>
 <?php if ( has_post_thumbnail()) { ?>
 	<div class="banner" style="background-image: url(<?php if (has_post_thumbnail()) { echo $thumb[0]; } ?>);"><span class="banner-img"><?php the_post_thumbnail( 'banner' ); ?></span></div>
 <?php } ?>

<!-- BEGIN #content -->
<div <?php post_class(); ?> id="content">

	<!-- BEGIN .row -->
	<div class="row">
	
		<?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
	    
		    <!-- BEGIN .ten columns -->
		    <div id="blog" class="ten columns">
				
				<?php global $paged; ?>
				<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_blog'),'posts_per_page'=>of_get_option('postnumber_blog'),'paged'=>$paged)); ?>
		        <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		        <?php global $more; $more = 0; ?>
		        
		        <div <?php post_class('content holder blog-page'); ?>>
		        	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?> 
		        </div>          
		            
		        <?php endwhile; ?>
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
			
			<!-- BEGIN .six columns -->
			<div class="six columns">
			
			    <?php get_sidebar('blog'); ?>
			
			<!-- END .five columns -->
			</div>
			
		<?php else : ?>
		
			<!-- BEGIN .sixteen columns -->
			<div id="blog" class="sixteen columns">
				
				<?php global $paged; ?>
				<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_blog'),'posts_per_page'=>of_get_option('postnumber_blog'),'paged'=>$paged)); ?>
			    <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
			    <?php global $more; $more = 0; ?>
			    
			    <div <?php post_class('content holder blog-page'); ?>>
			    	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?> 
			    </div>          
			        
			    <?php endwhile; ?>
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