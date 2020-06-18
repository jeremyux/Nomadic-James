<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Video Background Pro fields for WPBakery (Visual Composer)
 *
 * @since 3.0.0
 * @param Array $fields WPBakery fields.
 */
function vidbgpro_register_wpbakery_fields( $fields ) {

	$prefix = 'vidbg_vc_';

	$fields[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Video background type', 'video-background-pro' ),
		'param_name'  => $prefix . 'type',
		'description' => __( 'Please specify if you would like to self host your video background or use a YouTube video instead.', 'video-background-pro' ),
		'value'       => array(
			__( 'Self Host', 'video-background-pro' ) => 'self-host',
			__( 'YouTube', 'video-background-pro' )   => 'youtube',
			__( 'Vimeo', 'video-background-pro' )     => 'vimeo',
		),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'weight'      => -1,
	);

	$fields[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Link to YouTube video', 'video-background-pro' ),
		'param_name'  => $prefix . 'youtube_url',
		'description' => __( 'Please specify the link to the YouTube video.', 'video-background-pro' ),
		'dependency'  => array(
			'element' => $prefix . 'type',
			'value'   => 'youtube',
		),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'weight'      => -25,
	);

	$fields[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'YouTube Start Second', 'video-background-pro' ),
		'param_name'  => $prefix . 'youtube_start',
		'description' => __( 'The second the YouTube video background starts on.', 'video-background-pro' ),
		'dependency'  => array(
			'element' => $prefix . 'type',
			'value'   => 'youtube',
		),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'weight'      => -25,
	);

	$fields[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'YouTube End Second', 'video-background-pro' ),
		'param_name'  => $prefix . 'youtube_end',
		'description' => __( 'The second the YouTube video background ends on.', 'video-background-pro' ),
		'dependency'  => array(
			'element' => $prefix . 'type',
			'value'   => 'youtube',
		),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'weight'      => -25,
	);

	$fields[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Link to Vimeo video', 'video-background-pro' ),
		'param_name'  => $prefix . 'vimeo_url',
		'description' => __( 'Please specify the link to the Vimeo video.', 'video-background-pro' ),
		'dependency'  => array(
			'element' => $prefix . 'type',
			'value'   => 'vimeo',
		),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'weight'      => -25,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'heading'     => __( 'End video on fallback image?', 'video-background-pro' ),
		'param_name'  => $prefix . 'end_frame_poster',
		'description' => __( 'If you would like your video to end on the fallback image, you can enable it here.', 'video-background-pro' ),
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'value'       => '0',
		'dependency'  => array(
			'element' => $prefix . 'loop',
			'value'   => 'true',
		),
		'weight'      => -75,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'heading'     => __( 'Enable play/pause button on the frontend?', 'video-background-pro' ),
		'description' => __( 'By enabling this option, a play/pause button will show up in the bottom right hand corner of the video background.', 'video-background-pro' ),
		'param_name'  => $prefix . 'frontend_play_button',
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'value'       => '0',
		'weight'      => -85,
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'heading'     => __( 'Eanble mute/unmute button on the frontend?', 'video-background-pro' ),
		'description' => __( 'By enabling this option, a mute/unmute button will show up in the bottom right hand corner of the video background.', 'video-background-pro' ),
		'param_name'  => $prefix . 'frontend_volume_button',
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'value'       => '0',
		'weight'      => -85,
	);

	$fields[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Frontend Buttons Position', 'video-background-pro' ),
		'description' => __( 'Please select the position you would like your frontend buttons to be in. (If applicable)', 'video-background-pro' ),
		'param_name'  => $prefix . 'frontend_position',
		'group'       => __( 'Video Background', 'video-background-pro' ),
		'value'       => array(
			__( 'Bottom Right', 'video-background-pro' ) => 'bottom-right',
			__( 'Top Right', 'video-background-pro' )    => 'top-right',
			__( 'Bottom left', 'video-background-pro' )  => 'bottom-left',
			__( 'Top left', 'video-background-pro' )     => 'top-left',
		),
		'default'     => 'bottom-right',
		'weight'      => -85,
	);

	return $fields;
}
add_filter( 'vidbg_wpbakery_fields', 'vidbgpro_register_wpbakery_fields' );

/**
 * Sanitize the Video Background Pro fields for WPBakery (Visual Composer)
 *
 * @since 3.0.0
 * @param Array $atts The attributes.
 */
function vidbgpro_wpbakery_fields_sanitize( $atts ) {

	if ( array_key_exists( 'overlay_texture_url', $atts ) ) {
		$overlay_texture_arr         = wp_get_attachment_image_src( $atts['overlay_texture_url'], 'full' );
		$atts['overlay_texture_url'] = $overlay_texture_arr[0];
	}

	return $atts;

}
add_filter( 'vidbg_sanitize_wpbakery_fields', 'vidbgpro_wpbakery_fields_sanitize' );
