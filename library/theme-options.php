<?php
/**
 * Nu White Theme Options
 *
 * @since Nu White 1.0
 */
 
function nuwhite_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'nuwhite-admin-css', get_template_directory_uri() . '/library/assets/options-style.css', true);
	wp_enqueue_script( 'nuwhite-admin-js', get_template_directory_uri() . '/library/assets/options-script.js', array( 'jquery'), '20130804', true );
	wp_enqueue_script( 'nuwhite-image-uploader', get_template_directory_uri() . '/library/assets/image-uploader.js', array( 'jquery', 'media-upload', 'thickbox' ), '20130804', true );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'nuwhite_admin_enqueue_scripts' );


add_action( 'admin_menu', 'nuwhite_options_menu' );
/**
 * Create sub-menu page.
 *
 * @uses add_theme_page to add sub-menu under the Appearance top level menu.
 */
function nuwhite_options_menu() {
    
	add_theme_page( 
		__( 'Theme Options', 'nuwhite' ),           // Name of page
		__( 'Theme Options', 'nuwhite' ),           // Label in menu
		'edit_theme_options',                           // Capability required
		'theme_options',                                // Menu slug, used to uniquely identify the page
		'nuwhite_theme_options_do_page'             // Function that renders the options page
	);

}

add_action( 'admin_init', 'nuwhite_register_settings' );
/**
 * Register options and validation callbacks
 *
 * @uses register_setting
 */
function nuwhite_register_settings() {
   register_setting( 'nuwhite_theme_options', 'nuwhite_theme_options', 'nuwhite_theme_options_validate' );
}

/**
 * Render Nuwhite Theme Options Elements
 */
