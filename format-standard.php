<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
<div class="posttitle">
	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<div class="postdate">            
	    <p><i class="icon-time"></i> &nbsp;<?php response_posted_on(); ?></p>
	</div>
</div>

<!-- BEGIN .article -->
<div class="article">

    <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
    	<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
    <?php } else { ?>
    	<?php if ( has_post_thumbnail()) { ?>
        	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'feature' ); ?></a>
        <?php } ?>
    <?php } ?>

	<?php the_content(__("Continue Reading", 'organicthemes')); ?>
	
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
	
	<?php if(of_get_option('display_social_blog') == '1') { ?>
	
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

<!-- END .article -->
</div>

<div class="postmeta">
	<p class="left"><i class="icon-user"></i> &nbsp;<?php _e("Posted by", 'organicthemes'); ?> <?php the_author_posts_link(); ?></p>
	<p class="right"><i class="icon-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), '% Comments'); ?></a></p>
</div>