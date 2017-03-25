<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = wp_get_theme('style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	// Test data
	$test_array = array("one" => __("One", 'organicthemes'),"two" => __("Two", 'organicthemes'),"three" => __("Three", 'organicthemes'),"four" => __("Four", 'organicthemes'),"five" => __("Five", 'organicthemes'));

	// Multicheck Array
	$multicheck_array = array("one" => __("French Toast", 'organicthemes'), "two" => __("Pancake", 'organicthemes'), "three" => __("Omelette", 'organicthemes'), "four" => __("Crepe", 'organicthemes'), "five" => __("Waffle", 'organicthemes'));

	// Multicheck Defaults
	$multicheck_defaults = array("one" => "true","five" => "true");

	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Slider Transition Array
	$transition_array = array("1000" => __("1 Second", 'organicthemes'), "2000" => __("2 Seconds", 'organicthemes'), "4000" => __("4 Seconds", 'organicthemes'), "6000" => __("6 Seconds", 'organicthemes'), "8000" => __("8 Seconds", 'organicthemes'), "10000" => __("10 Seconds", 'organicthemes'), "12000" => __("12 Seconds", 'organicthemes'), "14000" => __("14 Seconds", 'organicthemes'), "16000" => __("16 Seconds", 'organicthemes'), "18000" => __("18 Seconds", 'organicthemes'), "20000" => __("20 Seconds", 'organicthemes'), "30000" => __("30 Seconds", 'organicthemes'), "60000" => __("1 Minute", 'organicthemes'), "999999999" => __("Hold Frame", 'organicthemes'));
	
	// Yes or No Array
	$yesno_array = array("true" => __("Yes", 'organicthemes'), "false" => __("No", 'organicthemes'));


	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Add all categories option
    $options_categories[0] = __("All Categories", 'organicthemes');

	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['false'] = __("Select a page:", 'organicthemes');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';

	$options = array();
	
	$options[] = array( "name" => __("Homepage", 'organicthemes'),
						"type" => "heading");
						
		$options[] = array( "name" => __("Display Slideshow?", 'organicthemes'),
							"desc" => __("This option displays the featured slideshow on the homepage.", 'organicthemes'),
							"id" => "display_slideshow",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Slideshow Category", 'organicthemes'),
							"desc" => __("Choose the post category you wish to display in the featured slideshow.", 'organicthemes'),
							"id" => "category_slideshow",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
							
		$options[] = array( "name" => __("Slideshow Posts To Display", 'organicthemes'),
							"desc" => __("Enter the number of posts you wish to display in the featured slideshow.", 'organicthemes'),
							"id" => "postnumber_slideshow",
							"std" => "10",
							"type" => "text");
							
		$options[] = array( "name" => __("Slideshow Transition Interval", 'organicthemes'),
							"desc" => __("Choose the transition time for the slideshow. This is the time the frame is held before transitioning to the next slide.", 'organicthemes'),
							"id" => "transition_interval",
							"std" => "10000",
							"type" => "select",
							"options" => $transition_array);
							
		$options[] = array( "name" => __("Slideshow Height", 'organicthemes'),
							"desc" => __("Set an optional minimum height value for the slideshow in pixels (i.e. 540px).", 'organicthemes'),
							"id" => "slideshow_height",
							"std" => "540px",
							"type" => "text");
							
		$options[] = array( "name" => __("Display Featured Page?", 'organicthemes'),
							"desc" => __("This option displays the featured page beneath the slideshow.", 'organicthemes'),
							"id" => "display_home",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Select Featured Page", 'organicthemes'),
							"desc" => __("Choose the page you wish to display in the featured section beneath the slideshow.", 'organicthemes'),
							"id" => "select_page",
							"std" => "2",
							"type" => "select",
							"options" => $options_pages);

	$options[] = array( "name" => __("Page Templates", 'organicthemes'),
						"type" => "heading");
							
		$options[] = array( "name" => __("Blog Posts Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display for the blog page template.", 'organicthemes'),
							"id" => "category_blog",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
							
		$options[] = array( "name" => __("Blog Posts Displayed", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like displayed on the blog page template. Pagination occurs after entered number of posts.", 'organicthemes'),
							"id" => "postnumber_blog",
							"std" => "5",
							"type" => "text");
							
		$options[] = array( "name" => __("Portfolio Posts Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display for the portfolio page template.", 'organicthemes'),
							"id" => "category_portfolio",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
							
		$options[] = array( "name" => __("Portfolio Posts Displayed", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like displayed on the portfolio page template. Pagination occurs after entered number of posts.", 'organicthemes'),
							"id" => "postnumber_portfolio",
							"std" => "16",
							"type" => "text");
						
	$options[] = array( "name" => __("Layout", 'organicthemes'),
						"type" => "heading");
						
		$options[] = array( "name" => __("Site Width", 'organicthemes'),
							"desc" => __("Set a maximum width of your site in pixels if desired (i.e. 980px). Enter 100% for full width.", 'organicthemes'),
							"id" => "site_width",
							"std" => "1200px",
							"type" => "text");
							
		$options[] = array( "name" => __("Display Post Featured Image?", 'organicthemes'),
							"desc" => __("This option displays the featured image or video on individual posts.", 'organicthemes'),
							"id" => "display_feature_post",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Footer Social Icons?", 'organicthemes'),
							"desc" => __("This option displays the social icons and links in the footer.", 'organicthemes'),
							"id" => "display_social_footer",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Blog Social Buttons?", 'organicthemes'),
							"desc" => __("This option displays the Tweet, Like, Pinterest and Google+ buttons on the homepage blog and category pages.", 'organicthemes'),
							"id" => "display_social_blog",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Post Social Buttons?", 'organicthemes'),
							"desc" => __("This option displays the Tweet, Like, Pinterest and Google+ buttons on individual posts.", 'organicthemes'),
							"id" => "display_social_post",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Page Social Buttons?", 'organicthemes'),
							"desc" => __("This option displays the Tweet, Like, Pinterest and Google+ buttons on individual pages.", 'organicthemes'),
							"id" => "display_social_page",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Enable CSS3 Full Width Background Image?", 'organicthemes'),
							"desc" => __("This option enables an applied background image to stretch to the full width of the browser.", 'organicthemes'),
							"id" => "background_stretch",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Enable Responsive Layout?", 'organicthemes'),
							"desc" => __("This option enables the responsive site layout for the iPhone, iPad and mobile devices.", 'organicthemes'),
							"id" => "enable_responsive",
							"std" => "1",
							"type" => "checkbox");
							
	$options[] = array( "name" => __("Social", 'organicthemes'),
						"type" => "heading");
						
		$options[] = array( "name" => __("Twitter Name", 'organicthemes'),
							"desc" => __("Enter your Twitter username.", 'organicthemes'),
							"id" => "twitter_user",
							"std" => __("OrganicThemes", 'organicthemes'),
							"type" => "text");	
							
		$options[] = array( "name" => __("Facebook Page Link", 'organicthemes'),
							"desc" => __("Enter a link to your Facebook page or profile.", 'organicthemes'),
							"id" => "facebook_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Twitter Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your Twitter account.", 'organicthemes'),
							"id" => "twitter_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("LinkedIn Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your LinkedIn page.", 'organicthemes'),
							"id" => "linkedin_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Dribbble Page Link", 'organicthemes'),
							"desc" => __("Enter a link to your Dribbble page.", 'organicthemes'),
							"id" => "dribbble_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Skype Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your Skype account. (e.g. skype://MySkypeName)", 'organicthemes'),
							"id" => "skype_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Google Plus Profile Link", 'organicthemes'),
							"desc" => __("Enter a link to your Google Plus page.", 'organicthemes'),
							"id" => "plus_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Pinterest Profile Link", 'organicthemes'),
							"desc" => __("Enter a link to your Pinterest page.", 'organicthemes'),
							"id" => "pinterest_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Github Link", 'organicthemes'),
							"desc" => __("Enter a link to your Github page.", 'organicthemes'),
							"id" => "github_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Instagram Link", 'organicthemes'),
							"desc" => __("Enter a link to your Instagram page.", 'organicthemes'),
							"id" => "instagram_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("YouTube Link", 'organicthemes'),
							"desc" => __("Enter a link to your YouTube page.", 'organicthemes'),
							"id" => "youtube_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Email Address", 'organicthemes'),
							"desc" => __("Enter your email address.", 'organicthemes'),
							"id" => "email_link",
							"std" => "",
							"type" => "text");
						
	$options[] = array( "name" => __("Colors", 'organicthemes'),
						"type" => "heading");
							
		$options[] = array( "name" => __("Link Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the link colors.", 'organicthemes'),
							"id" => "link_color",
							"std" => "#000000",
							"type" => "color");
							
		$options[] = array( "name" => __("Link Hover Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the link hover colors.", 'organicthemes'),
							"id" => "link_hover_color",
							"std" => "#FF3366",
							"type" => "color");
							
		$options[] = array( "name" => __("Menu Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the main menu.", 'organicthemes'),
							"id" => "nav_color",
							"std" => "#FF3366",
							"type" => "color");
							
		$options[] = array( "name" => __("Highlight Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the highlight color. This refers primarily to button colors and accents.", 'organicthemes'),
							"id" => "highlight_color",
							"std" => "#FF3366",
							"type" => "color");						

	return $options;
}