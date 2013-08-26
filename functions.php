<?php
/**
 * nuwhite functions and definitions
 *
 * @package nuwhite
 * @since nuwhite 1.0
 */
 
 /**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since nuwhite 1.0
 */
if ( ! isset( $content_width ) )
    $content_width = 654; /* pixels */

if ( ! function_exists( 'nuwhite_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Shape 1.0
 */
function nuwhite_setup() {
    /**
     * Custom functions for this theme.
     */
    require( get_template_directory() . '/library/core.php' );
    
    /**
     * Custom functions for some tweaks
     */
    require( get_template_directory() . '/library/tweaks.php' );
	
	/**
     * Theme Options Defaults
     */
    require( get_template_directory() . '/library/default-options.php' );
	
	/**
     * Theme Options
     */
    require( get_template_directory() . '/library/theme-options.php' );
	
	/**
     * Theme Options Setups
     */
    require( get_template_directory() . '/library/setup-options.php' );
 
    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on nuwhite, use a find and replace
     * to change 'nuwhite' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'nuwhite', get_template_directory() . '/languages' );
 	 
 	 /**
     * Add post-thumbnails support
     */
	 add_theme_support( 'post-thumbnails' );

	 /**
     * Image size for thumbnails
     */
	 add_image_size( 'featured-medium', 120, 120, true);
	 
	 /**
     * Image size for thumbnails in widget
     */
	 add_image_size( 'featured-small-widget', 50, 50);
	 
    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for the Aside Post Format
     */
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'quote', 'status', 'image', 'gallery', 'link', 'video' ) );
 
    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nuwhite' ),
    ) );
 
}
endif; // nuwhite_setup
add_action( 'after_setup_theme', 'nuwhite_setup' );
	
/**
 * Custom header
 */
require( get_template_directory() . '/library/custom-header.php' );
	
	
/**
 * Enqueue scripts and styles
 */
function nuwhite_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
	
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
 
    wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20130706', true );
	
	wp_enqueue_script( 'back-to-top', get_template_directory_uri() . '/js/backtotop.js', array( 'jquery' ), '20130706', true );
	
	wp_enqueue_script( 'fixed-menu', get_template_directory_uri() . '/js/fixed-menu.js', array( 'jquery' ), '20130706', true );
	
	wp_enqueue_script( 'unslider', get_template_directory_uri() . '/js/unslider.min.js', array( 'jquery' ), '20130706', true );
	
	wp_enqueue_script( 'text-banner', get_template_directory_uri() . '/js/text-banner.js', array( 'jquery' ), '20130706', true );
	
    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }
}
add_action( 'wp_enqueue_scripts', 'nuwhite_scripts' );

/**
 * Format <title> in head of document
 *
 * @since nuwhite 1.0
 */
function nuwhite_wp_title( $mytitle, $separated ) {
	global $paged, $page;

	if ( is_feed() )
		return $mytitle;

	// Get site name.
	$mytitle .= get_bloginfo( 'name' );

	// Format home or front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$mytitle = "$mytitle $separated $site_description";

	// Add a page number.
	if ( $paged >= 2 || $page >= 2 )
		$mytitle = "$mytitle $separated " . sprintf( __( 'Page %s', 'nuwhite' ), max( $paged, $page ) );

	return $mytitle;
}
add_filter( 'wp_title', 'nuwhite_wp_title', 10, 2 );

if ( ! function_exists( 'nuwhite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since nuwhite 1.0
 */
function nuwhite_posted_on() {
    printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'nuwhite' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'nuwhite' ), get_the_author() ) ),
        esc_html( get_the_author() )
    );
}
endif;

if (  ! function_exists( 'nuwhite_date_posts' ) ) :
/**
 * Prints HTML for the current post-date in index
 *
 * See http://codex.wordpress.org/Formatting_Date_and_Time
 * 
 * @since nuwhite 1.0
 */
function nuwhite_date_posts() {
	printf( __('<div class="nuwhite-date"><span class="nuwhite-show-day">%1$s</span><span class="nuwhite-show-month">%2$s</span></div>', 'nuwhite'),
		esc_html( get_the_date( 'j' ) ),
		esc_html( get_the_date( 'M' ) )
	);
}
endif;

if (  ! function_exists( 'nuwhite_show_avatar' ) ) :
/**
 * Show the Avatar of Author for the current post
 *
 * See http://codex.wordpress.org/Function_Reference/get_avatar
 * 
 * @since nuwhite 1.0
 */
function nuwhite_show_avatar() {
	printf( __('<div class="nuwhite-avatar">%1$s</div>', 'nuwhite'),
		get_avatar( get_the_author_meta( 'ID' ), 64 )
	);
}
endif;

if ( ! function_exists( 'nuwhite_posted_author' ) ) :
/**
 * Prints HTML with meta information for author in index posts.
 *
 * @since nuwhite 1.0
 */
function nuwhite_posted_author() {
    printf( __( 'Posted by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'nuwhite' ),   
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'nuwhite' ), get_the_author() ) ),
        esc_html( get_the_author() )
    );
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Shape 1.0
 */
function nuwhite_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories( array(
            'hide_empty' => 1,
        ) );
 
        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count( $all_the_cool_cats );
 
        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }
 
    if ( '1' != $all_the_cool_cats ) {
        // With more than 1 category
        return true;
    } else {
        // if this blog has only 1 category
        return false;
    }
}
 
/**
 * Flush out the transients used in nuwhite_categorized_blog
 *
 * @since nuwhite 1.0
 */
function nuwhite_category_transient_flusher() {
    delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'nuwhite_category_transient_flusher' );
add_action( 'save_post', 'nuwhite_category_transient_flusher' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since nuwhite 1.0
 */
function nuwhite_widgets_init() {
    
	register_sidebar( array(
        'name' => __( 'Sidebar Widget Area 1', 'nuwhite' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 1', 'nuwhite' ),
        'id' => 'sidebar-footer-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 2', 'nuwhite' ),
        'id' => 'sidebar-footer-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Widget Area 3', 'nuwhite' ),
        'id' => 'sidebar-footer-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
	/* Register custom widget */
	register_widget( "nuwhite_Social_Widget" );
	
	/* Register custom widget for Popular Posts */
	register_widget( "nuwhite_Popular_Posts" );
	
	/* Register custom widget for Popular Posts */
	register_widget( "nuwhite_Recent_Posts" );
	
	/* Register custom widget for Category Posts */
	register_widget( "nuwhite_Category_Posts" );
}
add_action( 'widgets_init', 'nuwhite_widgets_init' );

/**
 * Custom widget
 */
require( get_template_directory() . '/library/nuwhite-widget.php' );

function nuwhite_admin() {
    // add the Customize link to the admin menu
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}
add_action ('admin_menu', 'nuwhite_admin');


/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 */
function nuwhite_register_custom_background() {
    $args = array(
        'default-color' => 'ffffff',
    );
 
    $args = apply_filters( 'nuwhite_custom_background_args', $args );
 
    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_theme_support();
    }
}
add_action( 'after_setup_theme', 'nuwhite_register_custom_background' );