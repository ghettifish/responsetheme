<div class="slideshow">        
	<div class="flexslider">
		<ul class="slides">
		
			<?php $data = array(
		    	'post_parent'		=> $id,
		    	'post_type' 		=> 'attachment',
		    	'post_mime_type' 	=> 'image',
		    	'order'         	=> 'ASC',
		    	'orderby'	 		=> 'menu_order',
		        'numberposts' 		=> -1
			); ?>
			
			<?php $images = get_posts($data); foreach( $images as $image ) { $imageurl = wp_get_attachment_url($image->ID); echo '<li><img src="'.$imageurl.'" /></li>' . "\n"; } ?>

		</ul>
	</div>
</div>

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