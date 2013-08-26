<?php
/**
 * The Header for Nu White theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package nuwhite
 * @since nuwhite 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->
	<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?> id="<?php do_action('get_nuwhite_header_class'); ?>">

<div id="page" class="hfeed">
	<?php 
		do_action ( 'nuwhite_get_header_style' );
	?>
<div id="main" class="site-main">