function nuwhite_theme_options_do_page() {

?> 
<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = wp_get_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'nuwhite' ), $theme_name ); ?></h2>
		<form method="post" action="options.php">
		<?php
			settings_fields( 'nuwhite_theme_options' );
			global $nuwhite_theme_options_settings;
			$options = $nuwhite_theme_options_settings;             
		?>       
		<?php if( isset( $_GET [ 'settings-updated' ] ) && 'true' == $_GET[ 'settings-updated' ] ): ?>
			<?php settings_errors(); ?>
		<?php endif; ?> 	
		<div id="nuwhite-container">
		<div id="tabs" class="nu-tabs">
			<ul>
				<li><a href="#tab-1"><?php _e( 'General Options', 'nuwhite' );?></a></li>
				<li><a href="#tab-2"><?php _e( 'Social Options', 'nuwhite' );?></a></li>
				<li><a href="#tab-3"><?php _e( 'Webmaster Options', 'nuwhite' );?></a></li>
				<li><a href="#tab-4"><?php _e( 'Help and Documentations', 'nuwhite' );?></a></li>
			</ul>
			<div id="tab-1">
				<h3> <?php _e( 'General Options', 'nuwhite' );?> </h3>
							<table>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Default index posts', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>		
										<input type="radio" name="nuwhite_theme_options[index_posts]" id="show-excerpt" <?php checked($options['index_posts'], 'show-excerpt') ?> value="show-excerpt"  />
										<?php _e ( 'Show excerpt', 'nuwhite' ); ?>
									</label>
									<label>		
										<input type="radio" name="nuwhite_theme_options[index_posts]" id="show-full-post" <?php checked($options['index_posts'], 'show-full-post') ?> value="show-full-post"  />
										<?php _e ( 'Show full post', 'nuwhite' ); ?>
									</label>
								</td>
								</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Header style', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>		
										<input type="radio" name="nuwhite_theme_options[header_style]" id="nuwhite-center" <?php checked($options['header_style'], 'nuwhite-center') ?> value="nuwhite-center"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/header-nuwhite-center.png" />
									</label>
									<label>		
										<input type="radio" name="nuwhite_theme_options[header_style]" id="nuwhite-left" <?php checked($options['header_style'], 'nuwhite-left') ?> value="nuwhite-left"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/header-nuwhite-left.png" />
									</label>
								</td>
								</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Sidebar', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>		
										<input type="radio" name="nuwhite_theme_options[sidebar]" id="no-sidebar" <?php checked($options['sidebar'], 'no-sidebar') ?> value="no-sidebar"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/no-sidebar.png" />
									</label>
									<label>		
										<input type="radio" name="nuwhite_theme_options[sidebar]" id="right-sidebar" <?php checked($options['sidebar'], 'right-sidebar') ?> value="right-sidebar"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/right-sidebar.png" />
									</label>
									<label>		
										<input type="radio" name="nuwhite_theme_options[sidebar]" id="left-sidebar" <?php checked($options['sidebar'], 'left-sidebar') ?> value="left-sidebar"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/left-sidebar.png" />
									</label>
								</td>
								</tr>
									<tr>
										<td class="left">
											<label>
												<?php _e( 'Custom logo header', 'nuwhite' ); ?>
											</label>
										</td>
										<td class="right">
											<label>
												<!-- <input type="text" size="60" name="nuwhite_theme_options[custom_logo]" value="echo $options['custom_logo'];" /> -->
												<input class="upload" size="65" type="text" id="header_logo" name="nuwhite_theme_options[custom_logo]" value="<?php echo esc_url( $options [ 'custom_logo' ] ); ?>" />
												<input class="upload-button button" name="image-add" type="button" value="<?php esc_attr_e( 'Change Header Logo', 'attitude' ); ?>" />
											</label>
										<td>
									</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Color scheme', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>		
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="white-scheme" <?php checked($options['color_scheme'], 'white-scheme') ?> value="white-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/white-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="black-scheme" <?php checked($options['color_scheme'], 'black-scheme') ?> value="black-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/black-scheme.png" />
									</label>
									<label>									
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="gray-scheme" <?php checked($options['color_scheme'], 'gray-scheme') ?> value="gray-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/gray-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="blue-scheme" <?php checked($options['color_scheme'], 'blue-scheme') ?> value="blue-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/blue-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="green-scheme" <?php checked($options['color_scheme'], 'green-scheme') ?> value="green-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/green-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="torquoise-scheme" <?php checked($options['color_scheme'], 'torquoise-scheme') ?> value="torquoise-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/torquoise-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="pinky-scheme" <?php checked($options['color_scheme'], 'pinky-scheme') ?> value="pinky-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/pinky-scheme.png" />
									</label>
									<label>
										<input type="radio" name="nuwhite_theme_options[color_scheme]" id="orange-scheme" <?php checked($options['color_scheme'], 'orange-scheme') ?> value="orange-scheme"  />
										<img src="<?php echo get_template_directory_uri(); ?>/library/assets/img/orange-scheme.png" />
									</label>
								</td>
								</tr>
							</table>
							<?php submit_button(); ?>
			</div>
			<div id="tab-2" class="nu-tabs">
				<h3><?php _e( 'Your social links', 'nuwhite' );?></h3>
				<?php 
					$social_links = array(); 
					$social_links_name = array();
					$social_links_name = array( __( 'Facebook', 'nuwhite' ),
												__( 'Twitter', 'nuwhite' ),
												__( 'Google Plus', 'nuwhite' ),
												__( 'Pinterest', 'nuwhite' ),
												__( 'LinkedIn', 'nuwhite' ),
												__( 'Youtube', 'nuwhite' ),
												__( 'RSS', 'nuwhite' )
										);
					$social_links = array( 	'Facebook' 		=> 'social_facebook',
											'Twitter' 		=> 'social_twitter',
											'Google-Plus'	=> 'social_googleplus',
											'Pinterest'		=> 'social_pinterest',
											'Linkedin'		=> 'social_linkedin',
											'Youtube'		=> 'social_youtube',
											'RSS'			=> 'social_rss' 
									);
				?>
							<table>
							<?php
								$i = 0;
								foreach( $social_links as $key => $value ) {
							?>
								<tr>
								<td class="left">
									<label>
										<?php printf( __( '%s', 'nuwhite' ), $social_links_name[ $i ] ); ?>
									</label>
								</td>
								<td class="right">
									<label>
										<input type="text" size="60" name="nuwhite_theme_options[<?php echo $value; ?>]" value="<?php 
										if ( !empty( $options[ $value ] ) ) {
											echo  esc_url ( $options[$value] );
										}
										?>" />
									</label>
								<td>
								</tr>
							<?php
								$i++;
								}
							?>
							</table>
			<?php submit_button(); ?>
			</div>
			<div id="tab-3" class="nu-tabs">
				<h3><?php _e( 'Webmaster scripts', 'nuwhite' ); ?></h3>
				<table>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Google site verification', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>
										<input type="text" size="60" name="nuwhite_theme_options[google_verification]" value="<?php echo $options['google_verification']; ?>" />
									</label>
								<td>
								</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Bing site verification', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>
										<input type="text" size="60" name="nuwhite_theme_options[bing_verification]" value="<?php echo $options['bing_verification']; ?>" />
									</label>
								<td>
								</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Header script', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>
										<textarea name="nuwhite_theme_options[header_analytics]" rows="7" cols="80" ><?php echo esc_html( $options[ 'header_analytics' ] ); ?></textarea>
									</label>
								<td>
								</tr>
								<tr>
								<td class="left">
									<label>
										<?php _e( 'Footer script', 'nuwhite' ); ?>
									</label>
								</td>
								<td class="right">
									<label>
										<textarea name="nuwhite_theme_options[footer_analytics]" rows="7" cols="80" ><?php echo esc_html( $options[ 'footer_analytics' ] ); ?></textarea>
									</label>
								<td>
								</tr>
							</table>
							<?php submit_button(); ?>
			</div>
			<div id="tab-4" class="nu-tabs">
				<h3>Documentations</h3>
			</div>
		</div>
		</form>
