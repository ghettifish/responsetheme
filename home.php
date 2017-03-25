<?php get_header(); ?>

<?php if ( '1' == of_get_option('display_slideshow')) { ?>
	
	<!-- BEGIN .slideshow -->
    <div class="slideshow featured-slideshow">
    
    	<!-- BEGIN .row -->
    	<div class="row">
    		
    		<!-- BEGIN .sixteen columns -->
    	    <div class="sixteen columns">
    	    	
    	    	<!-- BEGIN .slideshow -->
    	    	<div class="slideshow">
    
			        <!-- BEGIN .flexslider -->
			        <div class="flexslider loading" data-speed="<?php echo of_get_option('transition_interval'); ?>">
			        
			            <!-- BEGIN ul.slides -->
			            <ul class="slides">
			                <?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_slideshow'),'posts_per_page'=>of_get_option('postnumber_slideshow'))); ?>
			                <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
			                <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
			                <?php global $more; $more = 0; ?>
			                
			                <li <?php post_class(); ?> style="
			                	background-image: url(<?php echo get_post_meta(get_the_ID(), 'post_bg', true); ?>);
			                	background-color: <?php echo get_post_meta(get_the_ID(), 'bg_color', true); ?>;
			                	background-repeat: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>repeat<?php else : ?>no-repeat<?php endif; ?>;
			                	background-position: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>left<?php else : ?>center<?php endif; ?>;
			                	-webkit-background-size: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>none<?php else : ?>cover<?php endif; ?>;
			                	-moz-background-size: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>none<?php else : ?>cover<?php endif; ?>;
			                	-o-background-size: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>none<?php else : ?>cover<?php endif; ?>;
			                	background-size: <?php if ('true' == (get_post_meta(get_the_ID(),'repeat_bg', true))) : ?>none<?php else : ?>cover<?php endif; ?>; ">
	                	    	
	                	    	<div class="slide-holder <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>video-holder<?php } ?>">
	                	    	
		                	    	<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		                	    		<div class="eleven columns">
		                	    	    	<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
		                	    	    </div>
		                	    	<?php } else { ?>
			                	    	<?php if ( has_post_thumbnail()) { ?>
			                	    		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'banner' ); ?></a>
			                	    	<?php } elseif ( empty( $post->post_excerpt ) ) { ?>
			                	    		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/default-slide.png" alt="<?php the_title(); ?>" /></a>
			                	    	<?php } ?>
		                	    	<?php } ?>
		                	    	
		                	    	<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		                	    		<div class="five columns">
			                	    		<div class="slide-info video-info">
			                	    			<div class="slide-text">
			                	    		        <h2 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                	    		        <?php the_excerpt(); ?>
			                	    		        <a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php _e("Continue Reading", 'organicthemes'); ?></a>
			                	    		    </div>
			                	    		</div>
		                	    		</div>
		                	    	<?php } else { ?>
			                	    	<?php if ( ! empty( $post->post_excerpt )) { ?>
					                    <div class="slide-info">
					                    	<div class="slide-text">
						                        <h2 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						                        <?php the_excerpt(); ?>
					                        </div>
					                    </div>
					                    <?php } ?>
				                    <?php } ?>
				                    
			                    </div>
	                    
			                </li>
			                
			                <?php endwhile; ?>
			                <?php else : ?>
			                <?php endif; ?>
			
			            <!-- END ul.slides -->
			            </ul>
			            
			        <!-- END .flexslider -->
			        </div>
		        
		        <!-- END .slideshow -->
		        </div>
	        
	        <!-- END .sixteen columns -->
	        </div>
            
        <!-- END .row -->
        </div>
    
    <!-- END .slideshow -->
    </div>
	    
<?php } ?>

<?php if ( '1' == of_get_option('display_home')) { ?>

<!-- BEGIN #content -->
<div id="content">

	<!-- BEGIN .row -->
	<div class="row">
		    
	    <div id="homepage">
	    
	    	<div class="ten columns">
	    	
				<?php $wp_query = new WP_Query('page_id='.of_get_option('select_page')); while($wp_query->have_posts()) : $wp_query->the_post(); ?>
				<?php global $more; $more = 0; ?>

				<div class="article">
				
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

				</div>
				
				<?php endwhile; ?>
				

			<!-- start post -->


			<?php global $paged; ?>
				<?php $wp_query = "showposts=1"; $wp_query = new WP_Query($wp_query); ?>
		        <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		        <?php global $more; $more = 0; ?>
		        
		        <div <?php post_class('content holder blog-page'); ?>>
		        	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?> 
		        </div>          
		            
		        <?php endwhile; ?>
				<?php endif; ?>			

			<!-- end post -->			
			</div><!-- end ten columns -->

			<div class="six columns">
	    	
				<?php get_sidebar('left'); ?>
			
			</div><!-- end six columns -->
		
		<!-- END #homepage -->
		</div>
		
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php } ?>

<?php get_footer(); ?>