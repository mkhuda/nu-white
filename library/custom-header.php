<?php
/**
 * Implements a custom header for Attitude.
 * See http://codex.wordpress.org/Custom_Headers
 * @since nuwhite 1.0
 */
add_action( 'after_setup_theme', 'nuwhite_custom_header_setup' );
 function nuwhite_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => apply_filters( 'nuwhite_header_image_height', 250 ),
		'width'                  => apply_filters( 'nuwhite_header_image_width', 809 ),
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// No Header Text Feature
		'header-text'				 => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => '',
		'admin-head-callback'    => 'nuwhite_admin_header_style',
		'admin-preview-callback' => 'nuwhite_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since nuwhite 1.0
 */
function nuwhite_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since nuwhite 1.0
 */
function nuwhite_admin_header_image() {
	?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }