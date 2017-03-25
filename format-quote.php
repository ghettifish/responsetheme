<?php remove_filter('the_excerpt', 'wpautop'); ?>

<div class="article">
	<blockquote><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_excerpt(); ?></a></blockquote>
</div>

<span class="quote-arrow"></span>
