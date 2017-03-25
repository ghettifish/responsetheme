<div class="posttitle <?php if ( empty( $post->post_excerpt ) ) { ?>no-excerpt<?php } ?>">
	<h2 class="headline"><i class="icon-link"></i> &nbsp;<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
</div>

<?php if ( !empty( $post->post_excerpt ) ) { ?>
	<div class="article">
    	<?php the_excerpt(); ?>	
    </div>
<?php } ?>