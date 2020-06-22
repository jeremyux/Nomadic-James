<?php
/**
 * Plugin Name: Video Background Pro
 * Plugin URI: https://pushlabs.co/video-background-pro/
 * Description: Pro version of the popular Video Background plugin on the WordPress repo.
 * Version: 4.0.5
 * Author: Push Labs
 * Author URI: https://pushlabs.co
 * License: Push Labs Standard License
 * License URI: https://pushlabs.co/license/
 * Text Domain: video-background-pro
 * Domain Path: /languages
 *
 * @package video-background-pro
 */

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define some constants
 */
define( 'VIDBGPRO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'VIDBGPRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'VIDBGPRO_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'VIDBGPRO_PLUGIN_VERSION', '4.0.5' );

define( 'VIDBGPRO_LICENSE_SOFTWARE_TITLE', 'Video Background Pro' );
define( 'VIDBGPRO_LICENSE_API_DOMAIN', 'https://pushlabs.co' );

/**
 * Load the API Key library
 *
 * @since 2.1.0
 */
if ( ! class_exists( 'PL_VBP_License' ) ) {
	// Require our license page.
	require_once VIDBGPRO_PLUGIN_PATH . 'license-page.php';

	// Call the class instance.
	PL_VBP_License::instance(
		__FILE__,
		VIDBGPRO_LICENSE_SOFTWARE_TITLE,
		VIDBGPRO_PLUGIN_VERSION,
		'plugin',
		VIDBGPRO_LICENSE_API_DOMAIN,
		'video-background-pro',
		''
	);
}

/**
 * Run on installation of plugin
 * Checks if we need to deactivate the free verison of the plugin
 * Deletes option to restore admin notices
 *
 * @since 1.0.0
 *
 * @uses is_plugin_active()
 * @uses deactivate_plugins()
 * @uses delete_option()
 */
function vidbgpro_install_plugin() {
	if ( is_plugin_active( 'video-background/candide-vidbg.php' ) ) {
		deactivate_plugins( 'video-background/candide-vidbg.php' );
	}
	delete_option( 'vidbgpro-admin-notice-dismissed' );
}
register_activation_hook( __FILE__, 'vidbgpro_install_plugin' );

/**
 * Run on deactivation of plugin
 * Will delete the admin notice trasient so it will display on next activation
 *
 * @since 2.3.2
 *
 * @uses delete_transient()
 */
function vidbgpro_on_deactivation() {
	delete_transient( 'vidbgpro_hide_docs_notice' );
}
register_deactivation_hook( __FILE__, 'vidbgpro_on_deactivation' );

/**
 * Display a notice if the update is important
 *
 * @since 3.0.0
 */
function vidbgpro_update_message( $data, $response ) {
	if ( isset( $data['upgrade_notice'] ) ) {
		printf( '<div class="vidbg-update-message">%s</div>', wpautop( $data['upgrade_notice'] ) );
	}
}
add_action( 'in_plugin_update_message-video-background-pro/vidbgpro.php', 'vidbgpro_update_message', 10, 2 );

/**
 * Determines if VC integration should be added
 *
 * @since 2.2.0
 *
 * @return Boolean
 */
function vidbgpro_enable_vc() {
	$is_enabled = true;
	$is_enabled = apply_filters( 'vidbgpro_enable_vc', $is_enabled );

	return $is_enabled;
}

/**
 * Determines if SiteOrigin integration should be added
 *
 * @since 3.0.0
 *
 * @return Boolean
 */
function vidbgpro_enable_siteorigin() {
	$is_enabled = true;
	$is_enabled = apply_filters( 'vidbgpro_enable_siteorigin', $is_enabled );

	return $is_enabled;
}

/**
 * Disable YouTube and Vimeo integrations from tracking you (storing cookies)
 *
 * @since 4.0.3
 *
 * @return Boolean
 */
function vidbgpro_player_do_not_track() {
	$do_not_track = false;
	$do_not_track = apply_filters( 'vidbgpro_player_do_not_track', $do_not_track );

	return $do_not_track;
}

/**
 * Include neccesary classes and framework
 */
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/vendor/cmb2/init.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/vendor/cmb2/init.php';
}
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/classes/cmb2_field_slider.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/classes/cmb2_field_slider.php';
}
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/register_metaboxes.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/register_metaboxes.php';
}
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/vidbgpro_shortcode.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/vidbgpro_shortcode.php';
}
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/vidbg_shortcode.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/vidbg_shortcode.php';
}
if ( file_exists( VIDBGPRO_PLUGIN_PATH . 'inc/admin_notices.php' ) ) {
	require_once VIDBGPRO_PLUGIN_PATH . 'inc/admin_notices.php';
}


