<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create admin notices
 *
 * @since 1.0.0
 *
 * @uses __()
 * @uses get_option()
 */
function vidbgpro_admin_notices() {
	$class     = 'notice notice-success vidbgpro-admin-notice is-dismissible';
	$message   = __( 'Thank you for purchasing Video Background Pro! If you need any assistance, please visit the <a href="http://docs.pushlabs.co/video-background-pro/" target="_blank">docs</a>.', 'video-background-pro' );
	$is_hidden = get_transient( 'vidbgpro_hide_docs_notice' );
	if ( false === $is_hidden ) {
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}

}
add_action( 'admin_notices', 'vidbgpro_admin_notices' );

/**
 * Create transient for dismissal
 *
 * @since 1.0.0
 *
 * @uses set_transient()
 */
function vidbgpro_dismiss_notices() {
	set_transient( 'vidbgpro_hide_docs_notice', '1', 365 * DAY_IN_SECONDS );
}
add_action( 'wp_ajax_vidbgpro_dismiss_notices', 'vidbgpro_dismiss_notices' );
