<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
        
<div <?php post_class('archive-result content holder'); ?> id="page-<?php the_ID(); ?>">
    
    <!-- BEGIN .article -->
    <div class="article">
	
		<h2 class="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            
		<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		    <div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
		<?php } else { ?>
		    <?php if ( has_post_thumbnail()) { ?>
		    	<a class="feature-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_post_thumbnail( 'feature' ); ?></a>
		    <?php } ?>
		<?php } ?>

        <?php the_excerpt(); ?>
        <div class="clear"></div>   
	
	<!-- END .article -->
	</div>
	
	<?php if ( has_category() || has_tag() ) { ?>
	
	<div class="postmeta">
		<p class="left"><i class="icon-reorder"></i> &nbsp;<?php _e("Category:", 'organicthemes'); ?> <?php the_category(', '); ?></p> 
		<?php if ( has_tag() ) { ?>
			<p class="right"><i class="icon-tags"></i> &nbsp;<?php _e("Tags:", 'organicthemes'); ?> <?php the_tags(''); ?></p>
		<?php } ?>
	</div>
	
	<?php } ?>

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