/**
 * Determine which data model to ues for the integrations
 *
 * @since 3.0.0
 */
function vidbgpro_integration_use_old_data_model() {
	$use_old = false;

	$use_old = apply_filters( 'vidbgpro_integration_use_old_data_model', $use_old );

	return $use_old;
}

/**
 * Load the Visual Composer integration if conditions are met
 *
 * @since 2.2.0
 */
function vidbgpro_load_vc_integration() {

	// Dont use the Visual Composer integration if the filter returns false.
	if ( vidbgpro_enable_vc() === false ) {
		return;
	}

	// If Visual Composer is activated, reqiure our integration.
	if ( class_exists( 'Vc_Manager' ) ) {
		require_once VIDBGPRO_PLUGIN_PATH . 'inc/classes/vidbg_wpbakery.php';
		require_once VIDBGPRO_PLUGIN_PATH . 'inc/register_wpbakery.php';
	}
}
add_action( 'after_setup_theme', 'vidbgpro_load_vc_integration' );

/**
 * Load the SiteOrigin integration if conditions are met
 *
 * @since 2.2.0
 */
function vidbgpro_load_siteorigin_integration() {

	// Dont use the SiteOrigin integration if the filter returns false.
	if ( vidbgpro_enable_siteorigin() === false ) {
		return;
	}

	// If Site Origin is activated, reqiure our integration.
	if ( class_exists( 'SiteOrigin_Panels_Css_Builder' ) ) {
		require_once VIDBGPRO_PLUGIN_PATH . 'inc/classes/vidbg_siteorigin.php';
		require_once VIDBGPRO_PLUGIN_PATH . 'inc/register_siteorigin.php';
	}
}
add_action( 'after_setup_theme', 'vidbgpro_load_siteorigin_integration' );

/**
 * Load the plugin text domain for localization
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/I18n_for_WordPress_Developers
 *
 * @uses load_plugin_textdomain()
 */