</div>
</div>
<?php } 

/**
 * Validate all theme options values
 */
 
function nuwhite_theme_options_validate( $options ) {
	global $nuwhite_theme_options_settings, $nuwhite_theme_options_defaults;
	$input_validated = $nuwhite_theme_options_settings;
	$input = array();
	$input = $options;
	
	// Index posts
	if( isset( $input[ 'index_posts' ] ) ) {
		$input_validated[ 'index_posts' ] = $input[ 'index_posts' ];
	}

	// Header style
	if( isset( $input[ 'header_style' ] ) ) {
		$input_validated[ 'header_style' ] = $input[ 'header_style' ];
	}
	// Custom header logo
	if ( isset( $input[ 'custom_logo' ] ) ) {
		$input_validated[ 'custom_logo' ] = esc_url_raw( $input[ 'custom_logo' ] );
	}
	
	// Color Scheme
	if( isset( $input[ 'color_scheme' ] ) ) {
		$input_validated[ 'color_scheme' ] = $input[ 'color_scheme' ];
	}
	
	// Content Layout
	if( isset( $input[ 'sidebar' ] ) ) {
		$input_validated[ 'sidebar' ] = $input[ 'sidebar' ];
	}
	
	// Social links
	if( isset( $input[ 'social_facebook' ] ) ) {
		$input_validated[ 'social_facebook' ] = esc_url_raw( $input[ 'social_facebook' ] );
	}
	if( isset( $input[ 'social_twitter' ] ) ) {
		$input_validated[ 'social_twitter' ] =  esc_url_raw( $input[ 'social_twitter' ] );
	}
	if( isset( $input[ 'social_googleplus' ] ) ) {
		$input_validated[ 'social_googleplus' ] =  esc_url_raw( $input[ 'social_googleplus' ] );
	}
	if( isset( $input[ 'social_pinterest' ] ) ) {
		$input_validated[ 'social_pinterest' ] =  esc_url_raw( $input[ 'social_pinterest' ] );
	}
	if( isset( $input[ 'social_linkedin' ] ) ) {
		$input_validated[ 'social_linkedin' ] = esc_url_raw( $input[ 'social_linkedin' ] );
	}
	if( isset( $input[ 'social_youtube' ] ) ) {
		$input_validated[ 'social_youtube' ] = esc_url_raw( $input[ 'social_youtube' ] );
	}
	if( isset( $input[ 'social_rss' ] ) ) {
		$input_validated[ 'social_rss' ] = esc_url_raw( $input[ 'social_rss' ] );
	}   

	// Site verification
	if( isset( $input[ 'google_verification' ] ) ) {
		$input_validated[ 'google_verification' ] = $input[ 'google_verification' ];
	}
	if( isset( $input[ 'bing_verification' ] ) ) {
		$input_validated[ 'bing_verification' ] = $input[ 'bing_verification' ];
	}
	
	// Analytics
	if( isset( $input[ 'header_analytics' ] ) ) {
		$input_validated[ 'header_analytics' ] = wp_kses_stripslashes( $input[ 'header_analytics' ] );
	}
	
	if( isset( $input[ 'footer_analytics' ] ) ) {
		$input_validated[ 'footer_analytics' ] = wp_kses_stripslashes( $input[ 'footer_analytics' ] );
	}
   return $input_validated;
}