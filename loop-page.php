<div <?php post_class('content holder'); ?> id="page-<?php the_ID(); ?>">
    
	<div class="article">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <?php if ( is_page_template('template-slideshow.php') ) { ?>
        
	        <div class="slideshow">        
	        	<div class="flexslider" data-speed="<?php echo of_get_option('transition_interval'); ?>">
	        		<ul class="slides">
	        		
	        			<?php $data = array(
	        		    	'post_parent'		=> $id,
	        		    	'post_type' 		=> 'attachment',
	        		    	'post_mime_type' 	=> 'image',
	        		    	'order'         	=> 'ASC',
	        		    	'orderby'	 		=> 'menu_order',
	        		        'numberposts' 		=> -1
	        			); ?>
	        			
	        			<?php 
	        			$images = get_posts($data); foreach( $images as $image ) { 
	        				$imageurl = wp_get_attachment_url($image->ID);
	        				echo '<li><img src="'.$imageurl.'" /></li>' . "\n";
	        			} ?>
	        
	        		</ul>
	        	</div>
	        </div>
        
        <?php } ?>

        <h1 class="headline"><?php the_title(); ?></h1>
        
        <?php the_content(__("Read More", 'organicthemes')); ?>
        
        <?php wp_link_pages(array(
        	'before' => '<p class="page-links"><span class="link-label">' . __('Pages:', 'organicthemes') . '</span>',
        	'after' => '</p>',
        	'link_before' => '<span>',
        	'link_after' => '</span>',
        	'next_or_number' => 'next_and_number',
        	'nextpagelink' => __('Next', 'organicthemes'),
        	'previouspagelink' => __('Previous', 'organicthemes'),
        	'pagelink' => '%',
        	'echo' => 1 )
        ); ?>
        
        <?php if (of_get_option('display_social_page') == '1') { ?>
        
	        <div class="social">
	        	<div class="like-btn">
	        	  	<div class="fb-like" href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	        	</div>
	        	<div class="pin-btn">
	        		<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $feat_image; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
	        	</div>
	        	<div class="tweet-btn">
	        		<a href="http://twitter.com/share" class="twitter-share-button"
	        		data-url="<?php the_permalink(); ?>"
	        		data-via="<?php echo of_get_option('twitter_user'); ?>"
	        		data-text="<?php the_title(); ?>"
	        		data-related=""
	        		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
	        	</div>
	        	<div class="plus-btn">
	        		<g:plusone size="medium" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
	        	</div>
	        </div>
        
        <?php } ?>
        
        <?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?>
        
        <div class="clear"></div>
        
        
        
        <?php endwhile; else: ?> 
        <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
		<?php endif; ?>
	
	</div>
    
</div>