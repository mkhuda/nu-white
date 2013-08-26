<?php

/**
 * Index posts
 */
function nuwhite_index_posts_style() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$index_posts = $options['index_posts'];
	
	if ('show-excerpt' == $index_posts) {
	?>
		<div class="entry-content">
		<?php
				if( has_post_thumbnail() && ( is_archive() || is_home() || is_search() ) ) {
				$image = '';        			
        		$title_attribute = apply_filters( 'the_title', get_the_title() );
				$image .= '<div class="post-featured-image">';
				$image .= '<a href="' . get_permalink() . '" title="'.__( 'Permalink to ', 'nuwhite' ).the_title( '', '', false ).'">';
				$image .= get_the_post_thumbnail( get_the_ID(), 'featured-medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
				$image .= '</div>';
				echo $image; 
			}
				the_excerpt();
			?>
		</div>
		<?php
	}
	
	if ('show-full-post' == $index_posts) {
	?>
	<div class="entry-content"> 
	<?php
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'nuwhite' ) );
	?>
	</div>
	<?php
	}
} 
add_action ('nuwhite_get_index_posts_style', 'nuwhite_index_posts_style', 10, 1);


/**
 * Add header class to body
 */
function nuwhite_add_header_class_style() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$header_class = $options['header_style'];
	
	if ('nuwhite-center' == $header_class) {
		echo $header_class;
	}
	
	if ('nuwhite-left' == $header_class) {
		echo $header_class;
	}
} 
add_action ('get_nuwhite_header_class', 'nuwhite_add_header_class_style', 10, 1);

/**
 * Custom header style
 */
function nuwhite_header_style() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$header_style = $options['header_style'];
	
	if ( 'nuwhite-center' == $header_style ) { ?>

		<div id="masthead" class="site-header" role="banner">
			<hgroup>
				<?php do_action ('nuwhite_get_custom_logo'); ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			<?php
				do_action ( 'nuwhite_get_social_links' ); /* Get social links from action hook */
			?>
			<?php $header_image = get_header_image();
				if( !empty( $header_image ) ) :?>
				<div class="nuwhite-header-image">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
			<?php endif; ?>	
		</div><!-- #masthead .site-header -->
		
		<nav role="navigation" id="access" class="site-navigation main-navigation">
			<h5 class="menu-toggle"><a id="toggling" href="#"><?php _e( 'Menu', 'nuwhite' ); ?></a></h5>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', 'nuwhite' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => 'menu' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->	
	<?php
	} 
	
	if ('nuwhite-left' == $header_style ) { ?>

		<div id="masthead" class="site-header left-style" role="banner">
			<div class="top-head">
				<?php
					do_action ( 'nuwhite_get_social_links' ); /* Get social links from action hook */
				?>
			</div>
			
			<nav role="navigation" id="access-left" class="site-navigation main-navigation">
				<h5 class="menu-toggle"><a id="toggling" href="#"><?php _e( 'Menu', 'nuwhite' ); ?></a></h5>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', 'nuwhite' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => 'menu' ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->	
			<div id="nuwhite-search-form">
				<?php get_search_form(); ?>
			</div>
			<hgroup>
				<?php do_action ('nuwhite_get_custom_logo'); ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<?php $header_image = get_header_image();
				if( !empty( $header_image ) ) :?>
				<div class="nuwhite-header-image">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
			<?php endif; ?>	
		</div><!-- #masthead .site-header -->
	<?php 
	}

}
add_action ('nuwhite_get_header_style', 'nuwhite_header_style', 10, 1);

/**
 * Custom header logo
 */
function nuwhite_custom_logo() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$custom_logo = $options['custom_logo'];

	if ( !empty ($custom_logo) ) { ?>
		<h1 class="custom-logo-title"> 
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo $options[ 'custom_logo' ]; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</a>
		</h1>
	<?php
	} else { ?>
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>	 		
   		</h1>
	<?php 
	}

}
add_action ('nuwhite_get_custom_logo', 'nuwhite_custom_logo', 10, 1);

/**
 * Content layout
 */
