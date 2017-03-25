<?php if (has_post_thumbnail()) { $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); } ?>

<?php if ( has_post_thumbnail()) { ?>
    <a class="feature-img" href="<?php if (has_post_thumbnail()) { echo $thumb[0]; } ?>" rel="prettyPhoto"><?php the_post_thumbnail( 'feature' ); ?></a>
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