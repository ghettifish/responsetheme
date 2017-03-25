<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme Setup
/*-----------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'response_setup' ) ) :

function response_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'organicthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'feature', 1080, 800 ); // Featured Image
	add_image_size( 'banner', 1600, 800, true ); // Slideshow and Banner Image

	// Create Menus
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organicthemes' ),
	));
	
	// Custom Header
	if ( function_exists('add_theme_support') )
	$defaults = array(
		'width'                 => 350,
		'height'                => 160,
		'default-image'			=> get_template_directory_uri() . '/images/logo.png',
		'flex-height'           => true,
		'flex-width'            => true,
		'default-text-color'    => '333333',
		'header-text'           => false,
		'uploads'               => true,
	);
	add_theme_support( 'custom-header', $defaults );
	
	// Custom Background
	if ( function_exists('add_theme_support') )
	$defaults = array(
		'default-color'          => 'F9F9F9',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
}
endif; // response_setup
add_action( 'after_setup_theme', 'response_setup' );

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('response_enqueue_scripts') ) {
	function response_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'response-style', get_stylesheet_uri() );
		wp_enqueue_style( 'response-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'response-style' ), '1.0' );
		wp_enqueue_style( 'response-style-ie8', get_template_directory_uri() . '/css/style-ie8.css', array( 'response-style' ), '1.0' );
		wp_enqueue_style( 'organic-shortcodes', get_template_directory_uri() . '/shortcodes/organic-shortcodes.css', array( 'response-style' ), '1.0' );
		wp_enqueue_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/shortcodes/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
		wp_enqueue_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.css', array( 'font-awesome' ), '1.0' );
		wp_enqueue_style( 'organicons', get_template_directory_uri() . '/css/organicons.css', '1.0' );
		
		// IE Conditional Styles
		global $wp_styles;
		$wp_styles->add_data('response-style-ie8', 'conditional', 'lt IE 9');
		$wp_styles->add_data('response-shortcodes-ie8', 'conditional', 'lt IE 9');
		$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lt IE 8');
		
		// Resgister Scripts
		wp_register_script( 'response-fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'response-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'response-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'response-hover' ), '20130729' );
		wp_register_script( 'response-retina', get_template_directory_uri() . '/js/retina.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'response-modal', get_template_directory_uri() . '/js/jquery.modal.min.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'response-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'response-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'response-superfish', 'response-fitvids', 'response-retina', 'response-modal', 'jquery-masonry', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-dialog' ), '20130729', true );
		wp_enqueue_script( 'response-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );
		
		// IE Conditional Scripts
		global $wp_scripts;
		$wp_scripts->add_data( 'response-html5shiv', 'conditional', 'lt IE 9' );
		
		// Load Flexslider on front page and slideshow page template
		if( is_home() || is_front_page() || is_single() || is_page_template('template-slideshow.php') || is_page_template('template-blog.php') ) {
			wp_enqueue_script( 'response-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}
	
		// load single scripts only on single pages
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	    	wp_enqueue_script( 'comment-reply' );
	    }
	}
	add_action('wp_enqueue_scripts', 'response_enqueue_scripts');
}

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to a Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Post Meta Options		       	     	 
-------------------------------------------------------------------------------------------------------*/

$ot_metaboxes = array(

		"image" => array (
			"name"	=> "post_bg",
			"label" => "Background Image",
            "type" 	=> "upload",
			"desc"  => "Automatically resized/enlarged, but ideally 1200px x 600px to avoid pixelation."
		),
		"checkbox" => array (
			"name"	=> "repeat_bg",
			"label"	=> "Repeat Background",
			"std" 	=> "1",
			"type" 	=> "checkbox"
		),
		"background_color" => array (
			"name"	=> "bg_color",
			"label"	=> "Background Color",
			"std" 	=> "#242424",
			"type" 	=> "color",
			"desc" 	=> "Optionally choose a color or enter hex code to change the slide background color."
		),

	);

update_option('ot_custom_template', $ot_metaboxes);

/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 52;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	404 Pagination Fix For Home Page		       	     	 
-------------------------------------------------------------------------------------------------------*/

function my_post_queries( $query ) {
	// Not an admin page and it is the main query
	if (!is_admin() && $query->is_main_query()){
		if(is_home() ){
			$query->set('posts_per_page', 1);
		}
	}
}

add_action( 'pre_get_posts', 'my_post_queries' );

