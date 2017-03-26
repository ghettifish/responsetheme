<?php
/**
* The Header for our theme.
* Displays all of the <head> section and everything up till <div id="wrap">
*
* @package Response
* @since Response 1.0
*
*/
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo('charset'); ?>">

<?php if(of_get_option('enable_responsive') == '1') { ?>
<!-- Mobile View -->
<meta name="viewport" content="width=device-width">
<?php } ?>

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">

<?php get_template_part( 'style', 'options' ); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="alternate" type="application/rss+xml" title="<?php esc_attr( bloginfo('name') ); ?> Feed" href="<?php echo home_url(); ?>/feed/">
<link rel="pingback" href="<?php echo esc_url( bloginfo('pingback_url') ); ?>">

<!-- Social -->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

<?php wp_head(); ?>
</head>

<body <?php if(function_exists('body_class')) body_class(); ?>>

<div class="container">

    <div id="header" style="border:0;">

    	<div class="row header_top">

		<div class="one columns"></div>

    		<div class="six columns">

	    		<?php if ( is_home() || is_front_page() ) { ?>
	    			<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>
		    			<h1 id="custom-header"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></h1>
	    			<?php } else { ?>
	    				<div id="masthead">
		    				<h1 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
		    				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	    				</div>
	    			<?php } ?>
	    		<?php } else { ?>
	    			<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>
		    			<p id="custom-header"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></p>
	    			<?php } else { ?>
	    				<div id="masthead">
	    					<h4 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
	    					<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
	    				</div>
	    			<?php } ?>
	    		<?php } ?>

    		</div>
		<div class="nine columns text-right" style="position:relative;">
			<img src="/app/uploads/2014/02/photos.jpg" alt="" style="position:absolute;top:0;right:0;" class="photo_image" />
		</div>
</div>
<div class="navigation_container">
<div class="row">

    		<div class="eight columns menu-holder">

    			<!-- BEGIN #navigation -->
				<nav id="navigation" class="navigation-main radius-full" role="navigation">

					<h1 class="menu-toggle"><?php _e( 'Menu', 'organicthemes' ); ?></h1>

					<?php if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'title_li' => '',
							'depth' => 4,
							'container_class' => '',
							'menu_class'      => 'menu'
							)
						);
					} else { ?>
						<ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul>
					<?php } ?>

				</nav><!-- END #navigation -->

    		</div><!-- end ten columns -->
    	    </div><!-- end row -->
    	</div><!-- end navigation_container -->
    </div>