function vidbgpro_load_textdomain() {
	/**
	 * Using basename( dirname( __FILE__ ) ) instead of VIDBGPRO_PLUGIN_BASE
	 * due to numerous customers experiencing open_basedir issues.
	 */
	load_plugin_textdomain( 'video-background-pro', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'vidbgpro_load_textdomain' );

/**
 * Enqueue admin scripts and styles in the backend
 *
 * @since 1.0.0
 *
 * @uses wp_enqueue_style()
 * @uses wp_enqueue_script()
 */
function vidbgpro_enqueue_admin_scripts() {
	wp_enqueue_style(
		'vidbgpro-metabox-style',
		VIDBGPRO_PLUGIN_URL . 'dist/backend.css',
		array(),
		VIDBGPRO_PLUGIN_VERSION
	);

	wp_enqueue_script(
		'vidbgpro-admin-backend',
		VIDBGPRO_PLUGIN_URL . 'dist/backend.js',
		array( 'jquery' ),
		VIDBGPRO_PLUGIN_VERSION,
		true
	);

	wp_localize_script(
		'vidbgpro-admin-backend',
		'vidbgpro_localized_text',
		array(
			'show_advanced' => __( 'Show Advanced Options', 'video-background-pro' ),
			'hide_advanced' => __( 'Hide Advanced Options', 'video-background-pro' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'vidbgpro_enqueue_admin_scripts' );
add_action( 'siteorigin_panel_enqueue_admin_scripts', 'vidbgpro_enqueue_admin_scripts' );

/**
 * Enqueue Video Background Pro scripts and styles for the frontend
 *
 * @since 1.0.0
 *
 * @uses wp_enqueue_script()
 * @uses wp_enqueue_style()
 */
function vidbgpro_enqueue_frontend_scripts() {
	wp_enqueue_script(
		'vidbgpro',
		VIDBGPRO_PLUGIN_URL . 'dist/VideoBackgroundPro.js',
		vidbgpro_script_deps(),
		VIDBGPRO_PLUGIN_VERSION,
		true
	);

	// TODO Conditionally add this.
	wp_enqueue_script( 'vidbgpro-vimeo', 'https://player.vimeo.com/api/player.js' );

	wp_enqueue_style(
		'vidbgpro-frontend-style',
		VIDBGPRO_PLUGIN_URL . 'dist/videobackgroundpro.css',
		array(),
		VIDBGPRO_PLUGIN_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'vidbgpro_enqueue_frontend_scripts' );

/**
 * Add custom colors to the CMB2 colorpicker
 *
 * @since 1.0.0
 *
 * @param Array $l10n array Localize color pickers in CMB2 for custom colors.
 * @return Array Array of custom colors for the CMB2 colorpicker
 */
function vidbgpro_custom_color_palette( $l10n ) {
	$l10n['defaults']['color_picker'] = array(
		'palettes' => array( '#000000', '#3498db', '#e74c3c', '#374e64', '#2ecc71', '#f1c40f' ),
	);
	return $l10n;
}
add_filter( 'cmb2_localized_data', 'vidbgpro_custom_color_palette' );

/**
 * Add post types function for filtering
 *
 * @since 1.1.2
 *
 * @uses apply_filters()
 * @return Array Array of post types Video Background Pro uses
 */
function vidbgpro_post_types() {
	$post_types = array( 'post', 'page' );
	$post_types = apply_filters( 'vidbgpro_post_types', $post_types );

	return $post_types;
}

/**
 * Add Video Background Pro script deps for filtering
 *
 * @since 2.2.0
 *
 * @uses apply_filters()
 * @return Array Array of deps
 */
function vidbgpro_script_deps() {
	$deps = array( 'jquery' );
	$deps = apply_filters( 'vidbgpro_script_deps', $deps );

	return $deps;
}

/**
 * Add metabox priority filter
 *
 * @since 2.0.0
 *
 * @uses apply_filters()
 * @return String The location of the metabox used by WordPress
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function vidbgpro_metabox_priority() {
	$priority = 'high';
	$priority = apply_filters( 'vidbgpro_metabox_priority', $priority );

	return $priority;
}

/**
 * Add getting started link to the plugin's page
 *
 * @since 1.0.0
 * @param String $links Getting started link.
 * @return String link on the plugin's page.
 *
 * @uses __()
 */
function vidbgpro_gettingstarted_link( $links ) {
	$gettingstarted_link = __(
		'<a href="options-general.php?page=video_background_pro_dashboard">Getting Started</a>',
		'video-background-pro'
	);
	array_unshift( $links, $gettingstarted_link );
	return $links;
}
add_filter( 'plugin_action_links_' . VIDBGPRO_PLUGIN_BASE, 'vidbgpro_gettingstarted_link' );

/**
 * Construct the vidbg shortcode from an array
 *
 * @since 2.0.0
 *
 * @uses do_shortcode()
 *
 * @param Array $atts_array A 2d array of shortcode attributes.
 * @return String The [vidbg] constructed from the array input
 */
function vidbgpro_construct_shortcode( $atts_array ) {
	// If no array is provided, quit.
	if ( empty( $atts_array ) ) {
		return;
	}

	// Our shortcode name.
	$shortcode_name = 'vidbg';

	// Construct the shortcode.
	$the_shortcode = '[' . $shortcode_name;
	foreach ( $atts_array as $key => $value ) {
		$the_shortcode .= ' ' . $key . '="' . $value . '"';
	}
	$the_shortcode .= ']';

	// Create the output.
	$output = $the_shortcode;

	return $output;
}

/**
 * Create a unique random class name to be used as a reference for
 * other plugin integrations.
 *
 * @since 2.0.0
 *
 * @return String The reference class name (without the period prefix)
 */
function vidbgpro_create_unique_ref() {
	// Our possible list of characters.
	$characters        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characters_length = strlen( $characters );
	$length            = 14;

	// Create our string.
	$unique_ref = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$unique_ref .= $characters[ rand( 0, $characters_length - 1 ) ];
	}

	// Create our output.
	$output = 'vidbg-ref-' . $unique_ref;

	return $output;
}

/**
 * Add Video Background initialize to the footer.
 *
 * @since 1.0.0
 *
 * @uses is_page()
 * @uses is_single()
 * @uses is_home()
 * @uses get_option()
 * @uses get_the_ID()
 * @uses get_post_meta()
 */
function vidbgpro_init_footer() {
	if ( is_page() || is_single() || is_home() && get_option( 'show_on_front' ) === 'page' ) {
		// Identify if we are on a page or the home page and grab the ID conditionally.
		if ( is_page() || is_single() ) {
			$the_id = get_the_ID();
		} elseif ( is_home() && get_option( 'show_on_front' ) === 'page' ) {
			$the_id = get_option( 'page_for_posts' );
		}

		// Create variables for our post meta.
		$meta_prefix               = 'vidbg_metabox_field_';
		$container_meta            = get_post_meta( $the_id, $meta_prefix . 'container', true );
		$type_meta                 = get_post_meta( $the_id, $meta_prefix . 'type', true );
		$mp4_meta                  = get_post_meta( $the_id, $meta_prefix . 'mp4', true );
		$webm_meta                 = get_post_meta( $the_id, $meta_prefix . 'webm', true );
		$poster_meta               = get_post_meta( $the_id, $meta_prefix . 'poster', true );
		$end_frame_poster_meta     = get_post_meta( $the_id, $meta_prefix . 'end_poster', true );
		$vimeo_url_meta            = get_post_meta( $the_id, $meta_prefix . 'vimeo_url', true );
		$youtube_url_meta          = get_post_meta( $the_id, $meta_prefix . 'youtube_url', true );
		$youtube_start_meta        = get_post_meta( $the_id, $meta_prefix . 'start_sec', true );
		$youtube_end_meta          = get_post_meta( $the_id, $meta_prefix . 'end_sec', true );
		$overlay_meta              = get_post_meta( $the_id, $meta_prefix . 'overlay', true );
		$overlay_color_meta        = get_post_meta( $the_id, $meta_prefix . 'overlay_color', true );
		$overlay_alpha_meta        = get_post_meta( $the_id, $meta_prefix . 'overlay_alpha', true );
		$loop_meta                 = get_post_meta( $the_id, $meta_prefix . 'no_loop', true );
		$frontend_play_button_meta = get_post_meta( $the_id, $meta_prefix . 'frontend_play', true );
		$frontend_mute_button_meta = get_post_meta( $the_id, $meta_prefix . 'frontend_mute', true );
		$frontend_position_meta    = get_post_meta( $the_id, $meta_prefix . 'frontend_buttons_position', true );

		// If there is no container element, return.
		if ( empty( $container_meta ) ) {
			return;
		}

		// Create our shortcode attributes array.
		$shortcode_atts = array(
			'container'              => $container_meta,
			'type'                   => $type_meta,
			'mp4'                    => ( '' == $mp4_meta ) ? '#' : $mp4_meta,
			'webm'                   => ( '' == $webm_meta ) ? '#' : $webm_meta,
			'poster'                 => ( '' == $poster_meta ) ? '#' : $poster_meta,
			'end_frame_poster'       => ( 'on' === $end_frame_poster_meta ) ? 'true' : 'false',
			'youtube_url'            => ( '' == $youtube_url_meta ) ? '#' : $youtube_url_meta,
			'youtube_start'          => ( '' == $youtube_start_meta ) ? '0' : $youtube_start_meta,
			'youtube_end'            => ( '' == $youtube_end_meta ) ? 'null' : $youtube_end_meta,
			'vimeo_url'              => ( '' == $vimeo_url_meta ) ? 'null' : $vimeo_url_meta,
			'loop'                   => ( 'on' === $loop_meta ) ? 'false' : 'true',
			'overlay'                => ( 'on' === $overlay_meta ) ? 'true' : 'false',
			'overlay_color'          => ! empty( $overlay_color_meta ) ? $overlay_color_meta : '#000',
			'overlay_alpha'          => ! empty( $overlay_alpha_meta ) ? '0.' . $overlay_alpha_meta : '0.3',
			'frontend_play_button'   => ( 'on' === $frontend_play_button_meta ) ? 'true' : 'false',
			'frontend_volume_button' => ( 'on' === $frontend_mute_button_meta ) ? 'true' : 'false',
			'frontend_position'      => ( 'bottom-right' === $frontend_position_meta ) ? 'bottom-right' : $frontend_position_meta,
			'source'                 => 'Metabox',
		);

		// Construct the shortcode, then echo it.
		$the_shortcode = vidbgpro_construct_shortcode( $shortcode_atts );
		$output        = do_shortcode( $the_shortcode );

		echo $output;
	}
}
add_action( 'wp_footer', 'vidbgpro_init_footer' );