/*-----------------------------------------------------------------------------------------------------//	
	Farbastic Color Picker		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action('init', 'response_farbtastic_script');
function response_farbtastic_script() {
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebars') )
	register_sidebar(array(
		'name'=> __( "Sidebar", 'organicthemes' ),
		'id' => 'sidebar-right',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6 class="title">',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Sidebar Left", 'organicthemes' ),
		'id' => 'sidebar-left',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6 class="title">',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Sidebar Blog", 'organicthemes' ),
		'id' => 'sidebar-blog',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6 class="title">',
		'after_title'=>'</h6>'
	));

/*-----------------------------------------------------------------------------------------------------//	
	Options Framework		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}

/*-----------------------------------------------------------------------------------------------------//	
	Comments function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-avatar">
				<div class="vcard">
					<?php
						$avatar_size = 136;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 136;

						echo get_avatar( $comment, $avatar_size );
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php
				/* translators: 1: comment author, 2: date and time */
				printf( __( '<span class="comment-meta">%2$s &nbsp;by&nbsp; %1$s </span>', 'organicthemes' ),
					sprintf( '<span class="comment-author">%s</span>', get_comment_author_link() ),
					sprintf( '<a class="comment-time" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
					)
				);
				?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Functions		       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// woocommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>
	<div id="content">
		<div class="row">
			<div class="eleven columns">
				<div class="type-page content holder" id="woocommerce-page">
					<div class="article">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
		    		</div> <!-- /article -->
	    		</div> <!-- /type-page -->
	    	</div> <!-- /columns -->
	 
	        <div class="five columns">
	            <?php get_sidebar(); ?> 
	        </div>
	        
	 	</div> <!-- /row -->
	</div> <!-- /content -->
    <?php
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// woocommerce thumbnail image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'woo_install_theme', 1 );
function woo_install_theme() {
 
update_option( 'woocommerce_thumbnail_image_width', '200' );
update_option( 'woocommerce_thumbnail_image_height', '200' );
update_option( 'woocommerce_single_image_width', '640' );
update_option( 'woocommerce_single_image_height', '640' );
update_option( 'woocommerce_catalog_image_width', '200' );
update_option( 'woocommerce_catalog_image_height', '200' );
}

// woocommerce default product columns
function loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'loop_columns');

// woocommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------*/
/*	Custom Page Links
/*-----------------------------------------------------------------------------------*/

function wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------------------------//
/*	Pagination Function
/*-----------------------------------------------------------------------------------------------------*/

function response_get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => __('&laquo;', 'organicthemes'),
		'next_text' => __('&raquo;', 'organicthemes'),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init_featurevid");
add_action('save_post', 'save_featurevid');

function admin_init_featurevid(){
	add_meta_box("featurevid-meta", __("Featured Video Embed Code", 'organicthemes'), "meta_options_featurevid", "post", "normal", "high");
}

function meta_options_featurevid(){
	global $post;
	$custom = get_post_custom($post->ID);
	if ( isset($custom["featurevid"]) ) {
		$featurevid = $custom["featurevid"][0];
	}

	echo '<textarea name="featurevid" cols="60" rows="4" style="width:97.6%" />'.$featurevid.'</textarea>';
}