function nuwhite_content_layout() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$content_layout = $options['sidebar'];

	if ( 'no-sidebar' == $content_layout ) { ?>
		<div id="primary" class="content-area">
		   <div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>
			 <?php /* Start the Loop */ ?>
			 <?php while ( have_posts() ) : the_post(); ?>
		 
				  <?php
				  /* Include the Post-Format-specific template for the content.
				  * If you want to overload this in a child theme then include a file
				  * called content-___.php (where ___ is the Post Format name) and    that will be used instead.
				  */
				  get_template_part( 'content', get_post_format() );
				  ?>
			 <?php endwhile; ?>
		   <?php nuwhite_content_nav( 'nav-below' ); ?>
		   <?php endif; ?>
		   </div><!-- #content .site-content -->
		</div>
		<!-- #primary .content-area -->
	<?php
	} 
	
	if ( 'left-sidebar' == $content_layout ){ ?>
		<div id="left-sidebar" class="content-area">
		   <div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>
			 <?php /* Start the Loop */ ?>
			 <?php while ( have_posts() ) : the_post(); ?>
		 
				  <?php
				  /* Include the Post-Format-specific template for the content.
				  * If you want to overload this in a child theme then include a file
				  * called content-___.php (where ___ is the Post Format name) and    that will be used instead.
				  */
				  get_template_part( 'content', get_post_format() );
				  ?>
			 <?php endwhile; ?>
		   <?php nuwhite_content_nav( 'nav-below' ); ?>
		   <?php endif; ?>
		   </div><!-- #content .site-content -->
		   <?php get_sidebar(); ?>
		</div>
		<!-- #primary .content-area -->
		
	<?php 
	}
	
	if ( 'right-sidebar' == $content_layout ) { ?>
		<div id="right-sidebar" class="content-area">
		   <div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>
			 <?php /* Start the Loop */ ?>
			 <?php while ( have_posts() ) : the_post(); ?>
		 
				  <?php
				  /* Include the Post-Format-specific template for the content.
				  * If you want to overload this in a child theme then include a file
				  * called content-___.php (where ___ is the Post Format name) and    that will be used instead.
				  */
				  get_template_part( 'content', get_post_format() );
				  ?>
			 <?php endwhile; ?>
		   <?php nuwhite_content_nav( 'nav-below' ); ?>
		   <?php endif; ?>
		   </div><!-- #content .site-content -->
		   <?php get_sidebar(); ?>
		</div>
		<!-- #primary .content-are -->
		
	<?php 
	}

}
add_action ('nuwhite_get_content_layout', 'nuwhite_content_layout', 10, 1);

/**
 * Enqueue the styles for color scheme.
 */
