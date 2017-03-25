<?php
/**
* Google Fonts Implementation
*
* @package Seed
* @since Seed 1.0
*
*/

/**
* Register Google Fonts
*
* @since Seed 1.0
*/
function organic_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'source sans pro', "$protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700" );
	wp_register_style( 'lato', "$protocol://fonts.googleapis.com/css?family=Lato:400,300,700,900" );
	wp_register_style( 'merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900" );
}
add_action( 'init', 'organic_register_fonts' );

/**
* Enqueue Google Fonts on Front End
*
* @since Seed 1.0
*/

function organic_fonts() {
	wp_enqueue_style( 'source sans pro' );
	wp_enqueue_style( 'lato' );
	wp_enqueue_style( 'merriweather' );
}
add_action( 'wp_enqueue_scripts', 'organic_fonts' );

/**
* Enqueue Google Fonts on Custom Header Page
*
* @since Seed 1.0
*/
function organic_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
	return;
	
	wp_enqueue_style( 'source sans pro' );
	wp_enqueue_style( 'lato' );
	wp_enqueue_style( 'merriweather' );
}
add_action( 'admin_enqueue_scripts', 'organic_admin_fonts' );