function save_featurevid($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if ( isset($_POST["featurevid"]) ) { 
		update_post_meta($post->ID, "featurevid", $_POST["featurevid"]); 
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Add post link meta box       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init");
add_action('save_post', 'save_titlelink');

function admin_init(){
	add_meta_box("prodInfo-meta", __("Post Title Link (For Link Format)", 'organicthemes'), "meta_options", "post", "side", "low");
}

function meta_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	if ( isset($custom["titlelink"]) ) { 
		$titlelink = $custom["titlelink"][0];
	}

	echo '<label>URL: </label><input type="text" style="width: 220px;" name="titlelink" value="'.$titlelink.'" />';
}

function save_titlelink($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	        return $post_id;
	    }
	if ( isset($_POST["titlelink"]) ) { 
		update_post_meta($post->ID, "titlelink", $_POST["titlelink"]);
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Filter post title for post format links	       	     	 
-------------------------------------------------------------------------------------------------------*/

function sd_link_filter($link, $post) {
     if (has_post_format('link', $post) && get_post_meta($post->ID, 'titlelink', true)) {
          $link = get_post_meta($post->ID, 'titlelink', true);
     }
     return $link;
}
add_filter('post_link', 'sd_link_filter', 10, 2);

/*-----------------------------------------------------------------------------------------------------//	
	Add post formats	       	     	 
-------------------------------------------------------------------------------------------------------*/

add_theme_support( 'post-formats', array( 
	'gallery',
	'link',
	'image',
	'quote',
	'video'	
	) 
);

/*----------------------------------------------------------------------------------------------------//
/*	Content Width
/*----------------------------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Adjust content_width value based on the presence of widgets
 */
function response_content_width() {
	if ( ! is_active_sidebar( 'sidebar-right' ) || ! is_active_sidebar( 'sidebar-blog' ) || is_page_template('template-full.php') || is_page_template('template-portfolio.php') ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'response_content_width' );

/*-----------------------------------------------------------------------------------------------------//	
	Custom Search Widget		       	     	 
-------------------------------------------------------------------------------------------------------*/

function response_style_search_form($form) {
	$form = '<form method="get" id="searchform" action="' . esc_url(home_url('/')) . '/" >
		<label for="s">' . esc_attr__('Search', 'organicthemes') . '</label>
		<div>';
	if (is_search()) {
		$form .='<input type="text" value="'. esc_attr(apply_filters('the_search_query', get_search_query())) .'" name="s" id="s" />';
	} else {
		$form .='<input type="search" class="search-field" placeholder="' . esc_attr__('Search Here', 'placeholder', 'organicthemes' ) .'" value="' .esc_attr( get_search_query() ) .'" name="s">';
	}
	$form .= '<input type="submit" id="searchsubmit" value="'. esc_attr(__('Go', 'organicthemes')).'" />
		</div>
		</form>';
	return $form;
}
add_filter('get_search_form', 'response_style_search_form');

/*-----------------------------------------------------------------------------------------------------//	
	Home Link In Custom Menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

// Display home link in custom menu
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Strip inline width and height attributes from WP generated images		       	     	 
-------------------------------------------------------------------------------------------------------*/
 
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
	return $html; 
	}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*-----------------------------------------------------------------------------------------------------//
	Body Class
-------------------------------------------------------------------------------------------------------*/

function response_body_class( $classes ) {
	if ( is_singular() )
		$classes[] = 'response-singular';

	if ( is_active_sidebar( 'right-sidebar' ) )
		$classes[] = 'response-right-sidebar';

	if ( '' != get_theme_mod( 'background_image' ) ) {
		// This class will render when a background image is set
		// regardless of whether the user has set a color as well.
		$classes[] = 'response-background-image';
	} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ) ) ) {
		// This class will render when a background color is set
		// but no image is set. In the case the content text will
		// Adjust relative to the background color.
		$classes[] = 'response-relative-text';
	}

	return $classes;
}
add_action( 'body_class', 'response_body_class' );


/**
* Filters wp_title to print a neat <title> tag based on what is being viewed.
*/
function response_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'response' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'response_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------------------------//	
	Display date and author info for a post		       	     	 
-------------------------------------------------------------------------------------------------------*/

function response_posted_on() {
	$time_string = sprintf( '<time class="entry-date published" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span>', 'response' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		)
	);
}

/*-----------------------------------------------------------------------------------------------------//	
	Includes		       	     	 
-------------------------------------------------------------------------------------------------------*/

require( get_template_directory() . '/includes/typefaces.php' );
require( get_template_directory() . '/shortcodes/shortcodes.php' );
require_once( get_template_directory() . '/includes/function-meta.php');

/* for events made easy */

add_action('eme_insert_rsvp_action', 'my_eme_discount_function',20,1);
function my_eme_discount_function($booking) {
   global $wpdb;
   $bookings_table = $wpdb->prefix.BOOKINGS_TBNAME;
   $where = array();
   $fields = array();

   $event_id = $booking['event_id'];
   //$discount_code = $booking['event_id'];


//print_r ($booking);
//$answers = eme_get_answers($booking['booking_id']);

$answers = eme_get_answers($booking['booking_id']);
$discount = $answers[0][answer];
print_r ($discount);

      //print 'Answers = '. $answers;
     //print 'EVENT ID='.$event_id .' Booking_id = '.$booking['booking_id'];

   if ($discount == 'MOPS14') {        /* put in the event_id that needs processing */

      $seats=$booking['booking_seats'];
      $price=$booking['booking_price'];

      $price = $price - 50;

      $fields['booking_price'] = $price;
      $where['booking_id'] = $booking['booking_id'];
      $wpdb->update($bookings_table, $fields, $where);
   }
   return;
}