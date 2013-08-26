<?php
/**
 * The theme option default values
 * @since NuWhite 1.0
 */

global $nuwhite_theme_options_defaults;
$nuwhite_theme_options_defaults = array(
	'header_style'							=> 'nuwhite-center',
	'custom_logo'							=> '',
	'color_scheme'							=> 'white-scheme',
	'sidebar'								=> 'no-sidebar',
	'social_facebook'						=> '',
	'social_twitter'						=> '',
	'social_googleplus'						=> '',
	'social_rss'							=> '',
	'index_posts'							=> 'show-excerpt',
	'header_analytics'						=> '',
	'google_verification'					=> '',
	'bing_verification'						=> '',
	'footer_analytics'						=> ''
 );
 
global $nuwhite_theme_options_settings;
$nuwhite_theme_options_settings = nuwhite_theme_options_set_defaults( $nuwhite_theme_options_defaults );

function nuwhite_theme_options_set_defaults( $nuwhite_theme_options_defaults) {
	$nuwhite_theme_options_settings = array_merge( $nuwhite_theme_options_defaults, (array) get_option( 'nuwhite_theme_options', array() ) );
	return apply_filters( 'nuwhite_theme_options_settings', $nuwhite_theme_options_settings );
}

?>