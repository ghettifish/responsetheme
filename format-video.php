<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
	<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
<?php } else { ?>
    <a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'feature' ); ?></a>
<?php } ?>

<div class="posttitle">
	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<div class="postdate">            
	    <p><i class="icon-time"></i> &nbsp;<?php response_posted_on(); ?></p>
	</div>
</div>

<div class="article">
	<?php the_excerpt(); ?>
</div>

<div class="postmeta">
	<p class="left"><i class="icon-user"></i> &nbsp;<?php _e("Posted by", 'organicthemes'); ?> <?php the_author_posts_link(); ?></p>
	<p class="right"><i class="icon-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), '% Comments'); ?></a></p>
</div>