function nuwhite_enqueue_color_scheme() {
	global $nuwhite_theme_options_settings;
   	$options = $nuwhite_theme_options_settings;
	$color_scheme = $options['color_scheme'];
	
	if ( 'white-scheme' == $color_scheme ) { 
		wp_enqueue_style( 'white', get_template_directory_uri() . '/css/scheme/whity.css', array(), null );
	}
	
	if ( 'black-scheme' == $color_scheme ) { 
		wp_enqueue_style( 'black', get_template_directory_uri() . '/css/scheme/black.css', array(), null );
	}
	
	if ( 'gray-scheme' == $color_scheme ) {
		wp_enqueue_style( 'gray', get_template_directory_uri() . '/css/scheme/gray.css', array(), null );
	}
	
	if ( 'blue-scheme' == $color_scheme ) {
		wp_enqueue_style( 'blue', get_template_directory_uri() . '/css/scheme/blue.css', array(), null );
	}
	
	if ( 'green-scheme' == $color_scheme ) {
		wp_enqueue_style( 'green', get_template_directory_uri() . '/css/scheme/green.css', array(), null );
	}
	
	if ( 'torquoise-scheme' == $color_scheme ) {
		wp_enqueue_style( 'torquoise', get_template_directory_uri() . '/css/scheme/torquoise.css', array(), null );
	}
	
	if ( 'pinky-scheme' == $color_scheme ) {
		wp_enqueue_style( 'pinky', get_template_directory_uri() . '/css/scheme/pinky.css', array(), null );
	}
	
	if ( 'orange-scheme' == $color_scheme ) {
		wp_enqueue_style( 'orange', get_template_directory_uri() . '/css/scheme/orange.css', array(), null );
	}		
	do_action( 'nuwhite_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'nuwhite_enqueue_color_scheme' );

/**
 * Get social links
 */
function social_links() {
	global $nuwhite_theme_options_settings;
	$options = $nuwhite_theme_options_settings;
	$nuwhite_socialnetworks = '';
	$nuwhite_socialnetworks .= '<div class="social-profiles clearfix"><ul>';

	$social_links = array(); 
	$social_links_name = array();
	$social_links_name = array( __( 'Facebook', 'nuwhite' ),
								__( 'Twitter', 'nuwhite' ),
								__( 'Google Plus', 'nuwhite' ),
								__( 'Pinterest', 'nuwhite' ),
								__( 'Linkedin', 'nuwhite' ),
								__( 'Youtube', 'nuwhite' ),
								__( 'RSS', 'nuwhite' )
								);
	$social_links = array( 	'Facebook' 		=> 'social_facebook',
									'Twitter' 		=> 'social_twitter',
									'Google-Plus'	=> 'social_googleplus',
									'Pinterest'		=> 'social_pinterest',
									'Linkedin'		=> 'social_linkedin',
									'Youtube'		=> 'social_youtube',
									'RSS'				=> 'social_rss'  
								);
	
	$i=0;
	foreach( $social_links as $key => $value ) {
		if ( !empty( $options[ $value ] ) ) {
			$nuwhite_socialnetworks .=
				'<li class="'.strtolower($key).'"><a href="'. esc_url( $options[ $value ] ) .'" title="'.sprintf( esc_attr__( '%1$s on %2$s', 'nuwhite' ), get_bloginfo( 'name' ), $social_links_name[$i] ).'" target="_blank"></a></li>';
		}
		$i++;
	}		

	$nuwhite_socialnetworks .= '</ul></div> <!-- Social links -->';
	echo $nuwhite_socialnetworks;
}
add_action ('nuwhite_get_social_links', 'social_links', 10, 1);


/**
 * Google site verification
 */
function nuwhite_googlesite() { 
    
	$nuwhite_googlesite = '';
	global $nuwhite_theme_options_settings;
	$options = $nuwhite_theme_options_settings;
		if ( !empty( $options['google_verification'] ) ) {  
		$nuwhite_googlesite .= '<meta name="google-site-verification" content='.  $options[ 'google_verification' ].'>' ;
		}
	echo $nuwhite_googlesite;
}
add_action('wp_head', 'nuwhite_googlesite');

/**
 * Bing site verification
 */
function nuwhite_bingsite() { 
    
	$nuwhite_bingsite = '';
	global $nuwhite_theme_options_settings;
	$options = $nuwhite_theme_options_settings;
		if ( !empty( $options['bing_verification'] ) ) {  
		$nuwhite_bingsite .= '<meta name="ms.validate01" content='.  $options[ 'bing_verification' ].'>' ;
		}
	echo $nuwhite_bingsite;
}
add_action('wp_head', 'nuwhite_bingsite');

/**
 * Header Analytics Code
 */
function nuwhite_headercode() { 
    
	$nuwhite_headercode = '';
	global $nuwhite_theme_options_settings;
	$options = $nuwhite_theme_options_settings;
		if ( !empty( $options['header_analytics'] ) ) {  
		$nuwhite_headercode .=  $options[ 'header_analytics' ] ;
		}
	echo $nuwhite_headercode;
}
add_action('wp_head', 'nuwhite_headercode');


/**
 * Footer Analytics Code
 */
function nuwhite_footercode() { 
    
	$nuwhite_footercode = '';
	global $nuwhite_theme_options_settings;
	$options = $nuwhite_theme_options_settings;
		if ( !empty( $options['footer_analytics'] ) ) {  
		$nuwhite_footercode .=  $options[ 'footer_analytics' ] ;
		}
	echo $nuwhite_footercode;
}
add_action('wp_footer', 'nuwhite_footercode');